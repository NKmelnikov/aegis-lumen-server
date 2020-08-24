<?php


namespace App\Services\Admin;


use App\Models\Brand;
use Exception;
use Illuminate\Http\Request;
use function response;


class BrandService extends BaseService
{


    public function getBrandBySlug(Request $request)
    {
        try {
            return response()->json(Brand::where('slug', $request->all()['slug'])->first());
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }
}
