<?php

use App\Models\Tutorial;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Homecontroller;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\TutorialController;
use App\Http\Controllers\RequestMateriController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\DownloadController;

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
Route::middleware(['visitor'])->group(function () {
    Route::get('/', [Homecontroller::class, 'index'])->name('home');
    Route::resource('/materi', MateriController::class)->names(['materi' => 'materi.index']);

    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/user', [DashboardController::class, 'user'])->name('user');

        Route::post('/manageMateri', [MateriController::class, 'store']);
        Route::get('/manageMateri', [MateriController::class, 'create'])->name('materi.create');

        Route::get('/manageMateri/{id}/edit', [MateriController::class, 'edit'])->name('manageMateri.edit');
        Route::put('/manageMateri/{id}', [MateriController::class, 'update'])->name('manageMateri.update');

        Route::get('/requests', [RequestMateriController::class, 'index'])->name('requests');
        Route::delete('/requests/{id}', [RequestMateriController::class, 'destroy'])->name('requests.destroy');

        Route::post('/manageTutorial', [TutorialController::class, 'store']);
        Route::get('/manageTutorial', [TutorialController::class, 'create'])->name('tutorial.create');
        Route::post('/request-materi', [RequestMateriController::class, 'store'])->name('request.materi.store');
        // Route::get('/materi/{$id}', [MateriController::class, 'show'])->name('materi.show');
        Route::get('/tutorial/{$id}', [TutorialController::class, 'show'])->name('materi.show');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
    Route::middleware(['auth'])->group(function () {
        Route::post('/request-materi', [RequestMateriController::class, 'store'])->name('request.materi.store');
        Route::get('/materi/{$id}', [MateriController::class, 'show'])->name('materi.show');
        Route::get('/tutorial/{$id}', [TutorialController::class, 'show'])->name('materi.show');
    });
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('/tutorial', TutorialController::class);
    Route::resource('/download', DownloadController::class)->names('download.index');
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');
        Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    });


    Route::get('/about-us', function () {
        return view('footer.about');
    });
    Route::get('/contact', function () {
        return view('footer.contact');
    });
    Route::get('/privacy-policy', function () {
        return view('footer.privacy');
    });

});
