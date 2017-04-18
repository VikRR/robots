<?php

//ini_set('display_errors','Off');

define('ROOT', dirname(__DIR__));

require_once ROOT . '/vendor/autoload.php';
require_once ROOT . '/helpFunction.php';
//$message = include_once ROOT.'/app/config/message.php';

use robots\app\controllers\ErrorController;
use robots\app\core\Message;
use robots\app\core\Router;

Router::add('', 'MainController@index');
//Router::add('check', 'MainController@check');

//arr_($_POST);

//Message::includeMess();

//arr_(Message::getMessage());exit;

try {
    Router::run();
    if (!Router::getRun()) {
        $error = new ErrorController();
        $error->error404();
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

