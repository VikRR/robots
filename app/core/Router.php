<?php

namespace robots\app\core;


class Router
{
    private static $run = false;
    private static $routes = [];

    public static function add($regex, $route)
    {
        self::$routes[$regex] = $route;
    }

    public static function run()
    {
        $url = parse_url(trim($_SERVER['REQUEST_URI'], '/'), PHP_URL_PATH);

        foreach (self::$routes as $pattern => $route) {
            if (preg_match("~^$pattern$~", $url)) {

                $controller_action = explode('@', $route);

                $controller = 'robots\\app\\controllers\\';

                $controller .= ucfirst(array_shift($controller_action));

                $controller_obj = new $controller();

                $action = array_shift($controller_action);

                $params = $controller_action;

                $res = call_user_func_array(array($controller_obj, $action), $params);

                if (!is_null($res)) {
                    break;
                }

                self::$run = true;
            }
        }
    }

    /**
     * @return bool
     */
    public static function getRun()
    {
        return self::$run;
    }



}