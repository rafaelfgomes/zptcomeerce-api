<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::prefix('products')->group(function () {
    Route::get('', [ ProductController::class, 'all' ]);
    Route::post('', [ ProductController::class, 'store' ]);
    Route::get('actives', [ ProductController::class, 'getActives' ]);
    Route::get('search/{productName}', [ ProductController::class, 'search' ]);
    Route::post('{product}/checkout', [ ProductController::class, 'checkout' ]);
    Route::get('{product}', [ ProductController::class, 'getOne' ]);
    Route::put('{product}', [ ProductController::class, 'update' ]);
    Route::delete('{product}', [ ProductController::class, 'delete' ]);
});


