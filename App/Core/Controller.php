<?php

namespace App\Core;

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

    $this->view->is_user = isset($_SESSION['user']);

    if ($this->view->is_user) {
      $this->view->user = $_SESSION['user'];
      $this->view->is_admin = ($_SESSION['user']["role"] == 'admin');
    }

    if ($this->access()) {
      $this->setMeta();
      $this->construct();
    } else {
      die('Нет');
    }
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
