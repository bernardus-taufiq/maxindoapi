<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApiRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class ShopeeController extends Controller
{
    public function getItemList(Request $request)
    {
        $partner_id = 1047757;
        $timestamp = time();
        $shop_id = 86864;
        $access_token = '446d65567a694e4a74616e6c5359446c';
        $offset=0;
        $page_size=10;
        $update_time_from = time() - 60 * 60 * 24;
        $update_time_to = time();
        $item_status='NORMAL';

        $params = "partner_id={$partner_id}&timestamp={$timestamp}&shop_id={$shop_id}&access_token={$access_token}";
        $sign = hash_hmac('sha256', $params, env('SHOPEE_TEST_KEY'));

        $response = Http::get('https://partner.test-stable.shopeemobile.com/api/v2/product/get_item_list', [
            'partner_id' => $partner_id,
            'timestamp' => $timestamp,
            'shop_id' => $shop_id,
            'access_token' => $access_token,
            'sign' => $sign,
            'offset' => $offset,
            'page_size' => $page_size,
//            'update_time_from' => $update_time_from,
//            'update_time_to' => $update_time_to,
            'item_status' => $item_status
        ]);

        if ($response->status() == 200) {
            return $response->json();
        } else {
            return $response->json(['error' => $response->status()], $response->status());
        }
    }
}
