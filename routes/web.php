<?php

use Illuminate\Http\Request;
use App\Models\Brand;

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->group(["prefix" => "auth"], function () use ($router) {
    $router->post("/register", "AuthController@register");
    $router->post("/login", ["uses" => "AuthController@authenticate"]);
});

/**
 * Routes for categories and there items
 */
$router->post("/ck-upload", "Admin\UploadController@ckUpload");


$router->group(
    [
        "middleware" => "jwt.auth",
    ],
    function () use ($router) {
        $router->post("/upload-img-from-b64", "Admin\UploadController@uploadFromBase64");
        $router->post("/upload-pdf", "Admin\UploadController@uploadPdf");
//        brands
        $router->get("/get-brands", "Admin\BrandController@getAll");
        $router->post("/get-brand-by-slug", "Admin\BrandController@getBrandBySlug");
        $router->post("/create-brand", "Admin\BrandController@create");
        $router->post("/update-brand", "Admin\BrandController@update");
        $router->post("/delete-brand", "Admin\BrandController@delete");
        $router->post("/update-brand-position", "Admin\BrandController@updatePosition");
        $router->post("/bulk-activate-brands", "Admin\BrandController@bulkActivate");
        $router->post("/bulk-deactivate-brands", "Admin\BrandController@bulkDeactivate");
        $router->post("/bulk-delete-brands", "Admin\BrandController@bulkDelete");
//        catalogs
        $router->get("/get-catalogs", "Admin\CatalogController@getAll");
        $router->post("/create-catalog", "Admin\CatalogController@create");
        $router->post("/update-catalog", "Admin\CatalogController@update");
        $router->post("/delete-catalog", "Admin\CatalogController@delete");
        $router->post("/update-catalog-position", "Admin\CatalogController@updatePosition");
        $router->post("/bulk-activate-catalogs", "Admin\CatalogController@bulkActivate");
        $router->post("/bulk-deactivate-catalogs", "Admin\CatalogController@bulkDeactivate");
        $router->post("/bulk-delete-catalogs", "Admin\CatalogController@bulkDelete");
//        news
        $router->get("/get-posts", "Admin\NewsController@getAll");
        $router->post("/create-post", "Admin\NewsController@create");
        $router->post("/update-post", "Admin\NewsController@update");
        $router->post("/delete-post", "Admin\NewsController@delete");
        $router->post("/update-post-position", "Admin\NewsController@updatePosition");
        $router->post("/bulk-activate-posts", "Admin\NewsController@bulkActivate");
        $router->post("/bulk-deactivate-posts", "Admin\NewsController@bulkDeactivate");
        $router->post("/bulk-delete-posts", "Admin\NewsController@bulkDelete");
    }
);
