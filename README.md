<h1 align="center"> douban-book </h1>

<p align="center"> :green_book: A book SDK.</p>

[![Build Status](https://travis-ci.org/Littlesqx/douban-book.svg?branch=master)](https://travis-ci.org/Littlesqx/douban-book)

## Installing

```shell
$ composer require littlesqx/douban-book -vvv
```

## Usage

```php
<?php

// init app
$app = new Littlesqx\Book\Application();

// book's isbn10/isbn13 code
$isbn = '9787115473899';

// get a book entity
$book = $app->getBook($isbn);

// use as an array
$book->toArray();

// or get json format
$book->toJSON();

// also, get property directly is allowed
$book->getTitle();
$book->getPrice();
```

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/littlesqx/douban-book/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/littlesqx/douban-book/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## Thanks

- [豆瓣 API](https://developers.douban.com)

- [overtrue](https://github.com/overtrue)

## License

MIT