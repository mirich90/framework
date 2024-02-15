<?php

namespace App\Controllers\Image;

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

    $this->view->display('Image/create');
  }

  private function create()
  {
    $Image = new \App\Models\Image();
    $Image->load($_POST);
    $Image->validate($_POST);
    $Image->save('link');

    redirect('/image?create');
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
