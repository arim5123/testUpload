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

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/index_main', 'Home::index_main');

$routes->group('admin', ['namespace' => 'App\Controllers\admin'], function ($routes) {

    $routes->add('', 'Main::index');

    $routes->group('main', ['namespace' => 'App\Controllers\admin'], function ($routes) {
        $routes->add('', 'Main::index');
        $routes->add('time_setting', 'Main::time_setting');
        $routes->add('time_val', 'Main::time_val');
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
        $routes->add('create', 'Intro::create');
        $routes->add('intro_upload', 'Intro::intro_upload');
        $routes->add('ajaxData', 'Intro::ajaxData');
        $routes->add('setting', 'Intro::setting');
        $routes->add('setting_ajax', 'Intro::setting_ajax');
        $routes->add('delete/(:num)', 'Intro::delete/$1');
    });

    $routes->group('school', ['namespace' => 'App\Controllers\admin'], function ($routes) {
        $routes->add('msg', 'School::msg');
        $routes->add('history', 'School::history');
        $routes->add('info', 'School::info');
        $routes->add('song', 'School::song');
        $routes->add('ajax/(:num)', 'School::ajax/$1');
    });

    $routes->group('count', ['namespace' => 'App\Controllers\admin'], function ($routes) {
        $routes->add('', 'Count::index');
        $routes->add('ajax', 'Count::ajax');
    });

    $routes->group('notice', ['namespace' => 'App\Controllers\admin'], function ($routes) {
        $routes->add('', 'Notice::index');
        $routes->add('ajax', 'Notice::ajax');
        $routes->add('create', 'Notice::create');
        $routes->add('upload', 'Notice::upload');
        $routes->add('modify/(:num)', 'Notice::modify/$1');
        $routes->add('modify_upload', 'Notice::modify_upload');
        $routes->add('delete/(:num)', 'Notice::delete/$1');
        $routes->add('ajaxData', 'Notice::ajaxData');
    });

    $routes->group('gallery', ['namespace' => 'App\Controllers\admin'], function ($routes) {
        $routes->add('graduate', 'Gallery::graduate');
        $routes->add('graduate_create', 'Gallery::graduate_create');
        $routes->add('graduate_upload', 'Gallery::graduate_upload');
        $routes->add('graduate_modify/(:num)', 'Gallery::graduate_modify/$1');
        $routes->add('graduate_modify_upload', 'Gallery::graduate_modify_upload');
        $routes->add('graduate_delete/(:num)', 'Gallery::graduate_delete/$1');
        $routes->add('history', 'Gallery::history');
        $routes->add('history_create', 'Gallery::history_create');
        $routes->add('history_upload', 'Gallery::history_upload');
        $routes->add('history_modify/(:num)', 'Gallery::history_modify/$1');
        $routes->add('history_modify_upload', 'Gallery::history_modify_upload');
        $routes->add('history_delete/(:num)', 'Gallery::history_delete/$1');
    });

});


$routes->group('sub', ['namespace' => 'App\Controllers\sub'], function ($routes) {

    $routes->group('sub01', ['namespace' => 'App\Controllers\sub'], function ($routes) {
        $routes->add('', 'Sub01::index');
    });

    $routes->group('sub02', ['namespace' => 'App\Controllers\sub'], function ($routes) {
        $routes->add('', 'Sub02::index');
    });

    $routes->group('sub03', ['namespace' => 'App\Controllers\sub'], function ($routes) {
        $routes->add('', 'Sub03::index');
        $routes->add('view/(:num)', 'Sub03::view/$1');
    });

    $routes->group('sub04', ['namespace' => 'App\Controllers\sub'], function ($routes) {
        $routes->add('', 'Sub04::index');
        $routes->add('graduate', 'Sub04::graduate');
        $routes->add('graduate_view/(:num)', 'Sub04::graduate_view/$1');
        $routes->add('history', 'Sub04::history');
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
