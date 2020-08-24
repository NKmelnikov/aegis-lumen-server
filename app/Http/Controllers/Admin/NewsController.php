<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Services\Admin\NewsService;
use Illuminate\Http\Request;

class NewsController
{
    /**
     * @var NewsService
     */
    private $newsService;

    public $validatorRules = [
        "active" => "required",
        "slug" => "required|min:2|max:200|unique:news",
        "title" => "required|min:2|max:255",
        "shortText" => "required|min:2|max:400",
        "article" => "required",
        "imgPath" => "required|string|min:2|max:255",
    ];

    public function __construct()
    {
        $this->newsService = new NewsService(News::class);
    }

    public function getAll() {
        return $this->newsService->getAll();
    }

    public function create(Request $request) {
        return $this->newsService->create($request, $this->validatorRules);
    }

    public function update(Request $request) {
        return $this->newsService->update($request, $this->validatorRules);
    }

    public function delete(Request $request) {
        return $this->newsService->delete($request);
    }

    public function updatePosition() {
        $this->newsService->updatePosition();
    }

    public function bulkActivate() {
        $this->newsService->bulkActivate();
    }
    public function bulkDeactivate() {
        $this->newsService->bulkDeactivate();
    }
    public function bulkDelete() {
        $this->newsService->bulkDelete();
    }
}
