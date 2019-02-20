<?php

/*
 * This file is part of the douban-book.
 *
 * (c) littlesqx <littlesqx@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Littlesqx\Book;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(Application::class, function () {
           return new Application();
        });
        $this->app->alias(Application::class, 'douban-book');
    }

    public function provides()
    {
        return [Application::class, 'douban-book'];
    }
}