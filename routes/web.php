<?php

use App\Http\Controllers\PermohonanDanaController;
use App\Http\Controllers\PermohonanDanaSubOneController;
use App\Models\Permohonandana;
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


    Route::group(['middleware' => ['role:superuser|costcontrol']], function () {
        // Permohonan dana
        Route::get('/form-permohonan-dana', [PermohonanDanaController::class, 'create'])->name('dana.create');
        Route::post('/permohonan-dana', [PermohonanDanaController::class, 'store'])->name('dana.store');
        Route::get('/permohonan-dana', [PermohonanDanaController::class, 'index'])->name('dana.index');
        Route::get('/permohonan-dana/{permohonandana:id}', [PermohonanDanaController::class, 'edit'])->name('dana.edit');
        Route::post('/permohonan-dana/{permohonandana:id}', [PermohonanDanaController::class, 'update'])->name('dana.update');
        Route::post('/permohonan-dana-release/{permohonandana:id}', [PermohonanDanaController::class, 'release'])->name('dana.release');
    });

    Route::get('/permohonan-dana-cetak', [PermohonanDanaController::class, 'cetak'])->name('dana.cetak');


    Route::get('/form-permohonan-dana/{permohonandana:id}', [PermohonanDanaController::class, 'show'])->name('form.dana');
    Route::post('/form-permohonan-dana', [PermohonanDanaSubOneController::class, 'store'])->name('subdanaone.store');

    Route::get('/form-old', function () {
        return view('form-old');
    });
});


require __DIR__ . '/auth.php';
