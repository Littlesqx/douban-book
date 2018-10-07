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

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use Littlesqx\Book\Application;
use Littlesqx\Book\Entity\Book;
use Littlesqx\Book\Entity\Entity;
use Littlesqx\Book\Exception\HttpException;
use Littlesqx\Book\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Mockery\Matcher\AnyArgs;

class ApplicationTest extends TestCase
{
    /**
     * @param string $isbn
     *
     * @dataProvider getBookExceptionProvider
     */
    public function testGetBookException(string $isbn)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid isbn code(isbn10 or isbn13): '.$isbn);
        (new Application())->getBook($isbn);
        $this->fail('Failed to assert getBook throw exception with invalid argument.');
    }

    /**
     * testGetBookException's data provider.
     *
     * @return array
     */
    public function getBookExceptionProvider()
    {
        return [
            ['000123456789'],
            ['123456789'],
        ];
    }

    /**
     * test for get a book entity.
     *
     * @param string $isbn
     *
     * @dataProvider getBookProvider
     */
    public function testGetBook(string $isbn)
    {
        $response = new Response(200, [], '{}');
        $client = \Mockery::mock(Client::class);
        $client->allows()
            ->get('https://api.douban.com/v2/book/isbn/'.$isbn)
            ->andReturn($response);

        $app = \Mockery::mock(Application::class)->makePartial();
        $app->allows()->getHttpClient()->andReturn($client);

        $this->assertEmpty($app->getBook($isbn));

        $response = new Response(
            200, [],
            '{"title":"","price":"","author":[],"publisher":""'
            .',"author_intro":"","subtitle":"","isbn13":"","images":{"large":""},'
            .'"catalog":"","pubdate":"","tags":[],"summary":""}'
        );
        $client = \Mockery::mock(Client::class);
        $client->allows()
            ->get('https://api.douban.com/v2/book/isbn/'.$isbn)
            ->andReturn($response);

        $app = \Mockery::mock(Application::class)->makePartial();
        $app->allows()->getHttpClient()->andReturn($client);

        $this->assertInstanceOf(Book::class, $app->getBook($isbn));
    }

    /**
     * testGetBook's data provider.
     *
     * @return array
     */
    public function getBookProvider()
    {
        return [
            ['0123456789'],
        ];
    }

    /**
     * test for getHttpClient.
     */
    public function testGetHttpClient()
    {
        $app = new Application();
        $this->assertInstanceOf(ClientInterface::class, $app->getHttpClient());
    }

    /**
     * test for set http options.
     */
    public function testSetHttpOptions()
    {
        $app = new Application();
        // default config
        $this->assertSame([], $app->getHttpOptions());
        // set a new config
        $app->setHttpOptions(['timeout' => 5000]);
        $this->assertSame(['timeout' => 5000], $app->getHttpOptions());
    }

    /**
     * test for http request exception.
     */
    public function testGetBookWithGuzzleRuntimeException()
    {
        $client = \Mockery::mock(Client::class);
        $client->allows()
            ->get(new AnyArgs())
            ->andThrow(new \Exception('request timeout'));

        $app = \Mockery::mock(Application::class)->makePartial();
        $app->allows()->getHttpClient()->andReturn($client);

        $this->expectException(HttpException::class);
        $this->expectExceptionMessage('request timeout');

        $app->getBook('0123456789');
    }
}
