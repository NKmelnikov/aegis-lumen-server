<?php


namespace App\Services\Admin;


use App\Models\News;
use Exception;
use Illuminate\Http\Request;
use function response;


class NewsService extends BaseService
{
    public function getNewsItemBySlug(Request $request)
    {
        try {
            return response()->json(News::where('slug', $request->all()['slug'])->first());
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }
}
