<?php

namespace App\Controllers\Profile;

use App\Core\Controller;
use App\Db;
use App\Functions\FUser;

class update extends Controller
{
  public function access(): bool
  {
    if (!FUser::isLogin()) {
      redirect('/login');
      die;
    }

    return true;
  }

  protected function construct()
  {
    $this->view->display('Profile/update');
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
