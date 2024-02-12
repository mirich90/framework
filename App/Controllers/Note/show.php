<?php

namespace App\Controllers\Note;

use App\Core\Controller;
use App\Db;
use App\Functions\FUser;

class show extends Controller
{
  protected function construct()
  {
    $this->view->note = $this->getNote();
    $this->view->category = $this->getCategory($this->view->note);
    $this->view->is_like = $this->getMyLike($this->view->note);

    $this->view->display('Note/show');
  }

  private function getNote()
  {
    $Note = new \App\Models\Note();
    return $Note->selectOne(
      ['title', 'content', 'datetime', 'link', 'category_id', 'id'],
      ['link' => $_GET['id']]
    );
  }

  private function getMyLike($note)
  {
    $Like = new \App\Models\Like();
    $fields = [
      'item_id' => $note['id'],
      'name_table' => 'notes',
      'user_id' => FUser::getId()
    ];

    $like = $Like->selectOne(
      ['state'],
      $fields
    );

    $is_like = ($like) ? $like['state'] : 0;

    return ['is_like' =>  $is_like];
  }

  private function getCategory($note)
  {
    $Category = new \App\Models\Category();
    $category = $Category->selectOne(['index', 'name'], ['id' => $note['category_id']]);
    return ['category' => $category['name'], 'category_link' => $category['index']];
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
