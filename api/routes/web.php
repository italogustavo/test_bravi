<?php

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

$router->get('users/pagination', 'UserController@pagination');
$router->get('users/list_full/', 'UserController@list_full'); 
$router->get('users[/{id}]', 'UserController@view');
$router->post('users', 'UserController@create'); 
$router->put('users/{id}', 'UserController@update');
$router->delete('users/{id}', 'UserController@delete');


$router->get('peoples/pagination', 'PeopleController@pagination');
$router->get('peoples/list_full/', 'PeopleController@list_full'); 
$router->get('peoples[/{id}]', 'PeopleController@view');
$router->post('peoples', 'PeopleController@create'); 
$router->put('peoples/{id}', 'PeopleController@update');
$router->delete('peoples/{id}', 'PeopleController@delete');


$router->get('peoples/{people_id}/contacts/pagination', 'PeopleContactController@pagination');
$router->get('peoples/{people_id}/contacts[/{id}]', 'PeopleContactController@view');
$router->post('peoples/{people_id}/contacts', 'PeopleContactController@create');
$router->put('peoples/{people_id}/contacts/{id}', 'PeopleContactController@update');
$router->delete('peoples/{people_id}/contacts/{id}', 'PeopleContactController@delete');

