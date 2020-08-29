<?php


namespace App\Services\Admin;


use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function response;

class ProductsDrillService extends BaseService
{
    public function getAll()
    {
        $catalogs = DB::table('products_drill as  p')
            ->join('brands as b', 'p.brand_id', '=', 'b.id')
            ->join('categories as c', 'p.category_id', '=', 'c.id')
            ->join('subcategories as s', 'p.subcategory_id', '=', 's.id')
            ->select('p.id as id',
                'p.brand_id',
                'p.category_id',
                'p.subcategory_id',
                'b.name as brand_name',
                'c.name as category_name',
                's.name as subcategory_name',
                'p.active',
                'p.position',
                'p.name',
                'p.description',
                'p.pdfPath',
                'p.created_at')
            ->orderBy('p.position')
            ->get();
        try {
            return response()->json($catalogs);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }
}
