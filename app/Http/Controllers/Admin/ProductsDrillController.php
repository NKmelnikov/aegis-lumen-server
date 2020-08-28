<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductsDrill;
use App\Services\Admin\ProductsDrillService;
use Illuminate\Http\Request;

class ProductsDrillController
{
    /**
     * @var ProductsDrillService
     */
    private $productsDrillService;

    public $validatorRules = [
        "brand_id" => "required",
        "category_id" => "required",
        "subcategory_id" => "required",
        "active" => "required",
        "name" => "required|max:255",
        "description" => "required|min:2|max:1500",
        "pdfPath" => "required|min:2|max:255",
    ];


    public function __construct()
    {
        $this->productsDrillService = new ProductsDrillService(ProductsDrill::class);
    }

    public function getAll() {
        return $this->productsDrillService->getAll();
    }

    public function create(Request $request) {
        return $this->productsDrillService->create($request, $this->validatorRules);
    }

    public function update(Request $request) {
        return $this->productsDrillService->update($request, $this->validatorRules);
    }

    public function delete(Request $request) {
        return $this->productsDrillService->delete($request);
    }

    public function updatePosition(Request $request) {
        $this->productsDrillService->updatePosition($request);
    }

    public function bulkActivate(Request $request) {
        $this->productsDrillService->bulkActivate($request);
    }
    public function bulkDeactivate(Request $request) {
        $this->productsDrillService->bulkDeactivate($request);
    }
    public function bulkDelete(Request $request) {
        $this->productsDrillService->bulkDelete($request);
    }
}
