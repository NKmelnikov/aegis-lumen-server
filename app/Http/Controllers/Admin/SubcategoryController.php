<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subcategory;
use App\Services\Admin\SubcategoryService;
use Illuminate\Http\Request;

class SubcategoryController
{
    /**
     * @var SubcategoryService
     */
    private $subcategoryService;

    public $validatorRules = [
        "active" => "required",
        "category_id" => "required",
        "name" => "required|max:255",
        "description" => "nullable|min:2|max:2000",
    ];


    public function __construct()
    {
        $this->subcategoryService = new SubcategoryService(Subcategory::class);
    }

    public function getAll() {
        return $this->subcategoryService->getAll();
    }

    public function getByCategoryId(Request $request) {
        return $this->subcategoryService->getByCategoryId($request);
    }

    public function create(Request $request) {
        return $this->subcategoryService->create($request, $this->validatorRules);
    }

    public function update(Request $request) {
        return $this->subcategoryService->update($request, $this->validatorRules);
    }

    public function delete(Request $request) {
        return $this->subcategoryService->delete($request);
    }

    public function updatePosition(Request $request) {
        $this->subcategoryService->updatePosition($request);
    }

    public function bulkActivate(Request $request) {
        $this->subcategoryService->bulkActivate($request);
    }
    public function bulkDeactivate(Request $request) {
        $this->subcategoryService->bulkDeactivate($request);
    }
    public function bulkDelete(Request $request) {
        $this->subcategoryService->bulkDelete($request);
    }
}
