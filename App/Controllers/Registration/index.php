<?php

namespace App\Controllers\Registration;

use App\Core\Controller;
use App\Functions\FJWT;
use App\Models\UsersInfo;

class index extends Controller
{
  protected function construct()
  {

    if ($this->check_response(['submit'])) {
      $this->create();
      die;
    }

    $this->view->display('auth/registration');
  }

  private function create()
  {
    $UsersSecretData = new \App\Models\UsersSecretData();
    $email = $UsersSecretData->attributes['email'];
    $response = $this->createUsersSecretData($UsersSecretData);
    $responseInfo = $this->createUsersInfo($response);
    $token_info = $this->createRefreshToken($email, $response);

    $responseInfo["data"] = array_merge($responseInfo["data"], $token_info, ['email' => $email]);

    $UsersSecretData->sendMailRegistration('email', 'activation_code');

    $this->setUserSession($responseInfo["data"]);

    echo $UsersSecretData->createResponse($responseInfo, getControllerName());
  }

  private function createUsersSecretData($UsersSecretData)
  {
    $UsersSecretData->load($_POST);
    $UsersSecretData->validate($_POST, true);
    return $UsersSecretData->save(null, false, false);
  }

  private function createUsersInfo($response)
  {
    $data = ['user_id' => $response["data"]['id']];
    $UsersInfo = new \App\Models\UsersInfo();
    $UsersInfo->load($data);
    $UsersInfo->validate($data);
    $response_info = $UsersInfo->save(null, false, false, 'profile');
    $info_id = $response_info["data"]["id"];
    $user_info = $UsersInfo->selectOne($info_id, 'id', ['username', 'link', 'avatar', 'city', 'info', 'info', 'role', 'status', 'datetime', 'user_id']);
    $response_info['data'] = $user_info;
    return $response_info;
  }

  private function createRefreshToken($email, $response)
  {
    $JWT = new FJWT;
    $finger_print = $_POST['fp_1'];
    $user_id = $response['data']['id'];

    $header = '{"typ":"JWT", "alg":"HS256"}';
    $refresh_key = env('refresh_token_secret_key');
    $access_key = env('access_token_secret_key');

    $payload = array(
      'id' => $user_id,
      'email' => $email,
    );
    $access_token = $JWT->encode($header, $payload, $refresh_key);
    $refresh_token = $JWT->encode($header, $payload, $access_key);
    // $json = $JWT->decode($token, $key);

    $this->saveRefreshTokenInBd($user_id, $finger_print, $refresh_token);

    $access_token_expiration = 60 * 60 * 24 * 10; // 10 days
    $refresh_token_expiration = 60 * 10; // 10 minuts

    setCookie(
      'refreshToken',
      $refresh_token,
      time() + $refresh_token_expiration,
      "/",
      env('domain_site'),
      false,
      true
    );

    return array(
      'accessToken' => $access_token,
      'accessTokenExpiration' => $access_token_expiration
    );
  }

  private function saveRefreshTokenInBd($user_id, $finger_print, $refresh_token)
  {
    $data_refresh_token = [
      'user_id' => $user_id,
      'finger_print' => $finger_print,
      'server_finger_print' => $this->getServerFingerPrint(),
      'refresh_token' => $refresh_token,
    ];

    $Refresh_sessions = new \App\Models\Refresh_sessions();
    $Refresh_sessions->load($data_refresh_token);
    $Refresh_sessions->validate($data_refresh_token);
    $Refresh_sessions->save(null, false, false);
  }

  private function getServerFingerPrint()
  {
    $finger_print = array(
      'REMOTE_ADDR' => $_SERVER['REMOTE_ADDR'],
      'HTTP_USER_AGENT' => $_SERVER['HTTP_USER_AGENT']
    );
    $json = json_encode($finger_print);
    $encode = base64_encode($json);
    return $encode;
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
