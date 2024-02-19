<?php

namespace App\Controllers\Profile;

use App\Core\Controller;
use App\Db;

class show extends profile
{
  protected function construct()
  {
    $usersInfo = $this->getUsersInfo();
    $userSecret = $this->getUserSecret($usersInfo);
    $count_notes = $this->getCountNotes($usersInfo);
    $count_images = $this->getCountImages($usersInfo);

    $this->view->user = array_merge($userSecret, $usersInfo);
    $this->view->count_notes = $count_notes;
    $this->view->count_images = $count_images;

    $this->view->display('Profile/show');
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
