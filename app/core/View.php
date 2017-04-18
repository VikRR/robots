<?php

namespace robots\app\core;


class View
{
    public function load($name)
    {
        include_once ROOT . '/app/views/layouts/header.php';
        include_once ROOT . '/app/views/' . $name . '.php';
        include_once ROOT . '/app/views/layouts/footer.php';
    }

    public function input($method)
    {
        $method = strtoupper($method);
        $data = [];
        if ($method == 'POST') {
            foreach ($_POST as $key => $post) {
                $data[$key] = $post;
            }
        } else {
            foreach ($_GET as $key => $get) {
                $data[$key] = $get;
            }
        }

        return $data;
    }
}