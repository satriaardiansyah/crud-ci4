<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'UsersController::index');

$routes->post('/add-user', 'UsersController::addUser');

$routes->get('/users/edit/(:num)', 'UsersController::editUserForm/$1');
$routes->post('/users/edit/(:num)', 'UsersController::updateUser/$1');
$routes->get('/users/delete/(:num)', 'UsersController::deleteUser/$1');


//route fake api dummy json
$routes->get('/user', 'DataDummyController::getUsers');
$routes->post('/user/add', 'DataDummyController::tambahUser');
$routes->post('/user/update/(:num)', 'DataDummyController::perbaruiUser/$1');
$routes->post('/user/delete/(:num)', 'DataDummyController::hapusUser/$1');



