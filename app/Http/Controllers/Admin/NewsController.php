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

    public function __construct()
    {
        $this->newsService = new NewsService(News::class);
    }

    private function getValidatorRules($isUpdateMethod = false) {

        return [
            "active" => "required",
            "slug" => ($isUpdateMethod) ? "required|min:2|max:200" : "required|min:2|max:200|unique:news",
            "title" => "required|min:2|max:255",
            "shortText" => "required|min:2|max:400",
            "article" => "required",
            "imgPath" => "required|string|min:2|max:255",
        ];
    }

    public function getAll()
    {
        return $this->newsService->getAll();
    }

    public function create(Request $request)
    {
        return $this->newsService->create($request, $this->getValidatorRules());
    }

    public function update(Request $request)
    {
        return $this->newsService->update($request, $this->getValidatorRules(true));
    }

    public function copy(Request $request) {
        return $this->newsService->copy($request, $this->getValidatorRules());
    }

    public function delete(Request $request)
    {
        return $this->newsService->delete($request);
    }

    public function updatePosition(Request $request)
    {
        $this->newsService->updatePosition($request);
    }

    public function bulkActivate(Request $request)
    {
        $this->newsService->bulkActivate($request);
    }

    public function bulkDeactivate(Request $request)
    {
        $this->newsService->bulkDeactivate($request);
    }

    public function bulkDelete(Request $request)
    {
        $this->newsService->bulkDelete($request);
    }
}
