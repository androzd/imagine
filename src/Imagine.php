<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 3/29/16
 * Time: 11:12 PM
 */

namespace Androzd\Imagine;


class Imagine
{
    private $dir = 'cache';

    public function __construct($dir = '')
    {
        if ($dir) {
            $this->dir = $dir;
        }
    }

    public function path($rule, $image)
    {
        $image = trim($image, '/');
        return route('cache.imagine', [$rule, $image]);
    }
}