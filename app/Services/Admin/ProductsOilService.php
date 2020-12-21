<?php


namespace App\Services\Admin;


use App\Models\ProductsOil;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
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
                'c.slug as category_slug',
                DB::Raw('IFNULL( `s`.`name` , "no-subcategory" ) as subcategory_name'),
                DB::Raw('IFNULL( `s`.`slug` , "no-subcategory" ) as subcategory_slug'),
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
        $slug = $request['slug'];

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
                'c.slug as category_slug',
                DB::Raw('IFNULL( `s`.`name` , "no-subcategory" ) as subcategory_name'),
                DB::Raw('IFNULL( `s`.`slug` , "no-subcategory" ) as subcategory_slug'),
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
            ->where('p.slug', $slug)
            ->first();

        try {
            return response()->json($productsOil);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }

    public function getByCategorySlug(Request $request)
    {
        $slug = $request['slug'];

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
                'c.slug as category_slug',
                DB::Raw('IFNULL( `s`.`name` , "no-subcategory" ) as subcategory_name'),
                DB::Raw('IFNULL( `s`.`slug` , "no-subcategory" ) as subcategory_slug'),
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
            ->where('c.slug', $slug)
            ->get();

        Log::info(response()->json($productsOil));

        try {
            return response()->json($productsOil);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }

    public function getBySubcategorySlug(Request $request)
    {
        $slug = $request['slug'];

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
                'c.slug as category_slug',
                DB::Raw('IFNULL( `s`.`name` , "no-subcategory" ) as subcategory_name'),
                DB::Raw('IFNULL( `s`.`slug` , "no-subcategory" ) as subcategory_slug'),
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
            ->where('s.slug', $slug)
            ->get();

        try {
            return response()->json($productsOil);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }

    public function getAllBrand()
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
                'c.slug as category_slug',
                DB::Raw('IFNULL( `s`.`name` , "no-subcategory" ) as subcategory_name'),
                DB::Raw('IFNULL( `s`.`slug` , "no-subcategory" ) as subcategory_slug'),
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
            ->whereNotNull('p.brand_id')
            ->orderBy('p.position')
            ->get();

        try {
            return response()->json($productsOil);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }

    public function getByBrandSlug(Request $request)
    {
        $slug = $request['slug'];

        $productsOil = DB::table('products_oil as  p')
            ->leftJoin('brands as b', 'p.brand_id', '=', 'b.id')
            ->leftJoin('categories as c', 'p.category_id', '=', 'c.id')
            ->leftJoin('subcategories as s', 'p.subcategory_id', '=', 's.id')
            ->select('p.id as id',
                'p.brand_id',
                'p.category_id',
                'p.subcategory_id',
                'b.name as brand_name',
                'b.slug as brand_slug',
                'c.name as category_name',
                'c.slug as category_slug',
                DB::Raw('IFNULL( `s`.`name` , "no-subcategory" ) as subcategory_name'),
                DB::Raw('IFNULL( `s`.`slug` , "no-subcategory" ) as subcategory_slug'),
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
            ->where('b.slug', $slug)
            ->get();
        Log::info(response()->json($productsOil));
        try {
            return response()->json($productsOil);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }

    public function create(Request $request, $rules)
    {
        $product = $request->all();

        $validator = Validator::make($product, $rules);

        if ($validator->fails()) {
            return response()->json(['validationErrors' => $validator->errors()], 400);
        }

        $product['description'] = $this->clearFrolaMessage($product['description']);
        $product['spec'] = $this->clearFrolaMessage($product['spec']);

        try {
            ProductsOil::create($product);
            $this->updatePosition();
            return response()->json(["message" => "success"]);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $rules)
    {
        $product = $request->all();

        $validator = Validator::make($product, $rules);

        if ($validator->fails()) {
            return response()->json(['validationErrors' => $validator->errors()], 400);
        }

        $product['description'] = $this->clearFrolaMessage($product['description']);
        $product['spec'] = $this->clearFrolaMessage($product['spec']);

        try {
            ProductsOil::find($product['id'])->update($product);
            return response()->json(["message" => "success"]);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }

    public function copy(Request $request, $rules)
    {
        $rec = $request->all();

        $validator = Validator::make($rec, $rules);

        if ($validator->fails()) {
            return response()->json(['validationErrors' => $validator->errors()], 400);
        }

        $rec['description'] = $this->clearFrolaMessage($rec['description']);
        $rec['spec'] = $this->clearFrolaMessage($rec['spec']);


        try {
            $product = ProductsOil::find($rec['id'])->replicate();
            $product->brand_id = $rec['brand_id'];
            $product->category_id = $rec['category_id'];
            $product->subcategory_id = $rec['subcategory_id'];
            $product->active = $rec['active'];
            $product->position = $rec['position'];
            $product->name = $rec['name'];
            $product->slug = $rec['slug'];
            $product->description = $rec['description'];
            $product->spec = $rec['spec'];
            $product->imgPath = $rec['imgPath'];
            $product->pdf1Path = $rec['pdf1Path'];
            $product->pdf2Path = $rec['pdf2Path'];
            $product->created_at = $rec['created_at'];
            $product->save();
            $this->updatePosition();
            return response()->json(["message" => "success"]);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }

    private function clearFrolaMessage($text) {
        return str_replace('<p data-f-id="pbf" style="text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;">Powered by <a href="https://www.froala.com/wysiwyg-editor?pb=1" title="Froala Editor">Froala Editor</a></p>', '', $text);
    }
}
