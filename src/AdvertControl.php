<?php

namespace Fastleo\AdvertControl;

class AdvertControl extends Control
{
    /**
     * Сохранение данных для будущей отправки
     * @param int $user_id
     * @param array $data
     */
    public static function set(int $user_id, array $data = [])
    {
        $utm = array_merge($data, [
            'user_id' => $user_id,
            'host' => $_SERVER['HTTP_HOST']
        ]);
        foreach ($_REQUEST as $k => $v) {
            $prefix = substr($k, 0, 4);
            if (in_array($k, parent::$keys) or in_array($prefix, parent::$prefixes)) {
                $utm[$k] = $v;
            }
        }
        if (empty($_COOKIE[parent::$key_name])) {
            setcookie(parent::$key_name, base64_encode(json_encode($utm)), time() + parent::$time);
        }
        $_SESSION[parent::$key_name] = $utm;
    }

    /**
     * Отправка данных для создания лида
     * @param array $data
     */
    public static function send(array $data = [])
    {
        if (!empty($_COOKIE[parent::$key_name])) {
            $data = array_merge($data, json_decode(base64_decode($_COOKIE[parent::$key_name]), true));
        }
        if (!empty($_SESSION[parent::$key_name])) {
            $data = array_merge($data, $_SESSION[parent::$key_name]);
        }
        @file_get_contents(parent::$url . '?' . http_build_query($data));
    }
}
