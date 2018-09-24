<?php

/*
 * This file is part of the littlesqx/douban-book.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

if (!function_exists('array_to_path')) {
    /**
     * input: ['foo' => 'bar'], output: foo/bar.
     *
     * @param $array
     *
     * @return string
     */
    function array_to_path($array): string
    {
        $path = '';
        foreach ($array as $key => $value) {
            $path .= "{$key}/{$value}";
        }

        return $path;
    }
}
