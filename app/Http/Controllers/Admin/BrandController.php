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

    public function updatePosition() {
        $this->brandService->updatePosition();
    }

    public function bulkActivate() {
        $this->brandService->bulkActivate();
    }
    public function bulkDeactivate() {
        $this->brandService->bulkDeactivate();
    }
    public function bulkDelete() {
        $this->brandService->bulkDelete();
    }
}
