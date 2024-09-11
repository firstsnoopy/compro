<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CountController;
use App\Http\Controllers\ProfController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ExperienceController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('latihan', [CountController::class, 'index']);
Route::get('penjumlahan', [CountController::class, 'jumlah'])->name('penjumlahan');
Route::get('pengurangan', [CountController::class, 'kurang'])->name('pengurangan');
Route::get('pembagian', [CountController::class, 'bagi'])->name('pembagian');
Route::get('perkalian', [CountController::class, 'kali'])->name('perkalian');


Route::post('storejumlah', [CountController::class, 'storejumlah'])->name('store_penjumlahan');
Route::post('storekurang', [CountController::class, 'storekurang'])->name('store_pengurangan');
Route::post('storebagi', [CountController::class, 'storebagi'])->name('store_pembagian');
Route::post('storekali', [CountController::class, 'storekali'])->name('store_perkalian');


Route::get('/dashboard', function () {
    if (Auth::user()->id_level === 1) {
        return view('admin.dashboard');
    } elseif (Auth::user()->id_level === 2) {
        return view('user.dashboard');
    }
    // return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'admin']);
// Profile
Route::get('admin/profiles', [ProfController::class, 'index'])->middleware(['auth', 'admin'])->name('profiles.index');
Route::get('admin/profiles/create', [ProfController::class, 'create'])->name('profiles.create')->middleware(['auth', 'admin']);
Route::POST('admin/profiles/store', [ProfController::class, 'store'])->name('profiles.store')->middleware(['auth', 'admin']);
Route::get('admin/profiles/edit/{id}', [ProfController::class, 'edit'])->name('profiles.edit')->middleware(['auth', 'admin']);
Route::get('user/dashboard', [HomeController::class, 'index_user'])->middleware(['auth', 'user']);
// update and softdelete
Route::put('admin/profiles/update/{id}', [ProfController::class, 'update'])->name('profiles.update')->middleware(['auth', 'admin']);
Route::delete('admin/profiles/softdelete/{id}', [ProfController::class, 'softdelete'])->name('profiles.softdelete')->middleware(['auth', 'admin']);
Route::post('admin/profiles/update-status/{id}', [ProfController::class, 'updateStatus'])->name('profiles.update-status');
Route::get('admin/profiles/recycle', [ProfController::class, 'recycle'])->name('profiles.recycle');
Route::get('admin/restore/{id}', [ProfController::class, 'restore'])->name('profiles.restore');
Route::delete('admin/destroy/{id}', [ProfController::class, 'destroy'])->name('profiles.destroy');
Route::get('profiles/generate-pdf{id}', [ProfController::class, 'show'])->name('generate-pdf');


// Experience
Route::resource('experience', ExperienceController::class);
// Route::get('admin/experience/create', [ProfController::class, 'create'])->name('experience.create')->middleware(['auth', 'admin']);
Route::POST('admin/experience/store', [ExperienceController::class, 'store'])->name('experience.store')->middleware(['auth', 'admin']);
Route::delete('admin/experiences/softdelete/{id}', [ExperienceController::class, 'softdelete'])->name('experience.softdelete')->middleware(['auth', 'admin']);
Route::get('admin/experiences/create/', [ExperienceController::class, 'create'])->name('experience.create')->middleware(['auth', 'admin']);
Route::get('admin/experiences/restore/{id}', [ExperienceController::class, 'restore'])->name('experience.restore')->middleware(['auth', 'admin']);
Route::get('admin/experiences/recycle/', [ExperienceController::class, 'recycle'])->name('experience.recycle')->middleware(['auth', 'admin']);

Route::get('compro', [ContentController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
