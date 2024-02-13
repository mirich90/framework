<?php

namespace App\Controllers\Note;

use App\Core\Controller;

class index extends Controller
{
  protected function construct()
  {
    $Note = new \App\Models\Note();

    $this->view->notes = $Note->select();

    $this->view->display('Note/index');
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
