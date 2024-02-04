<?php

namespace App\Controllers\Profile;

use App\Core\Controller;
use App\Db;

class index extends Controller
{
  protected function construct()
  {
    $UsersInfo = new \App\Models\UsersInfo();
    $this->view->note = $UsersInfo->selectOne($_GET['id'], 'link');

    $this->view->display('Profile/show');
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
