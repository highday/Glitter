<?php

$route->auth();

$route->group([
    'middleware'  => ['auth:member', 'glitter.office'],
], function ($route) {
    $route->get('/', function () {
        return view('glitter.office::index');
    })->name('index');

    $route->get('account', 'AccountController@index')->name('account.index');
    $route->get('account/profile', 'AccountController@profile')->name('account.profile');
    $route->get('account/security', 'AccountController@security')->name('account.security');

    $route->get('orders', 'OrdersController@index')->name('orders.index');

    $route->get('products', 'ProductsController@products')->name('products.products');
    $route->get('products/new', 'ProductsController@new')->name('products.new');
    $route->post('products/new', 'ProductsController@store')->name('products.store');
    $route->get('products/edit/{product}', 'ProductsController@edit')->name('products.edit');
    $route->post('products/edit/{product}', 'ProductsController@update')->name('products.update');
    $route->get('products/edit/{product}/variant/{variant}', 'ProductsController@edit_variant')->name('products.variant.edit');
    $route->post('products/edit/{product}/attachments', 'ProductAttachmentsController@add')->name('products.attachments.add');
    $route->get('products/transfers', 'ProductsController@products')->name('products.transfers');
    $route->get('products/inventory', 'ProductsController@inventory')->name('products.inventory');
    $route->get('products/collections', 'ProductsController@products')->name('products.collections');

    $route->get('customers', 'CustomersController@index')->name('customers.index');
    $route->get('settings', 'SettingsController@index')->name('settings.index');
    $route->get('settings/members', 'SettingsController@members')->name('settings.members');

    $route->get('switch/{id}', function ($store_id) {
        $member = Auth::guard('member')->user();
        $store = $member->switchable_stores->find($store_id);
        $message = [];
        if ($store) {
            $last_login_at = \Carbon\Carbon::now();
            $member->activeStore()->updateExistingPivot($store->getKey(), compact('last_login_at'));
            $message[] = sprintf('%s に切り替えました。', $store->name);
        }

        return redirect()->route('glitter.office.index')->withFlashMessage($message);
    })->name('store_switch');
});

$route->get('{path}', 'ErrorController@notfound')->where('path', '(.*)')->name('404')->middleware('glitter.office');
