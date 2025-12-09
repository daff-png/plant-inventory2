<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\PlantCategoryController;
use App\Http\Controllers\PlantProgressController;
use App\Http\Controllers\PlantTipController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TrashController;
use App\Http\Controllers\ExportController;

Route::get('/', [HomeController::class, 'index'])->middleware('auth');

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    
    // AKSES STAFF & ADMIN 
    Route::middleware(['role:admin,staff'])->group(function () {
        
        // Plants
        Route::get('/plants/create', [PlantController::class, 'create'])->name('plants.create');
        Route::post('/plants', [PlantController::class, 'store'])->name('plants.store');
        Route::get('/plants/{plant}/edit', [PlantController::class, 'edit'])->name('plants.edit');
        Route::put('/plants/{plant}', [PlantController::class, 'update'])->name('plants.update');

        // Progresses
        Route::get('/plant-progresses/create', [PlantProgressController::class, 'create'])->name('plant-progresses.create');
        Route::post('/plant-progresses', [PlantProgressController::class, 'store'])->name('plant-progresses.store');
        Route::get('/plant-progresses/{plantProgress}/edit', [PlantProgressController::class, 'edit'])->name('plant-progresses.edit');
        Route::put('/plant-progresses/{plantProgress}', [PlantProgressController::class, 'update'])->name('plant-progresses.update');

        // Categories & Tips (Resource)
        Route::resource('plant-categories', PlantCategoryController::class)->except(['index', 'show', 'destroy']);
        Route::resource('plant-tips', PlantTipController::class)->except(['index', 'show', 'destroy']);
        
        // Export
        Route::get('/export/plants', [ExportController::class, 'exportPlants'])->name('export.plants');
    });

    //AKSES SEMUA USER (admin, staff, user) 
    
    // Plants
    Route::get('/plants', [PlantController::class, 'index'])->name('plants.index');
    Route::get('/plants/{plant}', [PlantController::class, 'show'])->name('plants.show');
    Route::delete('/plants/{plant}', [PlantController::class, 'destroy'])->name('plants.destroy');
    Route::get('/plants/{plant}/qr', [PlantController::class, 'generateQR'])->name('plants.qr');

    // Progresses
    Route::get('/plant-progresses', [PlantProgressController::class, 'index'])->name('plant-progresses.index');
    Route::get('/plant-progresses/{plantProgress}', [PlantProgressController::class, 'show'])->name('plant-progresses.show');
    Route::delete('/plant-progresses/{plantProgress}', [PlantProgressController::class, 'destroy'])->name('plant-progresses.destroy');

    // Categories 
    Route::get('/plant-categories', [PlantCategoryController::class, 'index'])->name('plant-categories.index');
    Route::get('/plant-categories/{plantCategory}', [PlantCategoryController::class, 'show'])->name('plant-categories.show');

    // Tips 
    Route::get('/plant-tips', [PlantTipController::class, 'index'])->name('plant-tips.index');
    Route::get('/plant-tips/{plantTip}', [PlantTipController::class, 'show'])->name('plant-tips.show');


    // AKSES ADMIN SAJA 
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class);

        // Delete (Admin-Only)
        Route::delete('/plant-categories/{plantCategory}', [PlantCategoryController::class, 'destroy'])->name('plant-categories.destroy');
        Route::delete('/plant-tips/{plantTip}', [PlantTipController::class, 'destroy'])->name('plant-tips.destroy');
        
        // Trash
        Route::get('/trash/plants', [TrashController::class, 'plantsTrash'])->name('plants.trash');
        Route::get('/trash/plants/restore/{id}', [TrashController::class, 'plantsRestore'])->name('plants.restore');
        Route::delete('/trash/plants/delete/{id}', [TrashController::class, 'plantsForceDelete'])->name('plants.forceDelete');
        
        Route::get('/trash/users', [TrashController::class, 'usersTrash'])->name('users.trash');
        Route::get('/trash/users/restore/{id}', [TrashController::class, 'usersRestore'])->name('users.restore');
        Route::delete('/trash/users/delete/{id}', [TrashController::class, 'usersForceDelete'])->name('users.forceDelete');
    });
});