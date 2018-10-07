<?php

/*
 * This file is part of the littlesqx/douban-book.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Littlesqx\Book\Tests;

use PHPUnit\Framework\TestCase;

class HelperTest extends TestCase
{
    public function testArrayToPath()
    {
        $array = [
            'foo' => 'bar'
        ];
        $path = array_to_path($array);
        $this->assertSame('foo/bar', $path);

        $array = [
            'foo' => 'bar',
            ' ' => ' '
        ];
        $path = array_to_path($array);
        $this->assertSame('foo/bar', $path);
    }
}