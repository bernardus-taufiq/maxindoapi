<?php

use App\Http\Controllers\ItemsController;
use App\Http\Controllers\ShopeeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

return response()->json('Hello World!', 200);
});

Route::resource('items', ItemsController::class);

Route::post('/api/security/login', [ApiController::class, 'captureApiRequest']);
Route::post('passthrough', [ApiController::class, 'passthrough']);
Route::get('passtru', [ApiController::class, 'passtru']);
Route::any('testing', [ApiController::class, 'testing']);
Route::get('/shopee/get-item-list', [ShopeeController::class, 'getItemList']);

