<?php

namespace App\Controllers\Logout;

use App\Core\Controller;

class index extends Controller
{
  protected function construct()
  {
    if ($this->check_response(['submit'])) {
      $this->logout();
    }
    redirect('/login');
  }

  private function logout()
  {
    session_destroy();
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
