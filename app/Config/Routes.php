<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->group('admin', ['namespace' => 'App\Controllers\admin'], function ($routes) {

    $routes->add('', 'Main::index');

    $routes->group('main', ['namespace' => 'App\Controllers\admin'], function ($routes) {
        $routes->add('', 'Main::index');
    });

    $routes->group('login', ['namespace' => 'App\Controllers\admin'], function ($routes) {
        $routes->add('', 'Login::index');
        $routes->add('logout', 'Login::logout');
        $routes->add('insert', 'Login::insert');
        $routes->add('info', 'Login::info');
        $routes->add('pw_change', 'Login::pw_change');
    });

    $routes->group('intro', ['namespace' => 'App\Controllers\admin'], function ($routes) {
        $routes->add('', 'Intro::index');
        $routes->add('state_modify/(:num)', 'Intro::state_modify/$1');
        $routes->add('modify/(:num)', 'Intro::modify/$1');
        $routes->add('modify_upload', 'Intro::modify_upload');
        $routes->add('delete/(:num)', 'Intro::delete/$1');
        $routes->add('create', 'Intro::create');
        $routes->add('create_upload', 'Intro::create_upload');
    });

    $routes->group('org', ['namespace' => 'App\Controllers\admin'], function ($routes) {
        $routes->add('', 'Org::list_text');
        $routes->add('list_div', 'Org::list_div');
        $routes->add('list_text', 'Org::list_text');
        $routes->add('list_img', 'Org::list_img');
        $routes->add('insert_div', 'Org::insert_div');
        $routes->add('insert_text', 'Org::insert_text');
        $routes->add('insert_img', 'Org::insert_img');
        $routes->add('detail/(:segment)', 'Org::detail/$1');
    });

});

$routes->group('sub', ['namespace' => 'App\Controllers\sub'], function ($routes) {

    $routes->group('sub01', ['namespace' => 'App\Controllers\sub'], function ($routes) {
        $routes->add('view/(:segment)', 'Sub01::view/$1');
        $routes->add('detail/(:segment)', 'Sub01::detail/$1');
    });

});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
