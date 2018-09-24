<?php

/*
 * This file is part of the littlesqx/douban-book.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Littlesqx\Book\Entity;

/**
 * Interface EntityInterface
 */
interface Entity
{
    public function toArray();
    public function toJSON();
}