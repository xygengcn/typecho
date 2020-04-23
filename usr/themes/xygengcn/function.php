<?php

/**
 * 主题插件
 *
 * @package theme_plugin
 */
class theme_plugin
{
    public static function test($text)
    {
        return mb_strlen($text->text, 'UTF-8');
    }
}