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

$router->post("/ck-upload", "Admin\UploadController@ckUpload");
$router->post("/upload-img-from-b64", "Admin\UploadController@uploadFromBase64");
$router->post("/upload-pdf", "Admin\UploadController@uploadPdf");

$router->group(["prefix" => "home"], function () use ($router) {
    $router->get("/get-brands", "Admin\BrandController@getAll");
    $router->post("/get-brand-by-slug", "Admin\BrandController@getBySlug");
    $router->get("/get-catalogs", "Admin\CatalogController@getAll");
    $router->get("/get-posts", "Admin\NewsController@getAll");
    $router->get("/get-categories", "Admin\CategoryController@getAll");
    $router->post("/get-category-by-id", "Admin\CategoryController@getById");
    $router->get("/get-subcategories", "Admin\SubcategoryController@getAll");
    $router->post("/get-by-category-id", "Admin\SubcategoryController@getByCategoryId");
    $router->get("/get-products-oil", "Admin\ProductsOilController@getAll");
    $router->post("/get-product-oil-by-slug", "Admin\ProductsOilController@getBySlug");
    $router->get("/get-products-drill", "Admin\ProductsDrillController@getAll");
    $router->get("/get-metalworking", "Admin\MetalworkingController@getAll");
});

$router->group(
    [
        "middleware" => "jwt.auth",
    ],
    function () use ($router) {
//        brands
        $router->post("/create-brand", "Admin\BrandController@create");
        $router->post("/update-brand", "Admin\BrandController@update");
        $router->post("/delete-brand", "Admin\BrandController@delete");
        $router->post("/update-brand-position", "Admin\BrandController@updatePosition");
        $router->post("/bulk-activate-brands", "Admin\BrandController@bulkActivate");
        $router->post("/bulk-deactivate-brands", "Admin\BrandController@bulkDeactivate");
        $router->post("/bulk-delete-brands", "Admin\BrandController@bulkDelete");
//        catalogs
        $router->post("/create-catalog", "Admin\CatalogController@create");
        $router->post("/update-catalog", "Admin\CatalogController@update");
        $router->post("/delete-catalog", "Admin\CatalogController@delete");
        $router->post("/update-catalog-position", "Admin\CatalogController@updatePosition");
        $router->post("/bulk-activate-catalogs", "Admin\CatalogController@bulkActivate");
        $router->post("/bulk-deactivate-catalogs", "Admin\CatalogController@bulkDeactivate");
        $router->post("/bulk-delete-catalogs", "Admin\CatalogController@bulkDelete");
//        news
        $router->post("/create-post", "Admin\NewsController@create");
        $router->post("/update-post", "Admin\NewsController@update");
        $router->post("/delete-post", "Admin\NewsController@delete");
        $router->post("/update-post-position", "Admin\NewsController@updatePosition");
        $router->post("/bulk-activate-posts", "Admin\NewsController@bulkActivate");
        $router->post("/bulk-deactivate-posts", "Admin\NewsController@bulkDeactivate");
        $router->post("/bulk-delete-posts", "Admin\NewsController@bulkDelete");
//        categories
        $router->post("/create-category", "Admin\CategoryController@create");
        $router->post("/update-category", "Admin\CategoryController@update");
        $router->post("/delete-category", "Admin\CategoryController@delete");
        $router->post("/update-category-position", "Admin\CategoryController@updatePosition");
        $router->post("/bulk-activate-categories", "Admin\CategoryController@bulkActivate");
        $router->post("/bulk-deactivate-categories", "Admin\CategoryController@bulkDeactivate");
        $router->post("/bulk-delete-categories", "Admin\CategoryController@bulkDelete");
//        subcategories
        $router->post("/create-subcategory", "Admin\SubcategoryController@create");
        $router->post("/update-subcategory", "Admin\SubcategoryController@update");
        $router->post("/delete-subcategory", "Admin\SubcategoryController@delete");
        $router->post("/update-subcategory-position", "Admin\SubcategoryController@updatePosition");
        $router->post("/bulk-activate-subcategories", "Admin\SubcategoryController@bulkActivate");
        $router->post("/bulk-deactivate-subcategories", "Admin\SubcategoryController@bulkDeactivate");
        $router->post("/bulk-delete-subcategories", "Admin\SubcategoryController@bulkDelete");
//        products_oil
        $router->post("/create-product-oil", "Admin\ProductsOilController@create");
        $router->post("/update-product-oil", "Admin\ProductsOilController@update");
        $router->post("/delete-product-oil", "Admin\ProductsOilController@delete");
        $router->post("/update-product-oil-position", "Admin\ProductsOilController@updatePosition");
        $router->post("/bulk-activate-products-oil", "Admin\ProductsOilController@bulkActivate");
        $router->post("/bulk-deactivate-products-oil", "Admin\ProductsOilController@bulkDeactivate");
        $router->post("/bulk-delete-products-oil", "Admin\ProductsOilController@bulkDelete");
//        products_drill
        $router->post("/create-product-drill", "Admin\ProductsDrillController@create");
        $router->post("/update-product-drill", "Admin\ProductsDrillController@update");
        $router->post("/delete-product-drill", "Admin\ProductsDrillController@delete");
        $router->post("/update-product-drill-position", "Admin\ProductsDrillController@updatePosition");
        $router->post("/bulk-activate-products-drill", "Admin\ProductsDrillController@bulkActivate");
        $router->post("/bulk-deactivate-products-drill", "Admin\ProductsDrillController@bulkDeactivate");
        $router->post("/bulk-delete-products-drill", "Admin\ProductsDrillController@bulkDelete");
//        metalworking
        $router->post("/create-metalworking", "Admin\MetalworkingController@create");
        $router->post("/update-metalworking", "Admin\MetalworkingController@update");
        $router->post("/delete-metalworking", "Admin\MetalworkingController@delete");
        $router->post("/update-metalworking-position", "Admin\MetalworkingController@updatePosition");
        $router->post("/bulk-activate-metalworking", "Admin\MetalworkingController@bulkActivate");
        $router->post("/bulk-deactivate-metalworking", "Admin\MetalworkingController@bulkDeactivate");
        $router->post("/bulk-delete-metalworking", "Admin\MetalworkingController@bulkDelete");
    }
);
