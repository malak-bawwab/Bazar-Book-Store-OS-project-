<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});




$router->get('/search/{topic}', ['uses' => 'BooksController@showBasedOnTopic']);
$router->get('/lookup/{itemNumber}', ['uses' => 'BooksController@showBasedOnItemNumber']);

// to complete buy process,will be called from order service
$router->get('/query/{itemNumber}', ['uses' => 'BooksController@checkIfExists']);
// to complete buy process,will be called from order service
$router->put('/update/{itemNumber}', ['uses' => 'BooksController@updateStore']);

$router->put('/update/book/{itemNumber}/cost/{newCost}', ['uses' => 'BooksController@updateCost']);
$router->put('/increase/book/{itemNumber}/quantity/{numberOfItems}', ['uses' => 'BooksController@increaseQuantity']);
$router->put('/decrease/book/{itemNumber}/quantity/{numberOfItems}', ['uses' => 'BooksController@decreaseQuantity']);

