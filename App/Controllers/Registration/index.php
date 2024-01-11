<?php

namespace App\Controllers\Registration;

use App\Core\Controller;
use App\Functions\FJWT;

class index extends Controller
{
  protected function construct()
  {
    $UsersSecretData = new \App\Models\UsersSecretData();
    if ($UsersSecretData->check_response(['submit'])) {
      $this->create($UsersSecretData);
    }

    $this->view->display('auth/registration');
  }


  private function create($UsersSecretData)
  {
    $UsersSecretData->load($_POST);
    $UsersSecretData->validate($_POST, true);
    $UsersSecretData->checkUnique('email');
    $response = $UsersSecretData->save(null, false, false);
    $this->createRefreshToken($UsersSecretData, $response);

    $UsersSecretData->sendMailRegistration('email', 'activation_code');
    redirect();
  }

  private function createRefreshToken($UsersSecretData, $response)
  {

    $JWT = new FJWT;
    $finger_print = $_POST['fp'];
    $user_id = $response['data']['id'];
    // $finger_print = base64_decode($decoded_fingerprint);
    $header = '{"typ":"JWT", "alg":"HS256"}';
    $refresh_key = env('refresh_token_secret_key');
    $access_key = env('access_token_secret_key');

    $payload = array(
      'id' => $user_id,
      'exp' => 15,
      'email' => $UsersSecretData->attributes['email'],
    );
    $access_token = $JWT->encode($header, $payload, $refresh_key);

    $expires = 60 * 60 * 24 * 10; // 10days
    $payload = array(
      'id' => $user_id,
      'exp' => $expires,
      'email' => $UsersSecretData->attributes['email'],
    );
    $refresh_token = $JWT->encode($header, $payload, $access_key);
    // $json = $JWT->decode($token, $key);

    $data_refresh_token = [
      'user_id' => $user_id,
      'finger_print' => $finger_print,
      'refresh_token' => $refresh_token,
    ];
    $Refresh_sessions = new \App\Models\Refresh_sessions();
    $Refresh_sessions->load($data_refresh_token);
    $Refresh_sessions->validate($data_refresh_token);
    $response = $Refresh_sessions->save(null, false, false);

    setcookie(
      'refreshToken',
      $refresh_token,
      time() + $expires,
      "",
      "",
      false,
      false
    );
  }

  protected function title()
  {
    return "Создание заметки";
  }

  protected function description()
  {
    return "Создание заметки";
  }

  protected function keywords()
  {
    return "заметка, журнал";
  }

  protected function author()
  {
    return "Username";
  }
}
