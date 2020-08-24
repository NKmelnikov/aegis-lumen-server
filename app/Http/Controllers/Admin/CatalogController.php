<?php

namespace App\Http\Controllers\Admin;

use App\Models\Catalog;
use App\Services\Admin\CatalogService;
use Illuminate\Http\Request;

class CatalogController
{
    /**
     * @var CatalogService
     */
    private $catalogService;

    public $validatorRules = [
        "brand_id" => "required",
        "active" => "required",
        "name" => "string|min:2|max:255",
        "pdfPath" => "string|min:2|max:255",
    ];

    public function __construct()
    {
        $this->catalogService = new CatalogService(Catalog::class);
    }

    public function getAll() {
        return $this->catalogService->getAll();
    }

    public function create(Request $request) {
        return $this->catalogService->create($request, $this->validatorRules);
    }

    public function update(Request $request) {
        return $this->catalogService->update($request, $this->validatorRules);
    }

    public function delete(Request $request) {
        return $this->catalogService->delete($request);
    }

    public function updatePosition() {
        $this->catalogService->updatePosition();
    }

    public function bulkActivate() {
        $this->catalogService->bulkActivate();
    }
    public function bulkDeactivate() {
        $this->catalogService->bulkDeactivate();
    }
    public function bulkDelete() {
        $this->catalogService->bulkDelete();
    }
}
