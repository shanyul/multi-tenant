<?php

Auth::routes();

Route::group(['middleware' => ['auth']], function($router) {
    $router->get('/', 'TenantsController@index')->name('tenants.index');
    $router->get('tenants/create', 'TenantsController@create')->name('tenants.create');
    $router->post('tenants', 'TenantsController@store')->name('tenants.store');
    $router->get('tenants/{tenant}', 'TenantsController@edit')->name('tenants.edit');
    $router->put('tenants/{tenant}', 'TenantsController@update')->name('tenants.update');
    $router->delete('tenants/{tenant}', 'TenantsController@destroy')->name('tenants.destroy');
});
