<?php

namespace App\Models;

use App\Core\Model;

class UsersInfo extends Model
{
  const TABLE = 'info_users';
  const NAME = 'Пользователь';

  public $attributes = [
    'id' => NULL,
    'user_id' => '',
    'username' => '',
    'link' => '',
    'avatar' => NULL,
    'city' => '',
    'info' => '',
    'role' => 0,
    'status' => 0,
    'datetime' => NULL,
    'datetime_update' => NULL,
  ];

  public $rules = [
    'id' => [
      'type' => 'int',
      'length' => 11,
      'auto_increment' => true,
      'primary_key' => true,
      'not_null' => true
    ],
    'user_id' => ['type' => 'int', 'length' => 11, 'not_null' => true, 'unique' => true],
    'username' => [
      'type' => 'varchar',
      'length' => 50,
      'lengthMin' => 2,
      'required' => true,
      'not_null' => true,
      'function' => ['generateCode']
    ],
    'avatar' => ['type' => 'int', 'length' => 11],
    'city' => ['type' => 'varchar', 'length' => 200, 'lengthMin' => 2, 'not_null' => true],
    'info' => ['type' => 'varchar', 'length' => 255, 'lengthMin' => 2, 'not_null' => true],
    'link' => [
      'type' => 'varchar',
      'length' => 50,
      'lengthMin' => 2,
      'required' => true,
      'not_null' => true,
      'function' => ['generateCode']
    ],
    'role' => ['type' => 'tinyint', 'length' => 2, 'not_null' => true],
    'status' => ['type' => 'tinyint', 'length' => 2, 'not_null' => true],
    'datetime' => ['type' => 'datetime', 'not_null' => true],
    'datetime_update' => ['type' => 'datetime', 'not_null' => true],
  ];

  public function addUrlAvatar($usersInfo)
  {
    $Image = new \App\Models\Image();
    $image = $Image->selectOne(
      ['link'],
      ['id' => $usersInfo['avatar']]
    );
    $usersInfo['avatar_url'] = $image['link'];
    return $usersInfo;
  }
}
