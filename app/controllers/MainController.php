<?php

namespace robots\app\controllers;

use robots\app\core\Controller;
use robots\app\core\Parse;
use robots\app\core\Validation;
use robots\app\core\WriteExcel;

class MainController extends Controller
{
    public function index()
    {
        if (isset($_POST) && $_POST != array()) {
            $input = $this->view->input('post');

            $input_data = Validation::form($input);

            $url = $input_data['url'];

            Validation::checkUrl($url);

            Parse::robots($url);

            WriteExcel::start(Parse::getWriteData());

        } else {
            $this->view->load('main/index');
        }

    }
}