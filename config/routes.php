<?php

/**
 * This file contains all the routes for the CMS
 */

use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::csrfVerifier(new \App\Middlewares\CsrfVerifier());
SimpleRouter::setDefaultNamespace('App\\Controllers');
SimpleRouter::group(['exceptionHandler' => \App\Handlers\CustomExceptionHandler::class], function () {

    SimpleRouter::get('/', 'HomeController@index')->name('index');
    SimpleRouter::get('users', 'UsersController@index')->name('index');
    SimpleRouter::get('dashboard', 'DashboardController@index')->name('index');
    SimpleRouter::get('logout', 'AuthController@logout')->name('logout');
    SimpleRouter::post('login', 'AuthController@login')->name('login');
    //SimpleRouter::basic('/companies/{id?}', 'DefaultController@companies')->name('companies');

    /*
    
    // API
    SimpleRouter::group(['prefix' => '/api', 'middleware' => \Demo\Middlewares\ApiVerification::class], function () {
        SimpleRouter::resource('/demo', 'ApiController');
    });

    */
});
