<?php

namespace Fastleo\AdvertControl;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AdvertControlLaravel extends Control
{
    /**
     * Сохранение данных для будущей отправки
     * @param int $user_id
     * @param array $data
     */
    public static function set(Request $request, int $user_id)
    {
        $utm = [
            'user_id' => $user_id,
            'user_ip' => $request->ip(),
            'host' => $request->server('HTTP_HOST')
        ];
        foreach ($request->all() as $k => $v) {
            $prefix = substr($k, 0, 4);
            if (in_array($k, parent::$keys) or in_array($prefix, parent::$prefixes)) {
                $utm[$k] = $v;
            }
        }
        if (!empty($_COOKIE[parent::$name])) {
            $cockies = json_decode(base64_decode($_COOKIE[parent::$name]), true);
            $utm = array_merge($cockies, $utm);
        }
        setcookie(parent::$name, base64_encode(json_encode($utm)), time() + parent::$time);
        $_SESSION[parent::$name] = $utm;
    }

    /**
     * Отправка данных для создания лида
     * @param array $data
     */
    public static function send(Request $request)
    {
        if (!empty($_COOKIE[parent::$name])) {
            $data = array_merge($request->all(), json_decode(base64_decode($_COOKIE[parent::$name]), true));
        }
        if (!empty($_SESSION[parent::$name])) {
            $data = array_merge($request->all(), $_SESSION[parent::$name]);
        }
        Http::get(parent::$url, $data);
    }
}