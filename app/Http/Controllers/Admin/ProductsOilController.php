<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductsOil;
use App\Services\Admin\ProductsOilService;
use Illuminate\Http\Request;

class ProductsOilController
{
    /**
     * @var ProductsOilService
     */
    private $productsOilService;
    private $createValidator = [
        "brand_id" => "nullable",
        "category_id" => "required",
        "subcategory_id" => "nullable",
        "active" => "required",
        "name" => "required|min:2|max:255",
        "slug" => "required|min:2|max:255|unique:products_oil",
        "description" => "nullable",
        "spec" => "nullable",
        "imgPath" => "required|min:2|max:255",
        "pdf1Path" => "nullable|min:2|max:255",
        "pdf2Path" => "nullable|min:2|max:255",
    ];
    private $updateValidator = [
        "brand_id" => "nullable",
        "category_id" => "required",
        "subcategory_id" => "nullable",
        "active" => "required",
        "name" => "required|min:2|max:255",
        "slug" => "required|min:2|max:255",
        "description" => "nullable",
        "spec" => "nullable",
        "imgPath" => "required|min:2|max:255",
        "pdf1Path" => "nullable|min:2|max:255",
        "pdf2Path" => "nullable|min:2|max:255",
    ];

    public function __construct()
    {
        $this->productsOilService = new ProductsOilService(ProductsOil::class);
    }

    public function getAll() {
        return $this->productsOilService->getAll();
    }

    public function getBySlug(Request $request) {
        return $this->productsOilService->getBySlug($request);
    }

    public function create(Request $request) {
        return $this->productsOilService->create($request, $this->createValidator);
    }

    public function update(Request $request) {
        return $this->productsOilService->update($request, $this->updateValidator);
    }

    public function copy(Request $request) {
        return $this->productsOilService->copy($request, $this->createValidator);
    }

    public function delete(Request $request) {
        return $this->productsOilService->delete($request);
    }

    public function updatePosition(Request $request) {
        $this->productsOilService->updatePosition($request);
    }

    public function bulkActivate(Request $request) {
        $this->productsOilService->bulkActivate($request);
    }
    public function bulkDeactivate(Request $request) {
        $this->productsOilService->bulkDeactivate($request);
    }
    public function bulkDelete(Request $request) {
        $this->productsOilService->bulkDelete($request);
    }
}
