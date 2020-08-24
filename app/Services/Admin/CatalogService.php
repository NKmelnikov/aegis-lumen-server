<?php


namespace App\Services\Admin;

use Exception;
use Illuminate\Support\Facades\DB;
use function response;

class CatalogService extends BaseService
{

    public function getAll()
    {
        $catalogs = DB::table('catalogs')
            ->join('brands', 'catalogs.brand_id', '=', 'brands.id')
            ->select('catalogs.id as id',
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
