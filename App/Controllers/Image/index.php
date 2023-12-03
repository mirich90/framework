<?php

namespace App\Controllers\Image;

use App\Core\Controller;
use App\Db;

class index extends Controller
{
  protected function construct()
  {
    $this->view->display('Image/index');
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
