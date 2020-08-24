<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Services\Admin\BrandService;
use Illuminate\Http\Request;

class BrandController
{
    /**
     * @var BrandService
     */
    private $brandService;

    public $validatorRules = [
        "active" => "required",
        "slug" => "required|string|unique:brands",
        "name" => "required|string|min:2|max:255",
        "description" => "nullable|min:2|max:255",
        "imgPath" => "required|string|min:2|max:255",
    ];

    public function __construct()
    {
        $this->brandService = new BrandService(Brand::class);
    }

    public function getAll() {
        return $this->brandService->getAll();
    }

    public function getBrandBySlug(Request $request) {
        return $this->brandService->getBrandBySlug($request);
    }

    public function create(Request $request) {
        return $this->brandService->create($request, $this->validatorRules);
    }

    public function update(Request $request) {
        return $this->brandService->update($request, $this->validatorRules);
    }

    public function delete(Request $request) {
        return $this->brandService->delete($request);
    }

    public function updatePosition(Request $request) {
        $this->brandService->updatePosition($request);
    }

    public function bulkActivate(Request $request) {
        $this->brandService->bulkActivate($request);
    }
    public function bulkDeactivate(Request $request) {
        $this->brandService->bulkDeactivate($request);
    }
    public function bulkDelete(Request $request) {
        $this->brandService->bulkDelete($request);
    }
}
