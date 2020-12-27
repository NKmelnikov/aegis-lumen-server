<?php


namespace App\Services\Admin;


use App\Models\ProductsOil;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use function response;

class BaseService
{

    protected $model;
    protected $allItems;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        try {
            return response()->json($this->model::orderBy('position')->get());
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }

    public function create(Request $request, $rules)
    {

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['validationErrors' => $validator->errors()], 400);
        }

        if(isset($request->all()['description'])) {
            $request->all()['description'] = $this->clearFrolaMessage($request->all()['description']);
        }

        if(isset($request->all()['spec'])) {
            $request->all()['spec'] = $this->clearFrolaMessage($request->all()['spec']);
        }

        if(isset($request->all()['article'])) {
            $request->all()['article'] = $this->clearFrolaMessage($request->all()['article']);
        }

        try {
            $this->model::create($request->all());
            $this->updatePosition();
            return response()->json(["message" => "success"]);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $rules)
    {
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['validationErrors' => $validator->errors()], 400);
        }

        if(isset($request->all()['description'])) {
            $request->all()['description'] = $this->clearFrolaMessage($request->all()['description']);
        }

        if(isset($request->all()['spec'])) {
            $request->all()['spec'] = $this->clearFrolaMessage($request->all()['spec']);
        }

        if(isset($request->all()['article'])) {
            $request->all()['article'] = $this->clearFrolaMessage($request->all()['article']);
        }

        try {
            $this->model::find($request->all()['id'])->update($request->all());
            return response()->json(["message" => "success"]);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }

    public function copy(Request $request, $rules)
    {
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['validationErrors' => $validator->errors()], 400);
        }

        if(isset($request->all()['description'])) {
            $request->all()['description'] = $this->clearFrolaMessage($request->all()['description']);
        }

        if(isset($request->all()['spec'])) {
            $request->all()['spec'] = $this->clearFrolaMessage($request->all()['spec']);
        }

        if(isset($request->all()['article'])) {
            $request->all()['article'] = $this->clearFrolaMessage($request->all()['article']);
        }

        try {
            $copy = $this->model::find($request->all()['id'])->replicate()->fill($request->all());
            $copy->position = $request->all()['position'] - 1;
            $copy->save();
            $this->updatePosition();
            return response()->json(["message" => "success"]);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }


    public function delete(Request $request)
    {
        try {
            $this->model::find($request->all()['id'])->delete();
            $this->updatePosition();
            return response()->json(["message" => "success"]);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }

    public function updatePosition(Request $request = null)
    {

        $items = (!is_null($request))
            ? json_decode($request['data'], true)
            : $this->model::orderBy('position', 'ASC')->get();
//        $items = $this->model::orderBy('created_at', 'DESC')->get();

        foreach ($items as $i => $item) {
            try {
                $this->model::where('id', $item['id'])->update(['position' => $i+1]);
            } catch (Exception $e) {
                return response()->json(["message" => $e->getMessage()], 400);
            }
        }

        return $this->model::orderBy('position')->get();
    }

    public function bulkActivate(Request $request)
    {
        $items = json_decode($request['data'], true);
        foreach ($items as $i => $item) {
            try {
                $this->model::where('id', $item['id'])->update(['active' => 1]);
            } catch (Exception $e) {
                return response()->json(["message" => $e->getMessage()], 400);
            }
        }
        return response()->json(["message" => "activated"]);
    }

    public function bulkDeactivate(Request $request)
    {
        $items = json_decode($request['data'], true);
        foreach ($items as $i => $item) {
            try {
                $this->model::where('id', $item['id'])->update(['active' => 0]);
            } catch (Exception $e) {
                return response()->json(["message" => $e->getMessage()], 400);
            }
        }
        return response()->json(["message" => "deactivated"]);

    }

    public function bulkDelete(Request $request)
    {
        $items = json_decode($request['data'], true);
        try {
            foreach ($items as $i => $item) {
                $this->model::where('id', $item['id'])->delete();
            }
            $this->updatePosition();
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }

        return response()->json(["message" => "deleted"]);
    }

    protected function clearFrolaMessage($text) {
        return str_replace('<p data-f-id="pbf" style="text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;">Powered by <a href="https://www.froala.com/wysiwyg-editor?pb=1" title="Froala Editor">Froala Editor</a></p>', '', $text);
    }
}
