<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 14.04.17
 * Time: 10:56
 */

namespace robots\app\core;


class Controller
{
    protected $model;
    protected $view;

    public function __construct()
    {
        $this->model = new Model();
        $this->view = new View();
    }

}