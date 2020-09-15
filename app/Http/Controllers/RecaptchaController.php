<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Laravel\Lumen\Routing\Controller as BaseController;
use Psr\Http\Message\StreamInterface;
use function response;


class RecaptchaController extends BaseController
{
    /**
     * Registration method
     *
     * @param Request $request registration request
     *
     * @return JsonResponse|StreamInterface
     * @throws GuzzleException
     */
    public function checkValidity(Request $request)
    {
        $token = $request->json('token');

        if (!$token || empty($token)) {
            return response()->json(["message" => "token is empty while checking recaptcha"]);
        }

        $url = sprintf(
            'https://www.google.com/recaptcha/api/siteverify?secret=%s&response=%s',
            env('RECAPTCHA_SECRET'),
            $token
        );

        $client = new Client();
        $response = $client->request('GET', $url);
        return $response->getBody();
    }
}
