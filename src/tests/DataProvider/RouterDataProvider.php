<?php
declare(strict_types = 1);
namespace Tests\DataProvider;
class RouterDataProvider{
    public function routeNotfoundCase():array{
        return [
            ['/users', 'put'],
            ['/invoice', 'post'],
            ['/users', 'get'],
            ['/users', 'post']
        ];
    }
}