<?php

namespace App\Core;

use App\Functions\FUser;

abstract class Controller
{
  protected $view;
  protected $meta;

  public function __construct()
  {
    session_start();
    $this->view = new View();
    $this->meta = new Meta();
  }

  protected function access(): bool
  {
    return true;
  }

  public function __invoke()
  {
    $this->view->user = FUser::getUser();
    $this->view->is_admin = FUser::checkRole('admin');

    if ($this->access()) {
      $this->setMeta();
      $this->construct();
    } else {
      die('Нет');
    }
  }

  public function setUserSession($data)
  {
    unset($_SESSION['user']);

    $data['id'] = $data['user_id'];
    unset($data['user_id']);
    $_SESSION['user'] = $data;
  }

  protected function name_page()
  {
    return getNameCss($this);
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

  protected function setCss($css)
  {
    $this->view->setCss($css);
  }
  protected function setJs($js, $is_defer = true)
  {
    $this->view->setJs($js, $is_defer);
  }
  protected function setFonts($fonts)
  {
    $this->view->setJs($fonts);
  }


  // пока не рбаотае почему-то. должен выявить был ажакс запрос или нет
  public function isAjax()
  {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
  }

  abstract protected function construct();
  abstract protected function title();
  abstract protected function description();
  abstract protected function keywords();
  abstract protected function author();
}
