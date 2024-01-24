<?php

namespace App\Core;

use App\Functions\FUser;

abstract class Model
{

    const TABLE = '';
    const NAME = '';
    const CONFIRM_PASSWORD_KEY = NULL;

    protected $pdo;
    public $id;
    public $attributes = [];
    public $rules = [];

    public function __construct()
    {
        $this->pdo = Db::instance();
    }

    public function load($data)
    {
        foreach ($this->attributes as $key => $value) {

            if (isset($data[$key])) {
                $this->attributes[$key] = $this->prepared($data[$key], $key);
            }
            $this->attributes[$key] = $this->setValue($key);
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

    private function setValue($key)
    {
        if (isset($this->rules[$key]['function'])) {
            $function = $this->rules[$key]['function'];
            $value = $this->attributes[$function[1]];

            switch ($function[0]) {
                case 'translitLink':
                    return $this->translitLink($value);
                    break;
                case 'securing':
                    return $this->securing($value);
                    break;
                case 'generateCode':
                    return $this->generateCode();
                    break;
            }
        }

        return $this->attributes[$key];
    }

    public function check_response($fields)
    {
        foreach ($fields as $field) {
            if (!isset($_GET[$field])) return false;
        }

        return true;
    }

    public function sendMail($email_to, $email_from, $subject, $body, $message_success, $message_error)
    {
        $headers = $this->setHeaderMail($email_from);
        $is_sent = mail($email_to, $subject, $body, $headers);
        if ($is_sent) {
            $this->sendResponse($message_success, []);
        } else {
            $this->sendResponse($message_error, [], 500);
            redirect();
        }
    }

    public function setHeaderMail($from)
    {
        $headers = array(
            'From' => $from,
            'Reply-To' => $from,
            'Content-Type' => ' text/html; charset=utf-8',
            'X-Mailer' => 'PHP/' . phpversion(),
        );
        return $headers;
    }

    public function validate($data, $is_validate_password = false)
    {
        $this->validateEmail($data);
        $this->validatePassword($data, $is_validate_password);
        return true;
    }

    private function translitLink($name)
    {
        return translitSrc($name);
    }

    private function generateCode()
    {
        return generateCode();
    }

    private function securing($name)
    {
        return securing($name);
    }

    public function select($fields = '*', $where = [])
    {
        $table = static::TABLE;
        $attributes = $this->parseAttributes($where);
        $where = $attributes['where'];
        $data = $attributes['data'];

        $sql = "SELECT $fields FROM $table $where";

        return $this->pdo->query(
            $sql,
            $data,
            static::class,
            true
        );
    }

    public function getCount($where = null)
    {
        $select = $this->select('id', $where);
        return count($select);
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

    public function save($field_name = null, $update = false, $show = true)
    {
        $value = $this->insert($field_name, $update);

        if (is_null($value)) {
            return $this->sendResponse('Ошибка! Попробуйте позже', [], 500, $show);
        } else {
            $name = static::NAME;
            $class_link = $this->getClassName();
            $link = "<a href='/$class_link?id=$value'>$value</a>";
            if (is_null($field_name)) {
                $field_name = 'id';
            }
            return $this->sendResponse("$name $link успешно создан(а)", [$field_name => $value], 200, $show);
        }
    }

    private function insert($field_name = null, $update = false)
    {
        try {
            $table = static::TABLE;
            $this->addUser('user_id');
            $fields = $this->parseAttributes();
            $keys = $fields['keys'];
            $values = $fields['values'];
            $data = $fields['data'];

            $sql = "INSERT INTO $table ($keys) VALUES ($values)";

            if ($update) {
                $sql .= " ON DUPLICATE KEY UPDATE `state` = not `state`, datetime_update = CURRENT_TIMESTAMP";
            }

            $this->pdo->execute($sql, $data);
            $this->id = $this->pdo->getLastId();
            return ($field_name) ? $data[":$field_name"] : $this->id;
        } catch (\Throwable $th) {
            if ($th->getCode() === "23000") {
                echo $this->sendResponse("Пользователь с данным email уже существует", [], 400);
                die;
            } else {
                header('HTTP/1.0 500');
                echo $this->sendResponse($th->getMessage(), [], 500);
                die;
            }
        }
    }

    private function getClassName()
    {
        return basename(get_class($this));
    }

    public function edit($field_name = null)
    {
        return $this->update($field_name);
    }

    public function update($field_name = null)
    {
        $fields = $this->attributes;
        $table = static::TABLE;
        $data = [];
        $sets = [];

        if ($field_name) {
            $sets[] = "$field_name = :$field_name";
            $data[":$field_name"] = $fields[$field_name];
            $data[":id"] = $fields['id'];
        } else {
            foreach ($fields as $name => $value) {
                if ('id' != $name) {
                    $sets[] = "$name = :$name";
                }
                $data[":$name"] = $value;
            }
        }

        $sets = implode(', ', $sets);
        $sql = "UPDATE $table SET $sets, datetime_update=CURRENT_TIMESTAMP, `id` = LAST_INSERT_ID(`id`) WHERE id = :id";

        $status = $this->pdo->execute($sql, $data);

        if ($status) {
            $this->sendResponse('Данные успешно изменены', []);
        } else {
            $this->sendResponse('Ошибка! Попробуте позже', [], 500);
        }
        return $status;
    }

    public function response($value, $data = [], $message_success = "Success", $message_error = "Error")
    {
        if ($value) {
            return $this->sendResponse($message_success, $data);
        } else {
            return $this->sendResponse($message_error, $data, 500);
        }
    }

    public function sendResponse($message, $data = [], $status = 200, $show = true)
    {
        if (!is_array($data)) {
            $data = array("data" => $data);
        }

        $response = [
            "status" => $status,
            'message' => $message,
            "data" => $data,
            'class' => $this->getClassName()
        ];

        if ($show) {
            return $this->createResponse($response);
        }

        return $response;
    }

    public function createResponse($response, $class = null)
    {
        if ($class) {
            $response["class"] = $class;
        }
        $json = JSON($response);
        $_SESSION['request'] = $json;
        return $json;
    }

    private function validatePassword($data, $is_validate_password)
    {
        if (!isset($data['password'])) return;

        if ($is_validate_password) {
            $confirm_password_key = $this::CONFIRM_PASSWORD_KEY;

            if (empty($_POST[$confirm_password_key])) {
                $this->sendResponse("Введите пароль два раза", [], 500);
                redirect();
                die;
            }
            if ($data['password'] !== $_POST[$confirm_password_key]) {
                $this->sendResponse("Пароли должны совпадать", [], 500);
                redirect();
                die;
            }
        }
    }

    private function validateEmail($data)
    {
        if (!isset($data['email'])) return;

        if (!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $data['email'])) {
            $this->sendResponse("Пожалуйста, введите корректный email", [], true);
            redirect();
            die;
        }
    }

    public function find($fields, $value, $operator = 'AND')
    {
        $attrs = '';

        foreach ($fields as $key => $field) {
            $op = ($key == 0) ? '' : $operator;
            $attrs .= "$op $field=? ";
        }


        $table = static::TABLE;
        $sql = "SELECT * FROM $table WHERE $attrs LIMIT 1";
        $data = $this->pdo->query(
            $sql,
            $value,
            static::class,
            true
        );
        return $data ? $data[0] : [];
    }

    private function addAttributes($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    private function addUser($key)
    {
        $has_user_id = isset($this->attributes['user_id']);
        if (!$has_user_id) return;

        $user_id = $this->attributes['user_id'];

        if (!$user_id) {
            $this->attributes[$key] = FUser::getId();
        }
    }

    private function parseAttributes($filter = [])
    {
        $attributes = $this->attributes;

        if (count($filter)) {
            $attributes = array_intersect_key($attributes, array_flip($filter));
        }

        $cols = [];
        $data = [];
        $where = [];

        foreach ($attributes as $key => $value) {
            $is_datetime = $this->rules[$key]['type'] === 'datetime' && !$value;
            if ('id' == $key || $is_datetime) {
                continue;
            }

            $cols[] = $key;
            $data[":$key"] = $value;
            if (count($filter)) {
                $where[] = "$key=:$key";
            }
        }

        $keys = implode(',', $cols);
        $values = implode(',', array_keys($data));
        $where = (count($where)) ? 'WHERE ' . implode(' AND ', $where) : '';

        return array('keys' => $keys, 'values' => $values, 'data' => $data, 'where' => $where);
    }

    public function create_table()
    {
        $table = static::TABLE;
        $sql = "CREATE TABLE `$table` (";
        $fields = "";
        $uniques = [];
        $primary_key = '';

        foreach ($this->attributes as $key => $value) {
            $rule = $this->rules[$key];

            $not_null = $this->getValue($rule, 'not_null', 'NOT NULL');
            $auto_increment = $this->getValue($rule, 'auto_increment', 'AUTO_INCREMENT');
            $type =  $this->getValue($rule, 'type');
            $length =  $this->getValue($rule, 'length');
            $default = $this->getDefault($rule, 'type', 'not_null');
            $unique = $this->getValue($rule, 'unique', $key, null);

            if ($unique) {
                $uniques[] = $unique;
            }

            $type_length = ($length === '') ? $type : "$type($length)";
            $fields .= "`$key` $type_length $not_null $auto_increment $default, ";

            if (isset($rule['primary_key'])) {
                $primary_key = "PRIMARY KEY ($key)";
            }
        }
        $sql .=  "$fields $primary_key) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        if (count($uniques)) {
            $unique_fields = implode(',', $uniques);;
            $sql .= "ALTER TABLE $table ADD UNIQUE($unique_fields);";
        }

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
        if ($rule[$type] === 'datetime') {
            return 'DEFAULT CURRENT_TIMESTAMP';
        }

        if (isset($rule[$not_null])) {
            return  '';
        }

        return 'DEFAULT NULL';
    }
}
