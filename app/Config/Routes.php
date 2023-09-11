<?php

use CodeIgniter\Router\RouteCollection;
use Config\Services;

// $routes = Services::routes();
// CRUD Method Name : index,get_data,do_add,add,update,do_update,delete

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AdminController::index');
$routes->get('/user/(:num)', 'AdminController::get_data/$1');
$routes->delete('/user/delete/(:num)', 'AdminController::delete/$1');
$routes->get('/user/update/(:num)', 'AdminController::update/$1');
$routes->post('/user/do_update/(:num)', 'AdminController::do_update/$1');
$routes->get('/user/add', 'AdminController::add');
$routes->post('/user/do_add', 'AdminController::do_add');
$routes->get('/user_no_query/(:segment)', 'AdminController::get_data_no_query/$1');
