<?php


namespace App\Services\Admin;


use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function response;

class SubcategoryService extends BaseService
{
    public function getAll()
    {
        $catalogs = DB::table('subcategories')
            ->join('categories', 'subcategories.category_id', '=', 'categories.id')
            ->select('subcategories.* ?',
                'catalogs.brand_id',
                'brands.name as brand_name',
                'catalogs.active',
                'catalogs.position',
                'catalogs.name',
                'catalogs.pdfPath',
                'catalogs.created_at')
            ->get();
        try {
            return response()->json($catalogs);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }
}
