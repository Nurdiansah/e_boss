<?php

use App\Http\Controllers\Api\EquipmentApiController;
use App\Http\Controllers\Api\StevedoringApiController;
use App\Http\Controllers\Api\StevedoringManifestApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


//     Route::group(['middleware' => ['role:checker']], function () {
// Stevedoring 
Route::get('/stevedoring', [StevedoringApiController::class, 'index']);
Route::get('/stevedoring/{stevedoring:id}', [StevedoringApiController::class, 'show']);
Route::get('/stevedoring-manifest/{stevedoring:id}', [StevedoringApiController::class, 'showManifest']);
Route::put('/stevedoring/{stevedoring:id}/start', [StevedoringApiController::class, 'start']);
Route::put('/stevedoring/{stevedoring:id}/stop', [StevedoringApiController::class, 'stop']);
Route::put('/stevedoring/{stevedoring:id}/continue', [StevedoringApiController::class, 'continue']);
Route::put('/stevedoring/{stevedoring:id}/finish', [StevedoringApiController::class, 'finish']);

// Stevedoring Manifest
Route::get('/stevedoring-manifest/{stevedoringmanifest:id}', [StevedoringManifestApiController::class, 'show']);
Route::put('/stevedoring-manifest/{stevedoring:id}/lolo', [StevedoringManifestApiController::class, 'lolo']);

// Equipment
Route::get('/equipment-by-category/{equipment:id}', [EquipmentApiController::class, 'showByCategory']);
//     });
// });
