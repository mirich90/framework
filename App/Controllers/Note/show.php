<?php

namespace App\Controllers\Note;

use App\Core\Controller;
use App\Db;

class show extends Controller
{
  protected function construct()
  {
    $this->view->display('Note/show');
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
