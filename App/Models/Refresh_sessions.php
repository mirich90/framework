<?php

namespace App\Models;

use App\Core\Model;

class Refresh_sessions extends Model
{
  const TABLE = 'refresh_sessions';

  public $attributes = [
    'id' => NULL,
    'user_id' => '',
    'refresh_token' => '',
    'server_finger_print' => '',
    'finger_print' => '',
    'datetime' => NULL,
  ];

  public $rules = [
    'id' => ['type' => 'int', 'length' => 11, 'auto_increment' => true, 'primary_key' => true, 'not_null' => true],
    'user_id' => ['type' => 'int', 'length' => 11, 'not_null' => true],
    'refresh_token' => ['type' => 'varchar', 'length' => 400, 'required' => true, 'not_null' => true],
    'finger_print' => ['type' => 'varchar', 'length' => 1500, 'required' => true, 'not_null' => true],
    'server_finger_print' => ['type' => 'varchar', 'length' => 1000, 'required' => true, 'not_null' => true],
    'datetime' => ['type' => 'datetime', 'not_null' => true],
  ];
}
