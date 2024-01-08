<?php

namespace App\Controllers\Like;

use App\Core\Controller;
use App\Db;

class create extends Controller
{
  protected function construct()
  {
    $Like = new \App\Models\Like();

    if ($Like->check_response(['submit'])) {
      $this->create($Like);
    }
  }


  private function create($Like)
  {
    $Like->load($_POST);
    $Like->validate($_POST);
    echo $Like->save('state', true);
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
