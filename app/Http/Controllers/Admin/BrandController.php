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

    public function __construct()
    {
        $this->brandService = new BrandService(Brand::class);
    }

    private function getValidatorRules($isUpdateMethod = false) {

        return [
            "active" => "required",
            "slug" => ($isUpdateMethod) ? "required|min:2" : 'required|min:2|unique:brands',
            "name" => "required|min:2|max:255",
            "description" => "nullable",
            "imgPath" => "required|string|min:2|max:255",
        ];
    }

    public function getAll()
    {
        return $this->brandService->getAll();
    }

    public function getBySlug(Request $request)
    {
        return $this->brandService->getBySlug($request);
    }

    public function create(Request $request)
    {
        return $this->brandService->create($request, $this->getValidatorRules());
    }

    public function update(Request $request)
    {
        return $this->brandService->update($request, $this->getValidatorRules(true));
    }

    public function copy(Request $request) {
        return $this->brandService->copy($request, $this->getValidatorRules());
    }

    public function delete(Request $request)
    {
        return $this->brandService->delete($request);
    }

    public function updatePosition(Request $request)
    {
        $this->brandService->updatePosition($request);
    }

    public function bulkActivate(Request $request)
    {
        $this->brandService->bulkActivate($request);
    }

    public function bulkDeactivate(Request $request)
    {
        $this->brandService->bulkDeactivate($request);
    }

    public function bulkDelete(Request $request)
    {
        $this->brandService->bulkDelete($request);
    }
}
