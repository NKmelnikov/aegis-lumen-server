<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Routing\Controller as BaseController;

class BrandController extends BaseController
{
    public function getAll() {
        return Response::json(Brand::all());
    }

    public function create(Request $request) {
        try {
            $brand = $this->validate($request, [
                "active" => "required",
                "slug" => "required|string|unique:brands",
                "name" => "required|string|min:2|max:255",
                "description" => "nullable|min:2|max:255",
                "imgPath" => "required|string|min:2|max:255",
            ]);
        } catch (ValidationException $e) {
            return Response::json(["message" => $e->getMessage()], 400);
        }

        Log::info($brand);

        try {
            Brand::create($brand);
            return Response::json(["message" => "brand created"]);
        } catch (\Exception $e) {
            return Response::json(["message" => $e->getMessage()], 400);
        }
    }
}
