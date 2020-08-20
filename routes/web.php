<?php
use Illuminate\Http\Request;

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->group(["prefix"=> "auth"], function () use ($router) {
    $router->post("/register", "AuthController@register");
    $router->post("/login", ["uses" => "AuthController@authenticate"]);
});

/**
 * Routes for categories and there items
 */
$router->group(
    [
        "middleware" => "jwt.auth",
    ],
    function () use ($router) {
        $router->post("/upload-img-from-b64", "Admin\UploadController@uploadFromBase64");

        $router->get("/get-brands", "Admin\BrandController@getAll");
        $router->post("/create-brand", "Admin\BrandController@create");
    }
);
