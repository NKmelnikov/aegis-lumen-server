<?php


namespace App\Services\Admin;


use App\Models\ProductsOil;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function response;

class ProductsOilService extends BaseService
{
    public function getAll()
    {
        $productsOil = DB::table('products_oil as  p')
            ->leftJoin('brands as b', 'p.brand_id', '=', 'b.id')
            ->leftJoin('categories as c', 'p.category_id', '=', 'c.id')
            ->leftJoin('subcategories as s', 'p.subcategory_id', '=', 's.id')
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
                'p.slug',
                'p.description',
                'p.spec',
                'p.imgPath',
                'p.pdf1Path',
                'p.pdf2Path',
                'p.created_at')
            ->orderBy('p.position')
            ->get();
        try {
            return response()->json($productsOil);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }

    public function getBySlug(Request $request)
    {
        $slug = json_decode($request['slug']);
        try {
            return response()->json(ProductsOil::where('slug', $slug)->first());
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }
}
