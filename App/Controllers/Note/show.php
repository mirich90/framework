<?php

namespace App\Controllers\Note;

use App\Core\Controller;
use App\Db;
use App\Functions\FUser;

class show extends Controller
{
  protected function construct()
  {
    $note = $this->getNote();

    $this->view->note = $note;
    $this->view->author = $this->getAuthor($note);
    $this->view->category = $this->getCategory($note);
    $this->view->is_likes = $this->getMyLike($note);
    $this->view->count_likes = $this->getCountLike($note);
    $this->view->is_bookmarks = $this->getMyBookmark($note);
    $this->view->count_bookmarks = $this->getCountBookmark($note);
    $this->view->display('Note/show');
  }

  private function getNote()
  {
    $Note = new \App\Models\Note();

    return $Note->selectOne(
      ['title', 'content', 'datetime', 'link', 'category_id', 'user_id', 'id'],
      ['link' => $_GET['id']]
    );
  }

  private function getAuthor($note)
  {
    $UsersInfo = new \App\Models\UsersInfo();
    $author = $UsersInfo->selectOne(
      ['username', 'link', 'avatar', 'id'],
      ['user_id' => $note['user_id']]
    );
    $author = $UsersInfo->addUrlAvatar($author);

    return [
      'author_username' => $author['username'],
      'author_link' => $author['link'],
      'author_id' => $author['id'],
      'author_avatar' => $author['avatar_url']
    ];
  }

  private function getMyLike($note)
  {
    $Like = new \App\Models\Like();

    $is_like = $Like->getCount([
      'item_id' => $note['id'],
      'name_table' => 'notes',
      'state' => 1,
      'user_id' => FUser::getId()
    ]);
    return ['is_likes' => $is_like];
  }

  private function getCountLike($note)
  {
    $Like = new \App\Models\Like();
    $count_like = $Like->getCount([
      'item_id' => $note['id'],
      'name_table' => 'notes',
      'state' => 1,
    ]);
    return ['count_likes' => $count_like];
  }

  private function getCountBookmark($note)
  {
    $Bookmark = new \App\Models\Bookmark();
    $count_bookmark = $Bookmark->getCount([
      'item_id' => $note['id'],
      'name_table' => 'notes',
      'state' => 1,
    ]);

    return ['count_bookmarks' => $count_bookmark];
  }

  private function getMyBookmark($note)
  {
    $Bookmark = new \App\Models\Bookmark();

    $is_bookmark = $Bookmark->getCount([
      'item_id' => $note['id'],
      'name_table' => 'notes',
      'state' => 1,
      'user_id' => FUser::getId()
    ]);
    return ['is_bookmarks' => $is_bookmark];
  }

  private function getCategory($note)
  {
    $Category = new \App\Models\Category();
    $category = $Category->selectOne(['link', 'name'], ['id' => $note['category_id']]);
    return ['category' => $category['name'], 'category_link' => $category['link']];
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
