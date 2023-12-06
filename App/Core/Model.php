<?php

namespace App\Core;


abstract class Model
{

    const TABLE = '';
    const FIELD_BASE = '';
    const NAME = '';

    protected $pdo;
    public $id;
    public $attributes = [];
    public $rules = [];

    public $errors_validation = [];
    public $rules_validation = [];

    public function __construct()
    {
        $this->pdo = Db::instance();
    }

    public function load($data)
    {
        foreach ($this->attributes as $key => $value) {

            if (isset($data[$key])) {
                // if ($this->isDatetime($data[$key], $key)) continue;
                $this->attributes[$key] = $this->prepared($data[$key], $key);
            }
            $this->attributes[$key] = $this->setDefaultValue($key);
        }
    }

    private function prepared($str, $key)
    {
        $type = $this->rules[$key]['type'];
        if ($type === 'varchar' || $type === 'text') {
            return htmlspecialchars($str, ENT_QUOTES);
        }

        return $str;
    }

    // private function isDatetime($value, $key)
    // {
    //     c($value);
    //     c($this->rules[$key]['type']);
    //     if (!$value && $this->rules[$key]['type'] === 'datetime') {
    //         return true;
    //     }
    //     return false;
    // }

    private function setDefaultValue($key)
    {
        if ($this->attributes[$key] === '' && isset($this->rules[$key]['default'])) {
            $default = $this->rules[$key]['default'];

            if (is_array($default) && $default[0] === 'translitLink') {
                return $this->translitLink($this->attributes[$default[1]]);
            } else {
                return $this->rules[$key]['default'];
            }
        }

        return $this->attributes[$key];
    }

    public function check_response($fields)
    {
        foreach ($fields as $field) {
            if (!isset($_POST[$field])) return false;
            if (empty($_POST[$field]))  return false;
        }

        return true;
    }

    public function validate($data)
    {

        // $v->rules($this->rules);
        // if ($v->validate()) {
        //     return true;
        // }
        // $this->errors_validation = $v->errors();
        // return false;
        return true;
    }

    private function translitLink($name)
    {
        return translitSrc($name);
    }

    public function select($fields = '*')
    {
        $table = static::TABLE;
        $sql = "SELECT $fields FROM $table";
        return $this->pdo->query(
            $sql,
            [':table' => $table, ':fields' => $fields],
            static::class,
            true
        );
    }

    public function selectOne($value, $field = 'id')
    {
        $table = static::TABLE;
        $sql = "SELECT * FROM $table WHERE $field = :v LIMIT 1";
        $data = $this->pdo->query(
            $sql,
            [":v" => $value],
            static::class,
            true
        );
        return $data ? $data[0] : null;
    }

    public function save($field_name = null)
    {
        $link = $this->insert($field_name);

        if ($link) {
            $name = static::NAME;
            $table_link = substr(static::TABLE, 0, -1);
            $field_base = static::FIELD_BASE;
            $title = "«" . $this->attributes[$field_base] . "»";
            $this->sendResponse("$name <a href='/$table_link?id=$link'>$title</a> успешно создана", ["link" => $link]);
            redirect();
        } else {
            $this->sendResponse('Ошибка! Попробуте позже', [], true);
            redirect();
        }
    }

    private function sendResponse($message, $data = [], $error = null)
    {
        $status = ($error) ? 500 : 200;
        $request = ["status" => $status, 'message' => $message, "data" => $data];
        $json =  json_encode($request);
        $_SESSION['request'] = $json;
    }


    private function insert($field_name = null)
    {
        $fields = $this->attributes;
        $cols = [];
        $data = [];

        foreach ($fields as $name => $value) {
            $is_datetime = $this->rules[$name]['type'] === 'datetime' && !$value;
            if ('id' == $name || $is_datetime) {
                continue;
            }

            $cols[] = $name;
            $data[":$name"] = $value;
        }

        $name = implode(',', $cols);
        $value = implode(',', array_keys($data));
        $sql = 'INSERT INTO ' . static::TABLE . " ($name) VALUES ($value)";

        $this->pdo->execute($sql, $data);
        $this->id = $this->pdo->getLastId();
        return ($field_name) ? $data[":$field_name"] : $this->id;
    }

    public function create_table()
    {
        $table = static::TABLE;
        $sql = "CREATE TABLE `$table` (";
        $fields = "";
        $primary_key = '';

        foreach ($this->attributes as $key => $value) {
            $rule = $this->rules[$key];

            $not_null = $this->getValue($rule, 'not_null', 'NOT NULL');
            $auto_increment = $this->getValue($rule, 'auto_increment', 'AUTO_INCREMENT');
            $type =  $this->getValue($rule, 'type');
            $length =  $this->getValue($rule, 'length');
            $default = $this->getDefault($rule, 'type', 'not_null');

            $type_length = ($length === '') ? $type : $type . '(' . $length . ')';
            $fields .= "`$key` $type_length $not_null $auto_increment $default, ";

            if (isset($rule['primary_key'])) {
                $primary_key = "PRIMARY KEY ($key)";
            }
        }

        $sql .=  $fields . $primary_key . ") ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        return $this->pdo->execute($sql);
    }

    private function getValue($rule, $key,  $correct = null, $incorrect = '')
    {
        if (isset($rule[$key])) {
            return $correct ? $correct : $rule[$key];
        }
        return  $incorrect;
    }

    private function getDefault($rule, $type, $not_null)
    {
        if (isset($rule[$not_null])) {
            return  '';
        }

        if ($rule[$type] === 'datetime') {
            return 'DEFAULT CURRENT_TIMESTAMP';
        }

        return 'DEFAULT NULL';
    }
}
