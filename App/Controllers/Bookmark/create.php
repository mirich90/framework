<?php

namespace App\Controllers\Bookmark;

use App\Core\Controller;
use App\Db;

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
    $Bookmark = new \App\Models\Bookmark();
    $Bookmark->load($_POST);
    $Bookmark->validate($_POST);
    $response = $Bookmark->save('state', true, false);

    $Bookmark->attributes['state'] = 1;
    $count = $Bookmark->getCount(['name_table', 'item_id', 'state']);
    $isMyBookmark = $Bookmark->getCount(['name_table', 'item_id', 'state', 'user_id']);

    $response["data"]['count'] =  $count;
    $response["data"]['state'] =  $isMyBookmark;
    $response["data"]['user'] =  $Bookmark->attributes['user_id'];
    // var_dump($response);
    // var_dump($Like->createResponse($response));
    // die;
    echo $Bookmark->createResponse($response);
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
