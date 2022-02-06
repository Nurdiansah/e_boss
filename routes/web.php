<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CheckerController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EquipmentCategoryController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ItemMasterController;
use App\Http\Controllers\JettyController;
use App\Http\Controllers\PortController;
use App\Http\Controllers\StevedoringController;
use App\Http\Controllers\StevedoringManifestController;
use App\Http\Controllers\StevedoringUseEquipmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VesselController;
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

    Route::get('user-profile', [UserController::class, 'showProfile'])->name('user.profile');

    Route::group(['middleware' => ['role:supervessel|admin_ops']], function () {

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

        // Areas
        Route::prefix('areas')->group(function () {
            // Matches The "/area/show" URL
            Route::get('/', [AreaController::class, 'index'])->name('areas');
            Route::get('/{area:id}', [AreaController::class, 'show'])->name('area.show');
            Route::post('/', [AreaController::class, 'store'])->name('area.store');
            Route::get('edit/{area:id}', [AreaController::class, 'edit'])->name('area.edit');
            Route::put('/{area:id}', [AreaController::class, 'update'])->name('area.update');
            Route::delete('/{area:id}', [AreaController::class, 'destroy'])->name('area.delete');
        });

        // Checker
        Route::prefix('checkers')->group(function () {
            // Matches The "/checker/show" URL
            Route::get('/', [CheckerController::class, 'index'])->name('checkers');
            Route::get('/{checker:id}', [CheckerController::class, 'show'])->name('checker.show');
            Route::post('/', [CheckerController::class, 'store'])->name('checker.store');
            Route::get('edit/{checker:id}', [CheckerController::class, 'edit'])->name('checker.edit');
            Route::put('/{checker:id}', [CheckerController::class, 'update'])->name('checker.update');
            Route::delete('/{checker:id}', [CheckerController::class, 'destroy'])->name('checker.delete');
        });

        // Client
        Route::prefix('clients')->group(function () {
            // Matches The "/client/show" URL
            Route::get('/', [ClientController::class, 'index'])->name('clients');
            Route::get('/{client:id}', [ClientController::class, 'show'])->name('client.show');
            Route::post('/', [ClientController::class, 'store'])->name('client.store');
            Route::get('edit/{client:id}', [ClientController::class, 'edit'])->name('client.edit');
            Route::put('/{client:id}', [ClientController::class, 'update'])->name('client.update');
            Route::delete('/{client:id}', [ClientController::class, 'destroy'])->name('client.delete');
        });

        // Equipment
        Route::prefix('equipments')->group(function () {
            // Matches The "/equipment/show" URL
            Route::get('/', [EquipmentController::class, 'index'])->name('equipments');
            Route::get('/{equipment:id}', [EquipmentController::class, 'show'])->name('equipment.show');
            Route::post('/', [EquipmentController::class, 'store'])->name('equipment.store');
            Route::get('edit/{equipment:id}', [EquipmentController::class, 'edit'])->name('equipment.edit');
            Route::put('/{equipment:id}', [EquipmentController::class, 'update'])->name('equipment.update');
            Route::delete('/{equipment:id}', [EquipmentController::class, 'destroy'])->name('equipment.delete');
        });

        // Equipment Categorie
        Route::prefix('equipment-categories')->group(function () {
            // Matches The "/equipment/show" URL
            Route::get('/', [EquipmentCategoryController::class, 'index'])->name('equipmentcategories');
            Route::get('/{equipmentcategory:id}', [EquipmentCategoryController::class, 'show'])->name('equipmentcategory.show');
            Route::post('/', [EquipmentCategoryController::class, 'store'])->name('equipmentcategory.store');
            Route::get('edit/{equipmentcategory:id}', [EquipmentCategoryController::class, 'edit'])->name('equipmentcategory.edit');
            Route::put('/{equipmentcategory:id}', [EquipmentCategoryController::class, 'update'])->name('equipmentcategory.update');
            Route::delete('/{equipmentcategory:id}', [EquipmentCategoryController::class, 'destroy'])->name('equipmentcategory.delete');
        });

        // Item Master
        Route::prefix('item-masters')->group(function () {
            // Matches The "/equipment/show" URL
            Route::get('/', [ItemMasterController::class, 'index'])->name('itemmasters');
            Route::get('/{itemmaster:id}', [ItemMasterController::class, 'show'])->name('itemmaster.show');
            Route::post('/', [ItemMasterController::class, 'store'])->name('itemmaster.store');
            Route::get('edit/{itemmaster:id}', [ItemMasterController::class, 'edit'])->name('itemmaster.edit');
            Route::put('/{itemmaster:id}', [ItemMasterController::class, 'update'])->name('itemmaster.update');
            Route::delete('/{itemmaster:id}', [ItemMasterController::class, 'destroy'])->name('itemmaster.delete');
        });

        // Jetty
        Route::prefix('jetties')->group(function () {
            // Matches The "/equipment/show" URL
            Route::get('/', [JettyController::class, 'index'])->name('jetties');
            Route::get('/{jetty:id}', [JettyController::class, 'show'])->name('jetty.show');
            Route::post('/', [JettyController::class, 'store'])->name('jetty.store');
            Route::get('edit/{jetty:id}', [JettyController::class, 'edit'])->name('jetty.edit');
            Route::put('/{jetty:id}', [JettyController::class, 'update'])->name('jetty.update');
            Route::delete('/{jetty:id}', [JettyController::class, 'destroy'])->name('jetty.delete');
        });

        // Port
        Route::prefix('ports')->group(function () {
            // Matches The "/equipment/show" URL
            Route::get('/', [PortController::class, 'index'])->name('ports');
            Route::get('/{port:id}', [PortController::class, 'show'])->name('port.show');
            Route::post('/', [PortController::class, 'store'])->name('port.store');
            Route::get('edit/{port:id}', [PortController::class, 'edit'])->name('port.edit');
            Route::put('/{port:id}', [PortController::class, 'update'])->name('port.update');
            Route::delete('/{port:id}', [PortController::class, 'destroy'])->name('port.delete');
        });

        // User
        Route::prefix('users')->group(function () {
            // Matches The "/equipment/show" URL
            Route::get('/', [UserController::class, 'index'])->name('users');
            Route::get('/{user:id}', [UserController::class, 'show'])->name('user.show');
            Route::post('/', [UserController::class, 'store'])->name('user.store');
            Route::get('edit/{user:id}', [UserController::class, 'edit'])->name('user.edit');
            Route::put('/{user:id}', [UserController::class, 'update'])->name('user.update');
            Route::delete('/{user:id}', [UserController::class, 'destroy'])->name('user.delete');
        });



        // Vessel
        Route::prefix('vessels')->group(function () {
            // Matches The "/equipment/show" URL
            Route::get('/', [VesselController::class, 'index'])->name('vessels');
            Route::get('/{vessel:id}', [VesselController::class, 'show'])->name('vessel.show');
            Route::post('/', [VesselController::class, 'store'])->name('vessel.store');
            Route::get('edit/{vessel:id}', [VesselController::class, 'edit'])->name('vessel.edit');
            Route::put('/{vessel:id}', [VesselController::class, 'update'])->name('vessel.update');
            Route::delete('/{vessel:id}', [VesselController::class, 'destroy'])->name('vessel.delete');
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


    // Not Checker semua vessel
    Route::group(['middleware' => ['role:supervessel|admin_ops|spv_ops|manager_ops|client']], function () {

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
