<?php

namespace App\Controllers\Note;

use App\Core\Controller;
use App\Db;

class create extends Controller
{
  protected function construct()
  {
    if ($this->check_response(['submit'])) {
      $this->create();
      die;
    }

    $categories = [];
    $Category = new \App\Models\Category();
    $data = $Category->select(['id', 'name']);

    foreach ($data as ['id' => $id, 'name' => $name]) {
      $categories[] = [$id, $name];
    }

    $this->view->categories = $categories;
    $this->view->display('Note/create');
  }

  private function create()
  {
    $Note = new \App\Models\Note();
    $Note->load($_POST);
    $Note->validate($_POST);
    $Note->save(['link']);

    redirect('/note?create');
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
