<?php

use App\Http\Controllers\user\OnepayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PayrantWebhookController;
use App\Http\Controllers\Api\VTStackWebhookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/payrant/webhook', [PayrantWebhookController::class, 'handle']);
Route::post('/vtstack/webhook', [VTStackWebhookController::class, 'handle']);
Route::post('/vtstack', [VTStackWebhookController::class, 'handle']); // Backwards compat for dashboard URL

Route::get('number/{type}', [OnepayController::class, 'return_number']);
Route::get('deposit/submit', [OnepayController::class, 'depositSubmit']);
