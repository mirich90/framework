<?php

namespace App\Controllers\NotFound;

use App\Core\Controller;
use App\Errors;

class index extends Controller
{

    protected function construct()
    {
        $this->view->display('not_found');
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
}
