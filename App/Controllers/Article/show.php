<?php

namespace App\Controllers\Article;

use App\Core\Controller;
use App\Db;
use App\Functions\FJWT;

class show extends Controller
{
  protected function construct()
  {
    // $Refresh_sessions->create_table();
    $Bookmark = new \App\Models\Bookmark();
    $this->view->display('article/show');
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
