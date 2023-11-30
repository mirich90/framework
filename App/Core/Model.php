<?php

namespace App\Core;


abstract class Model
{

    const TABLE = '';
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
                $this->attributes[$key] = $data[$key];
            }
        }
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

            $fields .= "`$key` $type($length) $not_null $auto_increment, ";

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
}
