<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\PermohonanDanaController;
use App\Http\Controllers\PermohonanDanaSubOneController;
use App\Http\Controllers\StevedoringController;
use App\Http\Controllers\StevedoringManifestController;
use App\Http\Controllers\StevedoringUseEquipmentController;
use App\Models\StevedoringUseEquipment;
use Barryvdh\DomPDF\PDF;
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
        return redirect('stevedoring/all/' . getTahun());
    })->name('home');

    Route::get('/storage/{id}')->name('link');

    Route::group(['middleware' => ['role:superuser|admin_ops']], function () {

        // Master Data

        // Agent
        Route::prefix('agents')->group(function () {
            // Matches The "/agent/show" URL
            Route::get('/', [AgentController::class, 'index'])->name('agents');
            Route::get('/{agent:id}', [AgentController::class, 'show'])->name('agent.show');
            Route::post('/', [AgentController::class, 'store'])->name('agent.store');
            Route::get('edit/{agent:id}', [AgentController::class, 'edit'])->name('agent.edit');
            Route::put('/{agent:id}', [AgentController::class, 'update'])->name('agent.update');
            Route::delete('/{agent:id}', [AgentController::class, 'destroy'])->name('agent.delete');
        });

        Route::prefix('areas')->group(function () {
            // Matches The "/area/show" URL
            Route::get('/', [AreaController::class, 'index'])->name('areas');
            Route::get('/{area:id}', [AreaController::class, 'show'])->name('area.show');
            Route::post('/', [AreaController::class, 'store'])->name('area.store');
            Route::get('edit/{area:id}', [AreaController::class, 'edit'])->name('area.edit');
            Route::put('/{area:id}', [AreaController::class, 'update'])->name('area.update');
            Route::delete('/{area:id}', [AreaController::class, 'destroy'])->name('area.delete');
        });

        // Stevedoring
        Route::get('/stevedoring/create', [StevedoringController::class, 'create'])->name('stevedoring.create');

        Route::post('/stevedoring', [StevedoringController::class, 'store'])->name('stevedoring.store');
        Route::get('/stevedoring/{stevedoring:id}/edit', [StevedoringController::class, 'edit'])->name('stevedoring.edit');
        Route::put('/stevedoring/{stevedoring:id}', [StevedoringController::class, 'update'])->name('stevedoring.update');
        Route::get('/stevedoring/draft', [StevedoringController::class, 'draft'])->name('stevedoring.draft');
        Route::post('/stevedoring/release', [StevedoringController::class, 'release'])->name('stevedoring.release');
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

    Route::group(['middleware' => ['role:manager_ops']], function () {
        Route::get('/stevedoring-app-mgr', [StevedoringController::class, 'app_mgr'])->name('stevedoring.app.mgr');
        Route::get('/stevedoring-app-mgr/{stevedoring:id}', [StevedoringController::class, 'app_mgr_detail'])->name('stevedoring.app.mgr.detail');
        Route::patch('/stevedoring-app-mgr/{stevedoring:id}', [StevedoringController::class, 'app_mgr_app'])->name('stevedoring.app.mgr.app');
    });


    // Not Checker
    Route::group(['middleware' => ['role:superuser|admin_ops|spv_ops|manager_ops|client']], function () {

        Route::get('/stevedoring-proses', [StevedoringController::class, 'proses'])->name('stevedoring.proses');
        Route::get('/stevedoring/{stevedoring:id}', [StevedoringController::class, 'show'])->name('stevedoring.show');
    });

    // All
    Route::get('/stevedoring-history', [StevedoringController::class, 'history'])->name('stevedoring.history');
    Route::get('/stevedoring-history/{stevedoring:id}', [StevedoringController::class, 'history_detail'])->name('stevedoring.history.detail');

    Route::get('/stevedoring-cetak-tallysheet/{id}', [StevedoringController::class, 'cetak_tallysheet'])->name('stevedoring.cetak.tallysheet');

    // baru
    // OKE TINGGAL JS NYA AJA
    Route::get('stevedoring/all/{year}', [StevedoringController::class, 'index'])->name('stevedoring');
    Route::get('stevedoring/annual', [StevedoringController::class, 'stevedoringAnnual'])->name('stevedoring.annual');

    Route::post('stevedoring/client', [StevedoringController::class, 'stevedoringClient'])->name('stevedoring.client');
    Route::post('stevedoring/anual/year', [StevedoringController::class, 'stevedoringAnnualYear'])->name('stevedoring.annual.year');

    Route::get('/form-old', function () {
        return view('form-old');
    });
});


require __DIR__ . '/auth.php';
