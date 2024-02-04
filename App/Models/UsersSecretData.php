<?php

namespace App\Models;

use App\Core\Model;

class UsersSecretData extends Model
{
  const TABLE = 'users_secret_data';
  const NAME = 'Пользователь';
  const CONFIRM_PASSWORD_KEY = 'password2';

  public $attributes = [
    'id' => NULL,
    'login' => '',
    'email' => '',
    'is_activated' => 0,
    'activation_code' => '',
    'fpassword_key' => '',
    'password' => '',
    'registration' => NULL,
    'datetime' => NULL,
    'datetime_update' => NULL,
    'is_delete' => 0
  ];

  public $rules = [
    'id' => [
      'type' => 'int',
      'length' => 11,
      'auto_increment' => true,
      'primary_key' => true,
      'not_null' => true
    ],
    'login' => ['type' => 'varchar', 'length' => 255, 'lengthMin' => 2, 'required' => true, 'not_null' => true],
    'email' => [
      'type' => 'varchar',
      'length' => 255,
      'lengthMin' => 2,
      'required' => true,
      'not_null' => true,
      'unique' => true
    ],
    'is_activated' => ['type' => 'tinyint', 'length' => 1, 'not_null' => true],
    'activation_code' => [
      'type' => 'varchar',
      'length' => 16,
      'lengthMin' => 2,
      'required' => true,
      'not_null' => true,
      'function' => ['generateCode']
    ],
    'fpassword_key' => [
      'type' => 'varchar',
      'length' => 128,
      'lengthMin' => 2,
      'required' => true,
      'not_null' => true
    ],
    'password' => [
      'type' => 'varchar',
      'length' => 255,
      'lengthMin' => 2,
      'required' => true,
      'not_null' => true,
      'function' => ['securing', 'password']
    ],
    'registration' => ['type' => 'datetime', 'not_null' => true],
    'datetime' => ['type' => 'datetime', 'not_null' => true],
    'datetime_update' => ['type' => 'datetime', 'not_null' => true],
    'is_delete' => ['type' => 'tinyint', 'length' => 1, 'not_null' => true]
  ];

  public function login()
  {
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    $password = !empty($_POST['password']) ? $_POST['password'] : null;

    if ($email && $password) {
      $user = $this->find(['email'], [$this->attributes['email']]);
      if ($user) {
        if (password_verify($password, $user['password'])) {
          unset($_SESSION['user']);
          $_SESSION['user'] = ['email' => $user['email'], 'id' => $user['id']];
          return true;
        }
      }
    }
    return false;
  }

  public function sendMailRegistration($keyEmail, $keyCode)
  {
    $config = env('mail');
    $url_site = env('url_site');

    $site_email = $config['site_email'];
    $message_verification = $config['message_verification'];
    $message_verification_code =  $config['message_verification_code'];
    $message_verification_link =  $config['message_verification_link'];

    $email = $this->attributes[$keyEmail];
    $code = $this->attributes[$keyCode];
    $subject = $message_verification . $url_site;
    $body = "$message_verification_code $code <br>$message_verification_link <a href='$url_site/verify.php?email=$email&code=$code'>verify.php?email=$email&code=$code</a>.";

    $message_success = "Письмо на почту $email успешно отправлено. Пройдите по ссылке в письме для активации аккаунта";
    $message_error = 'Ошибка! Письмо не отправлено';

    $this->sendMail($email, $site_email, $subject, $body, $message_success, $message_error);
  }

  public function Verify()
  {

    if (isset($_GET['email']) && isset($_GET['code'])) {

      $email = htmlspecialchars($_GET['email']);
      $activation_code = htmlspecialchars($_GET['code']);

      $user = $this->find(['email', 'activation_code', 'is_activated'], [$email, $activation_code, 0]);

      if (count($user) > 0) {
        $this->load($user);
        $this->attributes['is_activated'] = 1;
        $status = $this->edit('is_activated');
        if ($status) {
          $this->sendResponse("Учетная запись успешно активирована. Теперь вы можете войти на сайт", []);
          redirect('/login');
          die;
        }
      }

      $this->sendResponse("Пользователь с данным электронным адресом уже активирован, не существует или код неверен", [], 500);
      redirect('/login');
    }
  }
}
