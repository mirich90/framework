<?php

namespace App\Controllers\Image;

use App\Core\Controller;
use App\Db;

class index extends Controller
{
  protected function construct()
  {

    $this->view->images = [
      [
        'link' => '/img/users/098098/1.jpg',
        'title' => 'Картинка со зверятами',
        'is_like' => 1,
        'is_bookmark' => 0,
        'count_like' => 10,
        'count_bookmark' => 2,
        'datetime' => '2024-02-13 01:43:25',
        'author_username' => 'John Dou',
        'author_link' => 'John',
        'author_id' => 1
      ],
      [
        'link' => '/img/users/098098/2.jpg',
        'title' => 'Комиксы о скоте',
        'is_like' => 0,
        'is_bookmark' => 1,
        'count_like' => 3,
        'count_bookmark' => 0,
        'datetime' => '2024-02-13 22:10:53',
        'author_username' => 'Iren2000',
        'author_link' => 'Iren2000',
        'author_id' => 4
      ],
      [
        'link' => '/img/users/098098/3.jpg',
        'title' => 'Люди икс',
        'is_like' => 0,
        'is_bookmark' => 1,
        'count_like' => 3,
        'count_bookmark' => 0,
        'datetime' => '2024-02-13 22:10:53',
        'author_username' => 'Iren2000',
        'author_link' => 'Iren2000',
        'author_id' => 4
      ],
      [
        'link' => '/img/users/098098/10.jpg',
        'title' => 'Космонавт',
        'is_like' => 0,
        'is_bookmark' => 1,
        'count_like' => 3,
        'count_bookmark' => 0,
        'datetime' => '2024-02-13 22:10:53',
        'author_username' => 'Iren2000',
        'author_link' => 'Iren2000',
        'author_id' => 4
      ],
      [
        'link' => '/img/users/098098/11.jpg',
        'title' => 'Рука',
        'is_like' => 0,
        'is_bookmark' => 1,
        'count_like' => 3,
        'count_bookmark' => 0,
        'datetime' => '2024-02-13 22:10:53',
        'author_username' => 'Iren2000',
        'author_link' => 'Iren2000',
        'author_id' => 4
      ],
      [
        'link' => '/img/users/098098/12.jpg',
        'title' => 'Gangster',
        'is_like' => 0,
        'is_bookmark' => 1,
        'count_like' => 3,
        'count_bookmark' => 0,
        'datetime' => '2024-02-13 22:10:53',
        'author_username' => 'Iren2000',
        'author_link' => 'Iren2000',
        'author_id' => 4
      ],
      [
        'link' => '/img/users/098098/13.jpg',
        'title' => 'Juicy Banana',
        'is_like' => 0,
        'is_bookmark' => 1,
        'count_like' => 3,
        'count_bookmark' => 0,
        'datetime' => '2024-02-13 22:10:53',
        'author_username' => 'Iren2000',
        'author_link' => 'Iren2000',
        'author_id' => 4
      ],
      [
        'link' => '/img/users/098098/14.jpg',
        'title' => 'Smoking Aint Cool',
        'is_like' => 0,
        'is_bookmark' => 1,
        'count_like' => 3,
        'count_bookmark' => 0,
        'datetime' => '2024-02-13 22:10:53',
        'author_username' => 'Iren2000',
        'author_link' => 'Iren2000',
        'author_id' => 4
      ],
      [
        'link' => '/img/users/098098/15.jpg',
        'title' => 'Fish With Gas Mask',
        'is_like' => 0,
        'is_bookmark' => 1,
        'count_like' => 3,
        'count_bookmark' => 0,
        'datetime' => '2024-02-13 22:10:53',
        'author_username' => 'Iren2000',
        'author_link' => 'Iren2000',
        'author_id' => 4
      ],
      [
        'link' => '/img/users/098098/16.jpg',
        'title' => 'Monster Milkshake',
        'is_like' => 0,
        'is_bookmark' => 1,
        'count_like' => 3,
        'count_bookmark' => 0,
        'datetime' => '2024-02-13 22:10:53',
        'author_username' => 'Iren2000',
        'author_link' => 'Iren2000',
        'author_id' => 4
      ],
    ];
    $this->view->display('Image/index');
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
