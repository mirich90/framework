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
    $response = $Like->save('state', true, false);

    $Like->attributes['state'] = 1;
    $count = $Like->getCount(['name_table', 'item_id', 'state']);
    $isMyLike = $Like->getCount(['name_table', 'item_id', 'state', 'user_id']);

    $response["data"]['count'] =  $count;
    $response["data"]['state'] =  $isMyLike;
    // var_dump($response);
    // var_dump($Like->createResponse($response));
    // die;
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
