<?php

namespace App\Controllers\Note;

use App\Core\Controller;

class index extends Controller
{
  protected function construct()
  {
    $Note = new \App\Models\Note();
    $Category = new \App\Models\Category();
    $category_link = (isset($_GET['category'])) ? $_GET['category'] : null;
    $category = $this->getCategoryId($Category, $category_link);
    $join = [
      ['likes', 'item_id', 'state', 'name_table '],
      ['bookmarks', 'item_id', 'state', 'name_table'],
      ['info_users', 'user_id', null, null, 'user_id'],
      ['images', 'id',  null, null, 'avatar', 'info_users'],
    ];
    $counts = [
      ["likes", "user_id"],
      ["bookmarks", "user_id"]
    ];
    $fields_join = [
      ["info_users", ["link", "avatar", "username"]],
      ["images", ["link:info_users_avatar"]],
    ];
    $myStates = [["likes", "item_id"], ["bookmarks", "item_id"]];

    $categories = $Category->select(['id', 'name', 'link']);
    $categories_filter = [];
    foreach ($categories as ['id' => $id, 'name' => $name]) {
      $categories_filter[] = [$id, $name];
    }
    $notes = $Note->select([], $category, '', $_GET, $join, $counts, $myStates, $fields_join);

    $this->view->category = $category_link;
    $this->view->categories = $categories;
    $this->view->categories_filter = $categories_filter;
    $this->view->notes = $notes;
    $this->view->sort_name = $this->getSortName();
    $this->view->display('Note/index');
  }

  private function getCategoryId($Category, $category)
  {
    if ($category) {
      $category_id = $Category->selectOne(['id'], ['link' => $category]);
      return ['category_id' => $category_id["id"]];
    } else {
      return [];
    }
  }

  private function getSortName()
  {
    $names = [
      "updatedown" => 'По дате ↓',
      "updateup" => 'По дате ↑',
      "titledown" => 'По названию ↓',
      "titleup" => 'По названию ↑',
      "likedown" => 'По лайкам ↓',
      "likeup" => 'По лайкам ↑',
      "bookmarkdown" => 'По закладкам ↓',
      "bookmarkup" => 'По закладкам ↑'
    ];

    if (!isset($_GET['sort'])) {
      return $names["updatedown"];
    }
    return $names[$_GET['sort']];
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
