<?php 

namespace Yasmin;

use Yasmin\Factory;
use Yasmin\Uri;
use Yasmin\Request;
use Yasmin\Route;

class Framework {

    static function run() {
        $uri = Factory::load(Uri::class, 'uri');
        $uriString = $uri->string();

        $request = Factory::load(Request::class, 'request');
        $method = $request->method();

        $callable = Route::callable($method, $uriString);
        $callable_array = explode('@', $callable);
        
        $controller = new $callable_array[0]();
        $response = $controller->{$callable_array[1]}();
        $response->send();
    }

}