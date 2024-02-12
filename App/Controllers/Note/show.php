<?php

namespace App\Controllers\Note;

use App\Core\Controller;
use App\Db;

class show extends Controller
{
  protected function construct()
  {
    $Note = new \App\Models\Note();
    $note = $Note->selectOne(
      $_GET['id'],
      'link',
      ['title', 'content', 'datetime', 'link', 'category_id']
    );

    $Category = new \App\Models\Category();
    $data = $Category->selectOne($note['category_id'], 'id', ['index', 'name']);
    $category = ['category' => $data['name'], 'category_link' => $data['index']];
    $this->view->note = $note;
    $this->view->category = $category;

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
