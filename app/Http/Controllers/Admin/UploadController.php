<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Laravel\Lumen\Routing\Controller as BaseController;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

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
            $profileImg= Image::make(base64_decode(preg_replace('#^data:image/\w+;base64,#i', '',$request['b64'])))->stream();
            Storage::put('img/'.$request['name'], $profileImg, 'public');
            // TODO auto increment in name
            return Response::json(["path" =>'img/'.$request['name']]);
        } catch (\Exception $e) {
            return Response::json(["message" => $e->getMessage()], 400);
        }
    }
}
