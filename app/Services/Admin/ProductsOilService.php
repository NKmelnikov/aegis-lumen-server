<?php


namespace App\Services\Admin;


use App\Models\ProductsOil;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            ->where('p.slug', $slug)
            ->first();

        try {
            return response()->json($productsOil);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }

    public function create(Request $request, $rules)
    {

        $validator = Validator::make($request->all(), $rules);

        $this->clearFrolaMessage($request->all()['description']);
        $this->clearFrolaMessage($request->all()['spec']);

        if ($validator->fails()) {
            return response()->json(['validationErrors' => $validator->errors()], 400);
        }

        try {
            ProductsOil::create($request->all());
            $this->updatePosition();
            return response()->json(["message" => "success"]);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $rules)
    {
        $validator = Validator::make($request->all(), $rules);

        $this->clearFrolaMessage($request->all()['description']);
        $this->clearFrolaMessage($request->all()['spec']);

        if ($validator->fails()) {
            return response()->json(['validationErrors' => $validator->errors()], 400);
        }

        try {
            ProductsOil::find($request->all()['id'])->update($request->all());
            return response()->json(["message" => "success"]);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }

    public function copy(Request $request, $rules)
    {
        $validator = Validator::make($request->all(), $rules);

        $this->clearFrolaMessage($request->all()['description']);
        $this->clearFrolaMessage($request->all()['spec']);

        if ($validator->fails()) {
            return response()->json(['validationErrors' => $validator->errors()], 400);
        }

        try {
            $product = ProductsOil::find($request->all()['id'])->replicate();
            $product->brand_id = $request->all()['brand_id'];
            $product->category_id = $request->all()['category_id'];
            $product->subcategory_id = $request->all()['subcategory_id'];
            $product->active = $request->all()['active'];
            $product->position = $request->all()['position'];
            $product->name = $request->all()['name'];
            $product->slug = $request->all()['slug'];
            $product->description = $request->all()['description'];
            $product->spec = $request->all()['spec'];
            $product->imgPath = $request->all()['imgPath'];
            $product->pdf1Path = $request->all()['pdf1Path'];
            $product->pdf2Path = $request->all()['pdf2Path'];
            $product->created_at = $request->all()['created_at'];
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
