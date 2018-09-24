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

use GuzzleHttp\Client;
use Littlesqx\Book\Entity\Entity;
use Littlesqx\Book\Exception\HttpException;
use Littlesqx\Book\Exception\InvalidArgumentException;

class Application
{
    protected $httpOptions = [];

    protected $requestUrl = 'https://api.douban.com/v2/book/';

    /**
     * set http client options.
     *
     * @param array $httpOptions
     *
     * @return $this
     */
    public function setHttpOptions(array $httpOptions)
    {
        $this->httpOptions = $httpOptions;

        return $this;
    }

    /**
     * get http client options.
     *
     * @return array
     */
    public function getHttpOptions(): array
    {
        return $this->httpOptions;
    }

    /**
     * get a http client.
     *
     * @return Client
     */
    public function getHttpClient(): Client
    {
        return new Client($this->httpOptions);
    }

    /**
     * get a book by isbn code.
     *
     * @param string $isbn
     *
     * @return Entity
     *
     * @throws HttpException
     * @throws InvalidArgumentException
     */
    public function getBook(string $isbn): ? Entity
    {
        if (13 !== strlen($isbn) && 10 !== strlen($isbn)) {
            throw new InvalidArgumentException('Invalid isbn code(isbn10 or isbn13): '.$isbn);
        }
        $queryParams = ['isbn' => $isbn];

        try {
            $response = $this->getHttpClient()->get(
              $this->requestUrl.array_to_path($queryParams)
            );
            if (200 === $response->getStatusCode()) {
                return BookFactory::make($response->getBody()->getContents());
            }
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
