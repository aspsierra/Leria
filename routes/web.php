<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
Route::redirect('/', 'login');

Route::middleware('auth')->group(function(){
    Route::get('/dashboard', [SiteController::class , 'index']);
    Route::post('/publishPost', [SiteController::class, 'storePost']);
    
    Route::get('/checkShared', [SiteController::class , 'checkShared']);
    Route::get('/checkLiked', [SiteController::class , 'checkLiked']);
    
    
    Route::get('/user/{userName}', [UserProfileController::class, 'viewProfile']);
    
    Route::middleware('controlAccess')->group(function(){
        Route::get('/getAllPosts/{id}', [PostsController::class , 'getAllPosts']);
        Route::get('/user/{userName}/posts', [PostsController::class, 'getOwnPosts']);
        Route::get('/user/{userName}/shares', [PostsController::class, 'getSharedPosts']);
        Route::get('/user/{userName}/likes', [PostsController::class, 'getLikedPosts']);
    });

    Route::post('/getAllPosts/{id}', [PostsController::class , 'getAllPosts']);
    Route::post('/user/{userName}/posts', [PostsController::class, 'getOwnPosts']);
    Route::post('/user/{userName}/shares', [PostsController::class, 'getSharedPosts']);
    Route::post('/user/{userName}/likes', [PostsController::class, 'getLikedPosts']);
    Route::post('/user/getData/{userName}', [UserProfileController::class, 'getUserData']);

    Route::get('/user/{userName}/following', [[UserProfileController::class, 'getFollowing']]);
});

/*
Route::get('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'login']);


Route::post('/register', [AuthController::class, 'handleRegister']);*/
// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
