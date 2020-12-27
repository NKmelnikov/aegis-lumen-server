<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Metalworking;
use App\Services\Admin\MetalworkingService;
use Illuminate\Http\Request;

class MetalworkingController
{
    /**
     * @var MetalworkingService
     */
    private $metalworkingService;

    public function __construct()
    {
        $this->metalworkingService = new MetalworkingService(Metalworking::class);
    }

    private function getValidatorRules() {

        return [
            "active" => "required",
            "name" => "nullable",
            "description" => "nullable",
            "imgPath" => "required|string|min:2|max:255",
        ];
    }

    public function getAll()
    {
        return $this->metalworkingService->getAll();
    }

    public function create(Request $request)
    {
        return $this->metalworkingService->create($request, $this->getValidatorRules());
    }

    public function update(Request $request)
    {
        return $this->metalworkingService->update($request, $this->getValidatorRules());
    }

    public function copy(Request $request) {
        return $this->metalworkingService->copy($request, $this->getValidatorRules());
    }

    public function delete(Request $request)
    {
        return $this->metalworkingService->delete($request);
    }

    public function updatePosition(Request $request)
    {
        $this->metalworkingService->updatePosition($request);
    }

    public function bulkActivate(Request $request)
    {
        $this->metalworkingService->bulkActivate($request);
    }

    public function bulkDeactivate(Request $request)
    {
        $this->metalworkingService->bulkDeactivate($request);
    }

    public function bulkDelete(Request $request)
    {
        $this->metalworkingService->bulkDelete($request);
    }
}
