<?php

use App\Http\Controllers\Admin\BudgetController as AdminBudgetController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\OfficialController as AdminOfficialController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\PotentialController as AdminPotentialController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PotentialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransparencyController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [ProfileController::class, 'index'])->name('profile');
Route::get('/potensi', [PotentialController::class, 'index'])->name('potentials.index');
Route::get('/potensi/{slug}', [PotentialController::class, 'show'])->name('potentials.show');
Route::get('/informasi', [PostController::class, 'index'])->name('posts.index');
Route::get('/informasi/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/transparansi', [TransparencyController::class, 'index'])->name('transparency.index');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/profil', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profil', [AdminProfileController::class, 'update'])->name('profile.update');

    Route::resource('perangkat', AdminOfficialController::class)
        ->names('officials')
        ->parameters(['perangkat' => 'official'])
        ->except(['show']);

    Route::resource('potensi', AdminPotentialController::class)
        ->names('potentials')
        ->parameters(['potensi' => 'potential'])
        ->except(['show']);

    Route::resource('informasi', AdminPostController::class)
        ->names('posts')
        ->parameters(['informasi' => 'post'])
        ->except(['show']);

    Route::resource('galeri', AdminGalleryController::class)
        ->names('galleries')
        ->parameters(['galeri' => 'gallery'])
        ->except(['show']);

    // Transparansi Keuangan (APBDes)
    Route::get('/keuangan', [AdminBudgetController::class, 'index'])->name('budgets.index');
    Route::post('/keuangan/tahun', [AdminBudgetController::class, 'storeYear'])->name('budgets.years.store');
    Route::get('/keuangan/{budgetYear}', [AdminBudgetController::class, 'showYear'])->name('budgets.show');
    Route::put('/keuangan/{budgetYear}', [AdminBudgetController::class, 'updateYear'])->name('budgets.years.update');
    Route::delete('/keuangan/{budgetYear}', [AdminBudgetController::class, 'destroyYear'])->name('budgets.years.destroy');

    Route::post('/keuangan/{budgetYear}/item', [AdminBudgetController::class, 'storeItem'])->name('budgets.items.store');
    Route::put('/keuangan/item/{budgetItem}', [AdminBudgetController::class, 'updateItem'])->name('budgets.items.update');
    Route::delete('/keuangan/item/{budgetItem}', [AdminBudgetController::class, 'destroyItem'])->name('budgets.items.destroy');
});
