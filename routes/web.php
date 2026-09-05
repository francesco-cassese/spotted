<?php

use App\Http\Controllers\Admin\BusinessController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DistinctiveTraitController;
use App\Http\Controllers\ProfileController;
use App\Models\Business;
use App\Models\Category;
use App\Models\DistinctiveTrait;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $businessesCount = Business::count();
    $categoriesCount = Category::count();
    $distinctiveTraitsCount = DistinctiveTrait::count();

    return view('dashboard', compact('businessesCount', 'categoriesCount', 'distinctiveTraitsCount'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('categories', CategoryController::class);
    Route::resource('businesses', BusinessController::class);
    Route::resource('distinctive-traits', DistinctiveTraitController::class);
});

require __DIR__ . '/auth.php';
