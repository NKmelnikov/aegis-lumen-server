<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Services\Admin\CategoryService;
use Illuminate\Http\Request;

class SubcategoryController
{
    /**
     * @var categoryService
     */
    private $categoryService;

    public $validatorRules = [
        "active" => "required",
        "category_id" => "required",
        "name" => "required|max:255",
        "description" => "required|min:2|max:1500",
    ];

    public function __construct()
    {
        $this->categoryService = new CategoryService(Category::class);
    }

    public function getAll() {
        return $this->categoryService->getAll();
    }

    public function getById(Request $request) {
        return $this->categoryService->getById($request);
    }

    public function create(Request $request) {
        return $this->categoryService->create($request, $this->validatorRules);
    }

    public function update(Request $request) {
        return $this->categoryService->update($request, $this->validatorRules);
    }

    public function delete(Request $request) {
        return $this->categoryService->delete($request);
    }

    public function updatePosition(Request $request) {
        $this->categoryService->updatePosition($request);
    }

    public function bulkActivate(Request $request) {
        $this->categoryService->bulkActivate($request);
    }
    public function bulkDeactivate(Request $request) {
        $this->categoryService->bulkDeactivate($request);
    }
    public function bulkDelete(Request $request) {
        $this->categoryService->bulkDelete($request);
    }
}
