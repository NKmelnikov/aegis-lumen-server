<?php


namespace App\Services\Admin;


use App\Models\Brand;
use Exception;
use Illuminate\Http\Request;
use function response;


class BrandService extends BaseService
{


    public function getBySlug(Request $request)
    {
        $slug = json_decode($request['slug']);
        try {
            return response()->json(Brand::with('catalogs')->where('slug', $slug)->orderBy('position')->get());
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }
}
