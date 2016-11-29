<?php

$route->auth();

$route->group([
    'middleware'  => ['auth:member', 'glitter.admin'],
], function ($route) {
    $route->get('/', function () {
        return view('glitter.admin::index');
    })->name('index');

    $route->get('account', 'AccountController@index')->name('account.index');
    $route->get('account/profile', 'AccountController@profile')->name('account.profile');
    $route->get('account/security', 'AccountController@security')->name('account.security');

    $route->get('orders', 'OrdersController@index')->name('orders.index');
    $route->get('products', 'ProductsController@index')->name('products.index');
    $route->get('customers', 'CustomersController@index')->name('customers.index');
    $route->get('settings', 'SettingsController@index')->name('settings.index');
    $route->get('settings/members', 'SettingsController@members')->name('settings.members');

    $route->get('switch/{id}', function ($store) {
        $member = Auth::guard('member')->user();
        $store = $member->switchable_stores->where('slug', $store)->first();
        $message = [];
        if ($store) {
            $last_login_at = \Carbon\Carbon::now();
            $member->activeStore()->updateExistingPivot($store->getKey(), compact('last_login_at'));
            $message[] = sprintf('%s に切り替えました。', $store->name);
        }

        return redirect()->back()->withFlashMessage($message);
    })->name('store_switch');
});

$route->get('{path}', 'ErrorController@notfound')->where('path', '(.*)')->name('404');
