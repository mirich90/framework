<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Db;

class Post extends Controller
{
  protected function handle()
  {
    $this->setMeta();

    // $Category->create_table();
    // $this->view->setCss('index');
    // $this->view->setJs('filter');

    if (isset($_GET['id'])) {
      $this->view->display('post');
    } else {
      $Category = new \App\Models\Category();
      $this->view->categories = $Category->select();
      $this->view->display('posts');
    }
  }

  protected function setMeta()
  {
    $this->meta->title = $this->title();
    $this->meta->description = $this->description();
    $this->meta->keywords = $this->keywords();
    $this->meta->author = $this->author();
    $this->meta->name_page = $this->name_page();
    $this->view->meta = $this->meta;
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

  protected function name_page()
  {
    return "page_index";
  }
}
