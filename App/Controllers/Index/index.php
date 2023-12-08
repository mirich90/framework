<?php

namespace App\Controllers\Index;

use App\Core\Controller;

class index extends Controller
{
  protected function construct()
  {
    $Category = new \App\Models\Category();
    $this->view->categories = $Category->select();
    $Note = new \App\Models\Note();
    $this->view->notes = $Note->select();
    // $Category->create_table();
    // $this->view->setCss('index');
    // $this->view->setJs('filter');

    // if (isset($_GET['id'])) {
    //   $this->createComment();
    //   die;
    // }
    $this->view->display('index/index');
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
