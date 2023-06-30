<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApiRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Response;

class ApiController extends Controller
{
    public function captureApiRequest(Request $request)
    {
        // Mendapatkan seluruh data request
        $requestData = $request->header();

        // Menyimpan data request ke dalam database
        $apiRequest = new ApiRequest();
        $apiRequest->request = json_encode($requestData);
        $apiRequest->save();

        // Menanggapi request dengan response yang sesuai
        return response()->json([
            'status' => 'success',
            'message' => 'API request captured and saved successfully',
        ]);
    }
    public function passthrough(Request $request)
    {
        $url = 'https://maxindomaxgoadminservice.azurewebsites.net' . request()->getRequestUri();
        $apiRequest = new ApiRequest();
        $requestData = $request->all();
        $apiRequest->request = json_encode($requestData);
        $apiRequest->save();
        return Http::withHeaders($request->header())->post($url);
    //    $response = Http::withHeaders(Request()->header())->post();
    //    return $response;
    }

    public function passtru(Request $request)
    {
        $url = 'https://www.omdbapi.com';

        //$response = Http::withHeaders($request->header())->get($url, $request->all());
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
    //        'Authorization' => 'Bearer your-token',
        ])->get($url);

        return $response->json();
    }

    public function testing(Request $request)
    {
        $url = 'https://www.omdbapi.com/?i=tt3896198&apikey=16c7142b';
    //    $response = Http::withHeaders([
    //        'Content-Type' => 'application/json',
    //        'Authorization' => 'Bearer your-token',
    //    ])->get($url);
        $response = $request->getContent();
        $apiRequest = new ApiRequest();
        $apiRequest->request = json_encode($response);
        $apiRequest->save();
        return response()->json(['message' => 'Success'], Response::HTTP_OK);

        //return response('OK', Response::HTTP_OK)->header('Content-Type', 'text/plain');
        //return $response;
    }

    public function shopee(Request $request)
    {
        $url = 'https://partner.test-stable.shopeemobile.com/api/v2/product/get_item_list';
        $response = $request->getContent();
        $apiRequest = new ApiRequest();
        $apiRequest->request = json_encode($response);
        $apiRequest->save();
        return response()->json(['message' => 'Success'], Response::HTTP_OK);
  }
}
