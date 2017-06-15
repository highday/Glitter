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
        $route->get('transfers', 'SearchController@search')->name('transfer');
        $route->get('collections', 'SearchController@search')->name('collection');
    });

    // 顧客リスト
    $route->group(['namespace' => 'Customer', 'prefix' => 'customers', 'as' => 'customer.'], function ($route) {
        $route->get('/', 'SearchController@search')->name('search');
        $route->get('edit/{customer}', 'EditController@input')->name('edit');
        $route->get('group', 'GroupSearchController@search')->name('group.search');
    });

    $route->get('settings', 'SettingsController@index')->name('settings.index');
    $route->post('settings', 'SettingsController@update_store')->name('settings.update_store');
    $route->get('settings/members', 'Setting\MemberController@search')->name('settings.members.search');
    $route->get('settings/members/edit/{member}', 'Setting\MemberController@edit')->name('settings.members.edit');
    $route->post('settings/members/edit/{member}', 'Setting\MemberController@save')->name('settings.members.update');
    $route->get('settings/roles', 'Setting\RoleController@search')->name('settings.roles.search');
    $route->get('settings/roles/edit/{role}', 'Setting\RoleController@edit')->name('settings.roles.edit');
    $route->post('settings/roles/edit/{role}', 'Setting\RoleController@save')->name('settings.roles.update');
    $route->get('settings/audit', 'Setting\AuditController@log')->name('settings.audit.log');

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
