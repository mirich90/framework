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
    $Category = new \App\Models\Category();

    $categories = [];
    $data = $Category->select(['id', 'name']);
    foreach ($data as ['id' => $id, 'name' => $name]) {
      $categories[] = [$id, $name];
    }

    $this->view->note = $Note->selectOne(
      ['title', 'content', 'link', 'category_id'],
      ['link' => $_GET['id']]
    );
    $this->view->categories = $categories;
    $this->view->display('Note/update');
  }

  private function update()
  {
    $id = $_GET['id'];
    $Note = new \App\Models\Note();
    $Note->load($_POST);
    $Note->validate($_POST);
    $is_edit = $Note->edit(['title', 'content', 'category_id'], ['link', $id]);

    if ($is_edit) {
      $title = $_POST['title'];
      $link = "«<a href='/note?id=$id'>$title</a>»";
      $Note->createResponse([
        "status" => 200,
        'message' => "Заметка $link успешно отредактирована",
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
