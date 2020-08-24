<?php


namespace App\Services\Admin;


use App\Models\Brand;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BrandService extends BaseService
{


    public function getBrandBySlug(Request $request)
    {
        try {
            return Response::json(Brand::where('slug', $request->all()['slug'])->first());
        } catch (Exception $e) {
            return Response::json(["message" => $e->getMessage()], 400);
        }
    }
}
