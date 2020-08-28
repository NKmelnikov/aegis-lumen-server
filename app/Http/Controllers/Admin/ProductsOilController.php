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

    public $validatorRules = [
        "brand_id" => "required",
        "category_id" => "required",
        "subcategory_id" => "required",
        "active" => "required",
        "name" => "required|min:2|max:255",
        "slug" => "required|min:2|max:255",
        "description" => "required|min:2|max:1500",
        "spec" => "nullable|max:1500",
        "imgPath" => "required|min:2|max:255",
        "pdf1Path" => "required|min:2|max:255",
        "pdf2Path" => "required|min:2|max:255",
    ];


    public function __construct()
    {
        $this->productsOilService = new ProductsOilService(ProductsOil::class);
    }

    public function getAll() {
        return $this->productsOilService->getAll();
    }

    public function create(Request $request) {
        return $this->productsOilService->create($request, $this->validatorRules);
    }

    public function update(Request $request) {
        return $this->productsOilService->update($request, $this->validatorRules);
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
