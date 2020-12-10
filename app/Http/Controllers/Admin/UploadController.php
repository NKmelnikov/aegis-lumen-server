<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Laravel\Lumen\Routing\Controller as BaseController;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use function response;

class UploadController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function uploadFromBase64(Request $request)
    {
        try {
            $time = time();
            $img = Image::make(base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request['b64'])))->stream();
            $storagePath = sprintf('public/img/%s__%s', $time, $request['name']);
            $publicPath = sprintf('storage/img/%s__%s', $time, $request['name']);
            Storage::put($storagePath, $img, 'public');
            return response()->json(["path" => $publicPath]);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }

    public function uploadPdf(Request $request)
    {
        $time = time();
        $name = $request->file('pdf_file')->getClientOriginalName();
        try {
            $request->file('pdf_file')->move(storage_path('app/public/pdf/'), $time . '__' . $name);
            return response()->json(['path' => 'storage/pdf/' . $time . '__' . $name, 'name' => $name]);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }

    public function ckUpload(Request $request)
    {
        $time = time();
        $name = $request->file('file')->getClientOriginalName();
        $url = sprintf('%s%s/storage/img/%s__%s', env('APP_URL'), env('APP_PORT'), $time, $name);

        try {
            $request->file('file')->move(storage_path('app/public/img/'), $time . '__' . $name);
            return json_encode(['link' => $url], JSON_UNESCAPED_SLASHES);
        } catch (Exception $e) {
            return response()->json(['uploaded' => true, 'error' => ['message' => $e->getMessage()]], 400);
        }
    }

//    private function uniqueName($path){
//        $new_path = '';
//        list($directory, , $extension, $filename) = array_values(pathinfo($path));
//
//        if(!Storage::exists($path)) {
//            Log::info('exists?');
//            return $path;
//        }
//
//        $i = 0;
//        while (Storage::exists($path))
//        {
//            $new_path = $directory . '/' . $filename . '-' . $i . '.' . $extension;
//            $i++;
//        }
//
//        if ($path !== $new_path && !rename($path, $new_path))
//        {
//            throw new Exception('Error renaming `'.$path.'` to `'.$new_path.'`');
//        }
//
//
//        return $new_path;
//
//    }
}
