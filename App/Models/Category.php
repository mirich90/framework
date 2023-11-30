<?php

namespace App\Models;

use App\Core\Model;

class Category extends Model
{
  const TABLE = 'categories';

  public $attributes = [
    'id' => '',
    'index' => '',
    'name' => '',
    'description' => '',
  ];

  public $rules = [
    'id' => ['type' => 'int', 'length' => 11, 'required' => false, 'auto_increment' => true, 'primary_key' => true, 'not_null' => true],
    'index' => ['type' => 'varchar', 'length' => 255, 'lengthMin' => 2, 'not_null' => true],
    'name' => ['type' => 'varchar', 'length' => 255, 'lengthMin' => 2, 'not_null' => true],
    'description' => ['type' => 'varchar', 'length' => 255, 'lengthMin' => 2, 'not_null' => true],
  ];
}
