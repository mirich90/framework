<?php

namespace App\Controllers\Registration;

use App\Core\Controller;
use App\Db;

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
    $UsersSecretData->save();
    $UsersSecretData->sendMailRegistration('email', 'activation_code');
    redirect();
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
