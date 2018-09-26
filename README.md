<h1 align="center"> douban-book </h1>

<p align="center"> :mag: :books: A book SDK, which can be used to get information of a book. <br>一个简单的图书 SDK，你可以使用它用于获取指定书籍的基本信息。</p>

[![Build Status](https://travis-ci.org/Littlesqx/douban-book.svg?branch=master)](https://travis-ci.org/Littlesqx/douban-book)
[![StyleCI](https://github.styleci.io/repos/150088434/shield?branch=master)](https://github.styleci.io/repos/150088434)

## Requirement

- PHP >= 7.0
- Composer

## Installing

```shell
composer require littlesqx/douban-book -vvv
```

## Usage

```php
<?php

use Littlesqx\Book\Application;

// init app
$app = new Application();

// book's isbn10/isbn13 code
$isbn = '9787115473899';

// get a book entity
try {
    $book = $app->getBook($isbn);
    if ($book) {
        // use as an array
        $book->toArray();
        
        // or get json format
        $book->toJSON();
        
        // also, get property directly is allowed
        $book->getTitle();
        $book->getPrice();
    }
} catch (\Exception $exception) {
    // handle exception
}

```

## Test

```shell
composer test
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