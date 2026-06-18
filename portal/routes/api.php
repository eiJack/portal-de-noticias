<?php

use App\Http\Controllers\Api\Public\CategoryController;
use App\Http\Controllers\Api\Public\NoticeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('public')->group(function () {
    Route::get('/', [CategoryController::class, 'home']);
    Route::get('/categories', [CategoryController::class, 'list']);
    Route::get('/categories/{slug}', [CategoryController::class, 'index']);
    Route::get('/notices', [NoticeController::class, 'latest']);
    Route::get('/notices/search', [NoticeController::class, 'search']);
    Route::get('/notices/{slug}', [NoticeController::class, 'show']);
});
