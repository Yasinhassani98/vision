<?php

use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('layout/main');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'role:admin'])->prefix('admin')->as('admin.')->group(function () {

    // Students routes
    Route::resource('/students', StudentController::class);
    
    // Users routes
    Route::resource('/users', UserController::class);

    // Levels routes (except show)
    Route::resource('/levels', LevelController::class)->except('show');

    // Comments routes (except show)
    Route::resource('/comments', CommentController::class)->except('show');
    Route::post('/profileComment/{post}',[ CommentController::class,'profileComment'])->name('comments.profileComment');

    // Payments routes
    Route::resource('/payments', PaymentController::class);

    // Schedules routes
    Route::resource('/schedules', ScheduleController::class);

    // Grades routes
    Route::resource('/grades', GradeController::class)->except('show');

});



require __DIR__ . '/auth.php';
