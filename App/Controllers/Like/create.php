<?php

namespace App\Controllers\Like;

use App\Core\Controller;
use App\Db;
use App\Functions\FUser;

class create extends Controller
{
  protected function construct()
  {
    if ($this->check_response(['submit'])) {
      $this->create();
    }
  }

  private function create()
  {
    $Like = new \App\Models\Like();
    $Like->load($_POST);
    $Like->validate($_POST);
    $like = $Like->attributes;

    $response = $Like->save(['state'], true, false);

    $count = $Like->getCount([
      'item_id' => $like['item_id'],
      'name_table' => 'notes',
      'state' => 1
    ]);

    $isMyLike = $Like->getCount([
      'item_id' => $like['item_id'],
      'name_table' => 'notes',
      'state' => 1,
      'user_id' => FUser::getId()
    ]);

    $response["data"]['count'] =  $count;
    $response["data"]['state'] =  $isMyLike;

    echo $Like->createResponse($response);
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
