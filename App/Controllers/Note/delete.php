<?php

namespace App\Controllers\Note;

use App\Core\Controller;
use App\Db;
use App\Functions\FAuth;

class delete extends Controller
{
  public function access(): bool
  {
    return true;
  }

  protected function construct()
  {
    $this->view->display('Note/delete');
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
