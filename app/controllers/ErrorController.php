<?php

namespace robots\app\controllers;


use robots\app\core\Controller;

class ErrorController extends Controller
{

    public function error404()
    {
        $this->view->load('errors/error404');
    }

}