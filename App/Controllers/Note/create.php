<?php

namespace App\Controllers\Note;

use App\Core\Controller;
use App\Db;

class create extends Controller
{
  protected function construct()
  {
    $Note = new \App\Models\Note();

    if ($Note->check_response(['title', 'text'])) {
      $this->create($Note);
    }

    $this->view->display('Note/create');
  }


  private function create($Note)
  {
    $Note->load($_POST);
    $Note->validate($_POST);

    $Note->save('link');
  }

  protected function title()
  {
    return "Создание заметки";
  }

  protected function description()
  {
    return "Создание заметки";
  }

  protected function keywords()
  {
    return "заметка, журнал";
  }

  protected function author()
  {
    return "Username";
  }
}
