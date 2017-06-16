<?php

$route->auth();

$route->group([
    'middleware'  => ['auth:member', 'glitter.office'],
], function ($route) {
    $route->get('/', function () {
        return redirect()->route('glitter.office.order.search');
    })->name('index');

    $route->get('account', 'AccountController@index')->name('account.index');
    $route->get('account/profile', 'AccountController@profile')->name('account.profile');
    $route->get('account/security', 'AccountController@security')->name('account.security');

    // 受注管理
    $route->group(['namespace' => 'Order', 'prefix' => 'orders', 'as' => 'order.'], function ($route) {
        $route->get('/', 'SearchController@search')->name('search');
        $route->get('view/{order}', 'EditController@input')->name('view');
        $route->post('view/{order}', 'EditController@save')->name('update');
    });

    // 商品管理
    $route->group(['namespace' => 'Product', 'prefix' => 'products', 'as' => 'product.'], function ($route) {
        $route->get('/', 'SearchController@search')->name('search');
        $route->get('new', 'CreateController@input')->name('new');
        $route->post('new', 'CreateController@save')->name('create');
        $route->get('edit/{product}', 'EditController@input')->name('edit');
        $route->post('edit/{product}', 'EditController@save')->name('update');
        // $route->post('delete/{product}', 'EditController@destory')->name('delete');
        $route->get('variant/{variant}', 'VariantEditController@input')->name('variant.edit');
        $route->post('variant/{variant}', 'VariantEditController@save')->name('variant.update');

        // コレクション
        $route->group(['namespace' => 'Collection', 'prefix' => 'collections', 'as' => 'collection.'], function ($route) {
            $route->get('/', 'SearchController@search')->name('search');
        });

        // 入荷
        $route->group(['namespace' => 'Transfer', 'prefix' => 'transfers', 'as' => 'transfer.'], function ($route) {
            $route->get('/', 'SearchController@search')->name('search');
        });

        // 在庫
        $route->group(['namespace' => 'Inventory', 'prefix' => 'inventory', 'as' => 'inventory.'], function ($route) {
            $route->get('/', 'SearchController@search')->name('search');
        });
    });

    // 顧客リスト
    $route->group(['namespace' => 'Customer', 'prefix' => 'customers', 'as' => 'customer.'], function ($route) {
        $route->get('edit/{customer}', 'EditController@input')->name('edit');
        $route->get('circle', 'CircleSearchController@search')->name('circle.search');
        $route->get('/{preset?}', 'SearchController@search')->name('search');
    });

    $route->get('settings', 'SettingsController@index')->name('settings.index');
    $route->post('settings', 'SettingsController@update_store')->name('settings.update_store');

    // ストア設定
    $route->group(['namespace' => 'Setting', 'prefix' => 'settings', 'as' => 'settings.'], function ($route) {
        // メンバー
        $route->group(['prefix' => 'members', 'as' => 'members.'], function ($route) {
            $route->get('/', 'MemberController@search')->name('search');
            $route->get('new', 'MemberController@new')->name('new');
            $route->post('new', 'MemberController@store')->name('store');
            $route->get('edit/{member}', 'MemberController@edit')->name('edit');
            $route->post('edit/{member}', 'MemberController@update')->name('update');
        });

        // ロール
        $route->group(['prefix' => 'roles', 'as' => 'roles.'], function ($route) {
            $route->get('/', 'RoleController@search')->name('search');
            $route->get('new', 'RoleController@new')->name('new');
            $route->post('new', 'RoleController@store')->name('store');
            $route->get('edit/{role}', 'RoleController@edit')->name('edit');
            $route->post('edit/{role}', 'RoleController@update')->name('update');
        });

        // 監査ログ
        $route->get('audit', 'AuditController@log')->name('audit.log');
    });

    $route->get('switch/{id}', function ($store_id) {
        $member = auth('member')->user();
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
