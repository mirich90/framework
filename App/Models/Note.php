<?php

namespace App\Models;

use App\Core\Model;

class Note extends Model
{
  const TABLE = 'notes';
  const NAME = 'Заметка';

  public $attributes = [
    'id' => NULL,
    'title' => '',
    'content' => '',
    'link' => '',
    'datetime' => NULL,
    'datetime_update' => NULL,
    'is_delete' => 0,
  ];

  public $rules = [
    'id' => ['type' => 'int', 'length' => 11, 'auto_increment' => true, 'primary_key' => true, 'not_null' => true],
    'title' => ['type' => 'varchar', 'length' => 255, 'lengthMin' => 2, 'required' => true, 'not_null' => true],
    'link' => ['type' => 'varchar', 'length' => 255, 'lengthMin' => 2, 'not_null' => true, 'function' => ['translitLink', 'title']],
    'content' => ['type' => 'varchar', 'length' => 1024, 'lengthMin' => 20],
    'datetime' => ['type' => 'datetime', 'not_null' => true],
    'datetime_update' => ['type' => 'datetime', 'not_null' => true],
    'is_delete' => ['type' => 'tinyint', 'length' => 1, 'not_null' => true],
  ];
}
