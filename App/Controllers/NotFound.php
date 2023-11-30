<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Errors;

class NotFound extends Controller
{

    protected function handle()
    {
        $this->setMeta();
        $this->view->display('not_found');
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
        return "404 ошибка";
    }

    protected function description()
    {
        return "404 ошибка фреймворка";
    }

    protected function keywords()
    {
        return "framework";
    }

    protected function author()
    {
        return "author_name";
    }

    protected function name_page()
    {
        return "page_not_found";
    }
}
