<?php

namespace App\Core;

use App\Functions\FFilter;
use App\Functions\FResponse;
use App\Functions\FSort;
use App\Functions\FUser;

abstract class Model
{

    const TABLE = '';
    const NAME = '';
    const CONFIRM_PASSWORD_KEY = NULL;

    protected $pdo;
    public $attributes = [];
    public $rules = [];

    public function __construct()
    {
        $this->pdo = Db::instance();
    }

    public function load($data, $is_update = false)
    {
        foreach ($this->attributes as $key => $value) {

            if (isset($data[$key])) {
                $this->attributes[$key] = $this->prepared($data[$key], $key);
            }
            $this->attributes[$key] = $this->setValue($key, $is_update);
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

    private function setValue($key, $is_update)
    {
        $rules = $this->rules[$key];

        $this->parseCheckbox($key);

        if (!$is_update && isset($rules['function'])) {
            $function = $rules['function'];
            $value = (isset($function[1])) ? $this->attributes[$function[1]] : null;

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


    private function parseCheckbox($key)
    {
        if ($this->rules[$key]["type"] === "tinyint") {
            if ($this->attributes[$key] === "on") {
                $this->attributes[$key] = 1;
            } else if ($this->attributes[$key] === "") {
                $this->attributes[$key] = 0;
            }
        }
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

    public function selectOne($selected_fields = [], $where = [])
    {
        $data = $this->select($selected_fields, $where, 'LIMIT 1');
        return ($data) ? $data[0] : null;
    }

    public function select($selected_fields = [], $where = [], $limit = '', $order = [], $join_list = [], $count_list = [], $myStates = [], $fields_join = [])
    {
        // LEFT JOIN categories ON notes.category_id = categories.id 
        // SELECT notes.*, COUNT(DISTINCT likes.user_id) AS 'sum_likes' FROM notes  LEFT JOIN likes ON notes.id = likes.item_id AND likes.state=1  AND likes.name_table = 'notes' GROUP BY notes.id 
        //, COUNT(DISTINCT likes.user_id) AS 'sum_likes'
        $table = static::TABLE;
        $sql_fields = $this->getSelectedFields($selected_fields);
        // $parsed_where = FFilter::parse($where);
        // c($parsed_where);
        $attributes = $this->parseAttributes($where);
        $join = $this->parseJoin($join_list);
        $myStates = $this->parseMyState($myStates);
        $fields_join = $this->parseFieldsJoin($fields_join);
        $counts = $this->parseCounts($count_list);
        $where = $attributes['where'];
        $data = $attributes['data'];
        $order = FSort::parse($order);
        $group_by = (count($join_list) > 0) ? "GROUP BY $table.id" : '';

        $sql = "SELECT $sql_fields $fields_join $counts $myStates FROM $table $join $where $limit $group_by $order";

        // c($sql);
        return $this->pdo->query(
            $sql,
            $data,
            static::class,
            true
        );
    }

    public function getCount($where = null)
    {
        $select = $this->select(['id'], $where);
        return count($select);
    }

    public function getSelectedFields($selected_fields)
    {
        if (count($selected_fields) > 0) {
            $join = implode('`, `', $selected_fields);
            return '`' . $join . '`';
        }
        $table = $this::TABLE;
        return "$table.*";
    }

    // $join = ['likes', 'item_id']
    public function parseJoin($joins)
    {
        $str_join = '';
        if (count($joins) > 0) {
            foreach ($joins as $key => &$value) {
                $table = $value[5] ?? $this::TABLE;
                $table_join = $value[0];
                $field = $value[1];
                $is_user_id = (isset($value[4]) && $value[4]) ? $value[4] : 'id';
                $state = (isset($value[2]) && $value[2]) ? "AND $table_join.state=1" : '';
                $name_table  = (isset($value[3]) && $value[3]) ? "AND $table_join.name_table = '$table'" : '';
                $str_join .= " LEFT JOIN $table_join ON $table.$is_user_id = $table_join.$field $name_table $state ";
            }
            unset($value);
        }
        return $str_join;
    }

    public function parseMyState($myStates)
    {
        $str_join = '';
        $user = FUser::getId();

        if (count($myStates) > 0) {
            foreach ($myStates as $key => &$value) {
                $table = $this::TABLE;
                $table_join = $value[0];
                $field = $value[1];
                $str_join .= ", (SELECT $table_join.state FROM $table_join WHERE $table.id = $table_join.$field AND $table_join.user_id=$user AND $table_join.name_table = '$table') AS 'is_$table_join' ";
            }
            unset($value);
        }
        return $str_join;
    }

    public function parseFieldsJoin($fields_join)
    {
        $str_join = '';

        if (count($fields_join) > 0) {
            foreach ($fields_join as $key => &$value) {
                $table_join = $value[0];
                foreach ($value[1] as $key => &$value_field) {
                    $str_join .= $this->parseNameFieldsJoin($table_join, $value_field);
                }
                unset($value_field);
            }
            unset($value);
        }
        return $str_join;
    }

    private function parseNameFieldsJoin($table_join, $value_field)
    {
        if (strpos($value_field, ':')) {
            [$value_field, $name_field] = explode(':', $value_field);
        } else {
            $name_field = $table_join . '_' . $value_field;
        }
        return  ", $table_join.$value_field AS '$name_field' ";
    }

    public function parseCounts($counts)
    {
        $str_join = '';
        if (count($counts) > 0) {
            foreach ($counts as $key => &$value) {
                $table_join = $value[0];
                $field = $value[1];
                $str_join .= ", COUNT(DISTINCT $table_join.$field) AS 'count_$table_join' ";
            }
            unset($value);
        }
        return $str_join;
    }

    private function getResponseInsert($fields)
    {
        if (!$fields) {
            return [
                'id' => $this->getAttribute('id'),
                'link' => $this->getAttribute('link')
            ];
        }

        return array_intersect_key($this->attributes, array_flip($fields));
    }

    public function save($field_name = null, $is_update = false, $show = true, $class_link = null)
    {
        $saved_data = $this->insert($field_name, $is_update);
        $name = static::NAME;
        $link = $this->getLink($class_link, $saved_data);
        return $this->sendResponse("$name $link успешно создан(а)", $saved_data, 200, $show);
    }

    private function getLink($class_link, $saved_data)
    {
        $link = '';
        $class_link = ($class_link) ? $class_link : $this->getClassName();
        $class = lcfirst($class_link);

        if (isset($saved_data['link'])) {
            $value = $saved_data['link'];
            $link = "«<a href='/$class?id=$value'>$value</a>»";
        }
        return $link;
    }

    private function insert($selected_fields = null, $is_update = false)
    {
        try {
            $table = static::TABLE;
            $this->addUser('user_id');
            [
                'keys' => $keys,
                'values' => $values,
                'data' => $data
            ] = $this->parseAttributes();

            $sql = $this->getSqlInsert($table, $keys, $values, $is_update);
            $this->pdo->execute($sql, $data);
            $id = $this->pdo->getLastId();
            $this->checkId($id);
            $this->setAttribute('id', $id);

            return $this->getResponseInsert($selected_fields);
        } catch (\Throwable $th) {
            $this->checkErrorInsert($th);
        }
    }

    private function getSqlInsert($table, $keys, $values, $is_update)
    {
        $sql = "INSERT INTO $table ($keys) VALUES ($values)";
        if ($is_update) {
            $sql .= " ON DUPLICATE KEY UPDATE `state` = not `state`, datetime_update = CURRENT_TIMESTAMP";
        }
        return $sql;
    }

    private function checkErrorInsert($th)
    {
        if ($th->getCode() === "23000") {
            echo $this->sendResponse("Пользователь с данным email уже существует", [], 400);
            die;
        } else {
            header('HTTP/1.0 500');
            echo $this->sendResponse($th->getMessage(), [], 500);
            die;
        }
    }

    private function checkId($id)
    {
        if (!$id) {
            echo $this->sendResponse("Ошибка! Не удалось сохранить в базу данных", [], 400);
            die;
        }
    }

    private function getClassName()
    {
        return basename(get_class($this));
    }

    public function edit($field_name = null, $where = null)
    {
        return $this->update($field_name, $where);
    }

    public function update($field_name = null, $where = null)
    {
        try {
            $fields = $this->attributes;
            $table = static::TABLE;
            $data = [];
            $sets = [];
            $sql_where = ($where) ? "$where[0] = :$where[0]" : 'id = :id';

            if ($field_name) {
                if (is_array($field_name)) {
                    foreach ($field_name as $value) {
                        [$sets, $data] = $this->parseField($fields, $value, $data, $sets);
                    }
                } else {
                    [$sets, $data] = $this->parseField($fields, $field_name, $data, $sets);
                }
            } else {
                foreach ($fields as $name => $value) {
                    if ('id' != $name) {
                        $sets[] = "$name = :$name";
                    }
                    $data[":$name"] = $value;
                }
            }

            if ($where) {
                $data[":$where[0]"] = $where[1];
            } else {
                $data[":id"] = $fields['id'];
            }

            $sets = implode(', ', $sets);
            $sql = "UPDATE $table SET $sets, datetime_update=CURRENT_TIMESTAMP, `id` = LAST_INSERT_ID(`id`) WHERE $sql_where";

            $status = $this->pdo->execute($sql, $data);

            if ($status) {
                $this->sendResponse('Данные успешно изменены', []);
            } else {
                $this->sendResponse('Ошибка! Попробуте позже', [], 500);
            }
            return $status;
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

    private function parseField($fields, $field_name, $data, $sets)
    {
        $sets[] = "$field_name = :$field_name";
        $data[":$field_name"] = $fields[$field_name];
        return [$sets, $data];
    }

    public function response($value, $data = [], $message_success = "Success", $message_error = "Error")
    {
        if ($value) {
            return $this->sendResponse($message_success, $data);
        } else {
            return $this->sendResponse($message_error, $data, 500);
        }
    }

    public function sendResponse($message, $data = [], $status = 200, $show = true, $class = null)
    {
        if (!is_array($data)) {
            $data = array("data" => $data);
        }

        $response = [
            "status" => $status,
            'message' => $message,
            "data" => $data,
            'class' => $class ?? $this->getClassName()
        ];

        if ($show) {
            return FResponse::create($response);
        }
        return $response;
    }


    private function validatePassword($data, $is_validate_password)
    {
        if (!isset($data['password'])) {
            return;
        }

        if ($is_validate_password) {
            $confirm_password_key = $this::CONFIRM_PASSWORD_KEY;

            if (empty($_POST[$confirm_password_key])) {
                echo $this->sendResponse("Введите пароль два раза", [], 500);
                die;
            }
            if ($data['password'] !== $_POST[$confirm_password_key]) {
                echo $this->sendResponse("Пароли должны совпадать", [], 500);
                die;
            }
        }
    }

    private function validateEmail($data)
    {
        if (!isset($data['email'])) return;

        if (!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $data['email'])) {
            echo $this->sendResponse("Пожалуйста, введите корректный email", [], true);
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

    public function addAttribute($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    public function setAttribute($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    public function getAttribute($key)
    {
        return (isset($this->attributes[$key])) ? $this->attributes[$key] : null;
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
            $attributes = array_intersect_key($filter, $attributes);
        }

        $cols = [];
        $data = [];
        $where = [];

        foreach ($attributes as $key => $value) {
            $is_datetime = $this->rules[$key]['type'] === 'datetime' && !$value;

            if (!$filter && ('id' == $key || $is_datetime)) {
                continue;
            }

            $cols[] = $key;
            $data[":$key"] = $value;
            if (count($filter)) {
                $where[] = "`$key`=:$key";
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
