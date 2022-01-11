<?php

use App\Http\Controllers\PermohonanDanaController;
use App\Http\Controllers\PermohonanDanaSubOneController;
use App\Http\Controllers\StevedoringController;
use App\Http\Controllers\StevedoringManifestController;
use App\Http\Controllers\StevedoringUseEquipmentController;
use App\Models\StevedoringUseEquipment;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        // dd(auth()->user()->ia);
        return view('home');
    })->name('home');

    Route::get('/storage/{id}')->name('link');

    Route::group(['middleware' => ['role:superuser|admin_ops']], function () {
        // Stevedoring
        Route::get('/stevedoring/create', [StevedoringController::class, 'create'])->name('stevedoring.create');

        Route::post('/stevedoring', [StevedoringController::class, 'store'])->name('stevedoring.store');
        Route::get('/stevedoring/{stevedoring:id}/edit', [StevedoringController::class, 'edit'])->name('stevedoring.edit');
        Route::put('/stevedoring/{stevedoring:id}', [StevedoringController::class, 'update'])->name('stevedoring.update');
        Route::get('/stevedoring/draft', [StevedoringController::class, 'draft'])->name('stevedoring.draft');
        Route::post('/stevedoring/release', [StevedoringController::class, 'release'])->name('stevedoring.release');
        Route::get('/stevedoring/proses', [StevedoringController::class, 'proses'])->name('stevedoring.proses');
        Route::get('/stevedoring/{stevedoring:id}', [StevedoringController::class, 'show'])->name('stevedoring.show');

        // Manifest stevedoring
        Route::post('/stevedoring-manifest', [StevedoringManifestController::class, 'store'])->name('stevedoring.manifest.store');
        Route::put('/stevedoring-manifest/{stevedoringmanifest:id}', [StevedoringManifestController::class, 'update'])->name('stevedoring.manifest.update');
        Route::delete('/stevedoring-manifest/{stevedoringmanifest:id}', [StevedoringManifestController::class, 'destroy'])->name('stevedoring.manifest.destroy');

        // stevedoring use equipment
        Route::post('/stevedoring-use-equipment', [StevedoringUseEquipmentController::class, 'store'])->name('stevedoring.use.equipment.store');
    });

    Route::group(['middleware' => ['role:checker']], function () {
        Route::get('/stevedoring-lolo', [StevedoringController::class, 'lolo'])->name('stevedoring.lolo');
        Route::get('/stevedoring-lolo/{stevedoring:id}', [StevedoringController::class, 'lolodetail'])->name('stevedoring.lolo.detail');
        Route::patch('/stevedoring-lolo/{stevedoring:id}/start', [StevedoringController::class, 'start'])->name('stevedoring.start');
        Route::patch('/stevedoring-lolo/{stevedoring:id}/stop', [StevedoringController::class, 'stop'])->name('stevedoring.stop');
        Route::patch('/stevedoring-lolo/{stevedoring:id}/continue', [StevedoringController::class, 'continue'])->name('stevedoring.continue');
        Route::patch('/stevedoring-lolo/{stevedoring:id}/finish', [StevedoringController::class, 'finish'])->name('stevedoring.finish');
        Route::patch('/stevedoring-lolo/{stevedoring:id}/updatelolo', [StevedoringController::class, 'updatelolo'])->name('stevedoring.updatelolo');
    });

    Route::group(['middleware' => ['role:spv_ops']], function () {
        Route::get('/stevedoring-app-spv', [StevedoringController::class, 'app_spv'])->name('stevedoring.app.spv');
        Route::get('/stevedoring-app-spv/{stevedoring:id}', [StevedoringController::class, 'app_spv_detail'])->name('stevedoring.app.spv.detail');
        Route::patch('/stevedoring-app-spv/{stevedoring:id}', [StevedoringController::class, 'app_spv_app'])->name('stevedoring.app.spv.app');
    });

    Route::get('/permohonan-dana-cetak', [PermohonanDanaController::class, 'cetak'])->name('dana.cetak');


    Route::get('/form-permohonan-dana/{permohonandana:id}', [PermohonanDanaController::class, 'show'])->name('form.dana');
    Route::post('/form-permohonan-dana', [PermohonanDanaSubOneController::class, 'store'])->name('subdanaone.store');

    Route::get('/form-old', function () {
        return view('form-old');
    });
});


require __DIR__ . '/auth.php';
