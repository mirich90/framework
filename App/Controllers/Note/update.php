<?php

namespace App\Controllers\Note;

use App\Core\Controller;
use App\Db;

class update extends Controller
{
  protected function construct()
  {
    if ($this->check_response(['submit'])) {
      $this->update();
      die;
    }

    $Note = new \App\Models\Note();
    $this->view->note = $Note->selectOne($_GET['id'], 'link', ['title', 'content', 'link']);
    $this->view->display('Note/update');
  }

  private function update()
  {
    $Note = new \App\Models\Note();
    $Note->load($_POST);
    $Note->validate($_POST);
    $is_edit = $Note->edit(['title', 'content'], ['link', $_GET['id']]);

    if ($is_edit) {
      $Note->createResponse([
        "status" => 200,
        'message' => "Заметка успешно отредактирована",
        "data" => [],
        'class' => 'Note'
      ]);

      redirect('/note?update&id=' . $_GET['id']);
    }
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
