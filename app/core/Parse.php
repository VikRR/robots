<?php

namespace robots\app\core;


class Parse
{
    private static $url;
    private static $robots;
    private static $filesize;
    private static $write_data = [];
    private static $message = [];

    /**
     * @param $url
     */
    public static function robots($url)
    {
        Message::includeMess();

        self::$message = Message::getMessage();

        self::checkDns($url);

        self::existRobots();

        self::checkCode();

        self::checkDirective('host');

        self::checkDirective('sitemap');

        self::checkFileSize();

        //arr_(self::$write_data);
    }

    public static function existRobots()
    {
        if (file_get_contents('http://' . self::$url . '/robots.txt')) {

            self::$write_data['exist_robots_status'] = self::$message['exist_robots']['status_ok'];
            self::$write_data['exist_robots'] = true;
            self::$write_data['exist_robots_recom'] = self::$message['recom']['ok'];
            self::$write_data['verification'] = self::$message['verification'];
            self::$write_data['status_exist_robots'] = self::$message['status']['ok'];
        } else {
            self::$write_data['exist_robots_status'] = self::$message['exist_robots']['status_err'];
            self::$write_data['exist_robots'] = false;
            self::$write_data['exist_robots_recom'] = self::$message['exist_robots']['recom'];
            self::$write_data['status_exist_robots'] = self::$message['status']['err'];
        }
    }

    /**
     * @param $url
     * @throws \Exception
     */
    public static function checkDns($url)
    {
        $url = str_replace('www.', '', $url);

        if (strpos($url, '/')) {
            $url = substr($url, 0, strpos($url, '/'));
        }

        $url = trim($url);

        if (checkdnsrr($url) != 1) {
            throw new \Exception("$url does not exist.");
        }

        self::$write_data['url'] = $url;

        self::$url = $url;
    }

    /**
     * @throws \Exception
     */
    public static function checkCode()
    {
        $url_robots = 'http://' . self::$url . '/robots.txt';

        $headers = get_headers($url_robots, 1);

        preg_match('~(\d{3})~', $headers[0], $matches);

        $code = $matches[0];

        if (strpos($headers[0], '200')) {
            self::$robots = file_get_contents($url_robots);
            self::$filesize = $headers['Content-Length'];
            self::$write_data['robots_code_status'] = self::$message['robots_code']['status_ok'];
            self::$write_data['robots_code_recom'] = self::$message['recom']['ok'];
            self::$write_data['status_code'] = self::$message['status']['ok'];
        } else {
            self::$write_data['robots_code_status'] = self::$message['robots_code']['status_err'] . $code;
            self::$write_data['status_code'] = self::$message['status']['err'];
            self::$write_data['robots_code_recom'] = self::$message['robots_code']['recom'];

        }
    }


    /**
     * @param $directive
     * @throws \Exception
     */
    public static function checkDirective($directive)
    {
        if (preg_match_all("~(?<=$directive:).*~i", self::$robots, $matches)) {
            $count = count($matches[0]);

            self::$write_data[$directive . '_status'] = self::$message['directive']['status_ok'] . $directive;
            self::$write_data[$directive . '_recom'] = self::$message['recom']['ok'];
            self::$write_data['status_'.$directive] = self::$message['status']['ok'];

            if ($count > 1) {
                self::$write_data['host_count_flag'] = false;
                self::$write_data['host_count_status'] = self::$message['host_count']['status_err'];
                self::$write_data['status_host_count'] = self::$message['status']['err'];
                self::$write_data['host_recom_count'] = self::$message['host_count']['recom'];

            } else {
                self::$write_data['host_count_flag'] = true;
                self::$write_data['status_host_count'] = self::$message['status']['ok'];
                self::$write_data['host_count_status'] = self::$message['host_count']['status_ok'];
                self::$write_data['host_count_recom'] = self::$message['recom']['ok'];
            }
        } else {
            self::$write_data['status_'.$directive] = self::$message['status']['err'];
            self::$write_data[$directive . '_status'] = self::$message['directive']['status_err'] . $directive;

            if ($directive == 'host') {
                self::$write_data['host_recom'] = self::$message['host']['recom'];
            } else {
                self::$write_data['sitemap_recom'] = self::$message['sitemap']['recom'];
            }
        }
    }

    /**
     *
     */
    public static function checkFileSize()
    {
        $size = self::$filesize / 1000;

        if (self::$filesize > 32000) {
            self::$write_data['status_file_size'] = self::$message['status']['error'];
            self::$write_data['file_size_recom'] = self::$message['file_size']['recom'];
            self::$write_data['file_size_status'] = $size . self::$message['file_size']['status_err'];
        }
        self::$write_data['status_file_size'] = self::$message['status']['ok'];
        self::$write_data['file_size_status'] = $size . self::$message['file_size']['status_ok'];
        self::$write_data['file_size_recom'] = self::$message['recom']['ok'];

    }

    /**
     * @return array
     */
    public static function getWriteData()
    {
        return self::$write_data;
    }

}