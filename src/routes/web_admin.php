<?php


use XRA\Extend\Traits\RouteTrait;

$namespace = $this->getNamespace();
$pack = class_basename($namespace);
$middleware = ['web', 'auth'];
$prefix = 'admin';

$areas_prgs = [
    [
        'name' => 'profile',
    ],
];
Route::group(
    [
    'prefix' => $prefix,
    'middleware' => $middleware,
    'namespace' => $namespace.'\Controllers\Admin',
    ],
    function () use ($areas_prgs) {
        Route::get('/', 'BackendController@dashboard');
        RouteTrait::dynamic_route($areas_prgs);
    }
);
//require_once(__DIR__.'/../../../Blog/src/routes/web_admin_blog.php');
