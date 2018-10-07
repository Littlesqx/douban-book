<?php

/*
 * This file is part of the littlesqx/douban-book.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Littlesqx\Book;

use Littlesqx\Book\Entity\Book;
use Littlesqx\Book\Interfaces\Factory;

class BookFactory implements Factory
{
    /**
     * make a book entity.
     *
     * @param $params
     *
     * @return Book|null
     */
    public static function make($params): ? Book
    {
        $params = \json_decode($params, true);
        if (!isset($params['title'])) {
            return null;
        }
        $book = new Book();

        return $book->setIsbn($params['isbn13'])
            ->setTitle($params['title'])
            ->setSubtitle($params['subtitle'])
            ->setAuthor($params['author'])
            ->setAuthorIntro($params['author_intro'])
            ->setPrice($params['price'])
            ->setCatalog($params['catalog'])
            ->setPublicationDate($params['pubdate'])
            ->setPublisher($params['publisher'])
            ->setSummary($params['summary'])
            ->setCover($params['images']['large'])
            ->setTags(array_column($params['tags'], 'name'));
    }
}
