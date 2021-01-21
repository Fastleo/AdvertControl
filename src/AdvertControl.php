<?php

namespace Fastleo\AdvertControl;

class AdvertControl
{
    /**
     * Тия ключа глобальных переменных
     * @var string
     */
    public static $key_name = '_advert_control_client_data';

    /**
     * URl для отправки данных
     * @var string
     */
    public static $url = 'https://crm.g72.ru/data';

    /**
     * Префиксы для отбора из get запроса
     * @var string[]
     */
    protected static $prefixes = [
        'utm_'
    ];

    /**
     * Ключи для отбора из get запроса
     * @var string[]
     */
    protected static $keys = [
        'region'
    ];

    /**
     * Вемя хранения cookie фалов
     * @var int
     */
    protected static $time = 2592000;

    /**
     * Сохранение данных для будущей отправки
     * @param int $user_id
     * @param array $data
     */
    public static function setClientData(int $user_id, array $data = [])
    {
        $utm = array_merge($data, [
            'user_id' => $user_id,
            'host' => $_SERVER['HTTP_HOST']
        ]);
        foreach ($_REQUEST as $k => $v) {
            $prefix = substr($k, 0, 4);
            if (in_array($k, self::$keys) or in_array($prefix, self::$prefixes)) {
                $utm[$k] = $v;
            }
        }
        if (empty($_COOKIE[self::$key_name])) {
            setcookie(self::$key_name, base64_encode(json_encode($utm)), time() + self::$time);
        }
        $_SESSION[self::$key_name] = $utm;
    }

    /**
     * Отправка данных для создания лида
     * @param array $data
     */
    public static function sendClientData(array $data = [])
    {
        if (!empty($_COOKIE[self::$key_name])) {
            $data = array_merge($data, json_decode(base64_decode($_COOKIE[self::$key_name]), true));
        }
        if (!empty($_SESSION[self::$key_name])) {
            $data = array_merge($data, $_SESSION[self::$key_name]);
        }
        @file_get_contents(self::$url . '?' . http_build_query($data));
    }
}
