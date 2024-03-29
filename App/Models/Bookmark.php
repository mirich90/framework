<?php

namespace App\Models;

use App\Core\Model;

class Bookmark extends Model
{
  const TABLE = 'bookmarks';
  const NAME = 'Закладка';

  public $attributes = [
    'id' => NULL,
    'name_table' => '',
    'item_id' => '',
    'user_id' => '',
    'datetime' => NULL,
    'datetime_update' => NULL,
    'state' => 1,
  ];

  public $rules = [
    'id' => ['type' => 'int', 'length' => 11, 'auto_increment' => true, 'primary_key' => true, 'not_null' => true],
    'name_table' => ['type' => 'varchar', 'length' => 255, 'lengthMin' => 2, 'required' => true, 'not_null' => true, 'unique' => true],
    'item_id' => ['type' => 'int', 'length' => 11, 'not_null' => true, 'unique' => true],
    'user_id' => ['type' => 'int', 'length' => 11, 'not_null' => true, 'unique' => true],
    'datetime' => ['type' => 'datetime', 'not_null' => true],
    'datetime_update' => ['type' => 'datetime', 'not_null' => true],
    'state' => ['type' => 'tinyint', 'length' => 1, 'not_null' => true],
  ];
}
