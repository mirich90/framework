<?php

namespace App\Controllers\Profile;

use App\Core\Controller;
use App\Db;
use App\Functions\FUser;

class index extends Controller
{
  protected function construct()
  {
    $UsersInfo = new \App\Models\UsersInfo();
    $this->view->user = $UsersInfo->selectOne(FUser::getId(), 'user_id');

    $this->view->display('Profile/index');
  }

  protected function title()
  {
    return "Indyground";
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
