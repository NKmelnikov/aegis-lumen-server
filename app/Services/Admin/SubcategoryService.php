<?php


namespace App\Services\Admin;


use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function response;

class SubcategoryService extends BaseService
{
    public function getByCategoryId(Request $request)
    {
        $result = DB::table('subcategories as s')
            ->join('categories as c', 's.category_id', '=', 'c.id')
            ->where('c.id', '=', $request['id'])
            ->select('s.*')
            ->get();
        try {
            return response()->json($result);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }
}
