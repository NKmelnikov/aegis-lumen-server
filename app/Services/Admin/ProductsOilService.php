<?php


namespace App\Services\Admin;


use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use function response;

class ProductsOilService extends BaseService
{
    public function getAll()
    {
        try {
            return response()->json(Category::with('subcategories')->where('id', $request->all()['id'])->first());
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }
}
