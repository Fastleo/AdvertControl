<?php

namespace Fastleo\AdvertControl;

class Control
{
    /**
     * Тия ключа глобальных переменных
     * @var string
     */
    public static $name = '_advert_control_client_data';

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
        'utm_', 'regi'
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
}