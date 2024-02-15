<?php

namespace App\Models;

use App\Core\Model;

class Image extends Model
{
  const TABLE = 'images';
  const NAME = 'Картинка';

  public $attributes = [
    'id' => NULL,
    'title' => '',
    'link' => '',
    'src' => '',
    'filetype' => '',
    'user_id' => '',
    'category_id' => 1,
    'datetime' => NULL,
    'datetime_update' => NULL,
    'is_delete' => 0,
    'is_show' => 0,
    'is_public' => 0,
  ];

  public $rules = [
    'id' => ['type' => 'int', 'length' => 11, 'auto_increment' => true, 'primary_key' => true, 'not_null' => true],
    'title' => ['type' => 'varchar', 'length' => 255, 'lengthMin' => 2, 'required' => true, 'not_null' => true],
    'filetype' => ['type' => 'varchar', 'length' => 5, 'lengthMin' => 2, 'required' => true, 'not_null' => true],
    'category_id' => ['type' => 'int', 'length' => 11, 'not_null' => true, 'required' => true],
    'link' => ['type' => 'varchar', 'length' => 255, 'lengthMin' => 2, 'not_null' => true, 'function' => ['translitLink', 'title']],
    'src' => ['type' => 'varchar', 'length' => 255, 'lengthMin' => 2],
    'user_id' => ['type' => 'int', 'length' => 11, 'not_null' => true],
    'datetime' => ['type' => 'datetime', 'not_null' => true],
    'datetime_update' => ['type' => 'datetime', 'not_null' => true],
    'is_delete' => ['type' => 'tinyint', 'length' => 1, 'not_null' => true],
    'is_show' => ['type' => 'tinyint', 'length' => 1, 'not_null' => true],
    'is_public' => ['type' => 'tinyint', 'length' => 1, 'not_null' => true],
  ];
}
