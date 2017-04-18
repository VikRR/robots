<?php

namespace robots\app\core;


/**
 * Class Validation
 * @package robots\app\core
 */
class Validation
{

    /**
     * @param array $input
     * @return array
     * @throws \Exception
     */
    public static function form(array $input)
    {
        $res = [];
        if ($input == []) {
            throw new \Exception('Error sending data from form.');
        }
        foreach ($input as $key => $value) {
            if (empty($value)) {
                throw new \Exception("Field $key is empty.");
            }else{
                $res[$key] = htmlspecialchars($value);
            }
        }

        return $res;
    }

    /**
     * @param string $input
     * @throws \Exception
     */
    public static function checkUrl($input)
    {
        if (preg_match('~(www\.(.*?\.){1,2}(.*))~', $input) === 0) {
            throw new \Exception('Url does not match the pattern. Template example www.example.com');
        }
    }

}