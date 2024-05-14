<?php

use App\Http\Controllers\Admin\AddQuotationController;
use App\Http\Controllers\Admin\DrugController as AdminDrugController;
use App\Http\Controllers\Admin\PrescriptionController as AdminPrescriptionController;
use App\Http\Controllers\Admin\QuotationController as AdminQuotationController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuotationController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('/prescription', PrescriptionController::class)->middleware(['auth', 'verified']);
Route::resource('/quotation', QuotationController::class)->middleware(['auth', 'verified']);


Route::middleware(['auth', 'role:admin'])->name('admin/')->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::resource('users', AdminUserController::class);
    Route::resource('drugs', AdminDrugController::class);
    Route::resource('prescriptions', AdminPrescriptionController::class);
    Route::resource('quotations', AdminQuotationController::class);
    Route::resource('quotation-details', AddQuotationController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
