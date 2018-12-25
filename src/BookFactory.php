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

use Littlesqx\Book\Entities\Book;
use Littlesqx\Book\Exceptions\InvalidResponseException;
use Littlesqx\Book\Interfaces\Factory;

class BookFactory implements Factory
{
    /**
     * make a book entity.
     *
     * @param $body
     *
     * @return Book
     * @throws InvalidResponseException
     */
    public static function make($body): Book
    {
        $params = \json_decode($body, true);
        if (!isset($params['title'])) {
            throw new InvalidResponseException("Response body: {$body}");
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
            ->setTags(array_column($params['tags'], 'name'))
            ->setAltUrl($params['alt_url']);
    }
}
