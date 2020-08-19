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
        "prefix" => "api/v1/categories"
    ],
    function () use ($router) {
        $router->get("/", "CategoriesController@index");
        $router->post("/", "CategoriesController@store");
        $router->get("/{id}", "CategoriesController@show");
        $router->put("/{id}", "CategoriesController@update");
        $router->delete("/{id}", "CategoriesController@destroy");

        $router->post("/{id}/items", "ItemsController@store");
        $router->get("/{id}/items", "ItemsController@index");
        $router->get("/{id}/items/{item_id}", "ItemsController@show");
        $router->put("/{id}/items/{item_id}", "ItemsController@update");
        $router->delete("/{id}/items/{item_id}", "ItemsController@destroy");
    }
);
