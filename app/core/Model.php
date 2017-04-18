<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 14.04.17
 * Time: 10:56
 */

namespace robots\app\core;


class Model
{

    public function load($name)
    {
        $model = 'robots\\app\\models\\' . ucfirst($name);

        return new $model();
    }
}