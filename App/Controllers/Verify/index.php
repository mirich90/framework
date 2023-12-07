<?php

namespace App\Controllers\Verify;

use App\Core\Controller;
use App\Db;

class index extends Controller
{
  protected function construct()
  {
    $UsersSecretData = new \App\Models\UsersSecretData();
    $this->verify($UsersSecretData);
  }


  private function verify($UsersSecretData)
  {
    $UsersSecretData->Verify();
  }

  protected function title()
  {
    return "Заметки сайта Indyground";
  }

  protected function description()
  {
    return "Indyground - сайт о создателях игр, музыки, графики и всего осталнього творчества";
  }

  protected function keywords()
  {
    return "Indyground, инди, RPG maker";
  }

  protected function author()
  {
    return "Yuryol";
  }
}
