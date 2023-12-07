<?php

namespace App\Core;


abstract class Model
{

    const TABLE = '';
    const FIELD_BASE = '';
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
        c($this->attributes);
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
            $this->sendResponse($message_error, [], true);
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
            $this->sendResponse("$name <a href='/$table_link?id=$link'>$title</a> успешно создан(а)", ["link" => $link]);
        } else {
            $this->sendResponse('Ошибка! Попробуте позже', [], true);
        }
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
            $this->sendResponse('Данные успешно изменены', [], true);
        } else {
            $this->sendResponse('Ошибка! Попробуте позже', [], true);
        }
        return $status;
    }

    public function sendResponse($message, $data = [], $error = null)
    {
        $status = ($error) ? 500 : 200;
        $request = ["status" => $status, 'message' => $message, "data" => $data];
        $json =  json_encode($request);
        $_SESSION['request'] = $json;
    }

    private function validatePassword($data, $is_validate_password)
    {
        if (!isset($data['password'])) return;

        if ($is_validate_password) {
            $confirm_password_key = $this::CONFIRM_PASSWORD_KEY;

            if (empty($_POST[$confirm_password_key])) {
                $this->sendResponse("Введите пароль два раза", [], true);
                redirect();
                die;
            }
            if ($data['password'] !== $_POST[$confirm_password_key]) {
                $this->sendResponse("Пароли должны совпадать", [], true);
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

    public function checkUnique($key)
    {
        $email = $this->attributes[$key];
        $user = $this->find([$key], [$email]);

        if (count($user) > 0) {
            $this->sendResponse("Пользователь с данным электронным адресом уже зарегистрирован", [], true);
            redirect();
            die;
        }
        return true;
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
        return $data ? $data[0] : null;
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
