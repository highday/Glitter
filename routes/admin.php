<?php

$route->auth();

$route->group([
    'middleware'  => ['auth:member', 'glitter.admin'],
], function ($route) {

    $route->get('/', function () {
        return view('glitter.admin::index');
    })->name('index');



    $route->get('{path}', 'ErrorController@notfound')->where('path', '(.*)')->name('404');
});
