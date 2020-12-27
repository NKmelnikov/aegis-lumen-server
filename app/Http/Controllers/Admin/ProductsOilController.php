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

    public function __construct()
    {
        $this->productsOilService = new ProductsOilService(ProductsOil::class);
    }

    public function getAll() {
        return $this->productsOilService->getAll();
    }

    private function getValidatorRules($isUpdateMethod = false) {

        return [
            "brand_id" => "nullable",
            "category_id" => "required",
            "subcategory_id" => "nullable",
            "active" => "required",
            "name" => "required|min:2|max:255",
            "slug" => ($isUpdateMethod) ? "required|min:2|max:255" : "required|min:2|max:255|unique:products_oil",
            "description" => "nullable",
            "spec" => "nullable",
            "imgPath" => "required|min:2|max:255",
            "pdf1Path" => "nullable|min:2|max:255",
            "pdf2Path" => "nullable|min:2|max:255",
        ];
    }

    public function getAllBrand() {
        return $this->productsOilService->getAllBrand();
    }

    public function getBySlug(Request $request) {
        return $this->productsOilService->getBySlug($request);
    }

    public function getByCategorySlug(Request $request) {
        return $this->productsOilService->getByCategorySlug($request);
    }

    public function getBySubcategorySlug(Request $request) {
        return $this->productsOilService->getBySubcategorySlug($request);
    }

    public function getByBrandSlug(Request $request) {
        return $this->productsOilService->getByBrandSlug($request);
    }

    public function create(Request $request) {
        return $this->productsOilService->create($request, $this->getValidatorRules());
    }

    public function update(Request $request) {
        return $this->productsOilService->update($request, $this->getValidatorRules(true));
    }

    public function copy(Request $request) {
        return $this->productsOilService->copy($request, $this->getValidatorRules());
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
