<?php

namespace App\Controllers\Bookmark;

use App\Core\Controller;
use App\Functions\FAuth;
use App\Functions\FResponse;
use App\Functions\FUser;

class create extends Controller
{
  public function access(): bool
  {
    FAuth::isLoginApi();
    return true;
  }

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
    $bookmark = $Bookmark->attributes;

    $response = $Bookmark->save(['state'], true, false);

    $count = $Bookmark->getCount([
      'item_id' => $bookmark['item_id'],
      'name_table' => 'notes',
      'state' => 1
    ]);

    $isMyBookmark = $Bookmark->getCount([
      'item_id' => $bookmark['item_id'],
      'name_table' => 'notes',
      'state' => 1,
      'user_id' => FUser::getId()
    ]);

    $response["data"]['count'] =  $count;
    $response["data"]['state'] =  $isMyBookmark;

    echo FResponse::create($response);
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
