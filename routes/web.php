<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\NavController;
use App\Http\Controllers\PostController;

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


Route::get('/', function () {
	return Inertia::render('Home', [
		'canLogin' => Route::has('login'),
		'canRegister' => Route::has('register'),
	]);
})->name('home');

Route::middleware([
	'auth:sanctum',
	config('jetstream.auth_session'),
	'verified',
])->group(function () {
	Route::get('/admin/dashboard', function () {
		return Inertia::render('Dashboard');
	})->name('dashboard');

	Route::get('/admin/posts', [PostController::class, 'adminIndex'])->name('posts.index');
	Route::post('admin/posts/update', [PostController::class, 'update'])->name('posts.update');
	Route::post('admin/posts/delete', [PostController::class, 'delete'])->name('posts.delete');
});

Route::get('/articles', [PostController::class, 'archive'])->name('posts.archive');
Route::get('/articles/search', [PostController::class, 'search'])->name('posts.search');
Route::get('/articles/{id:slug}/', [PostController::class, 'single'])->name('posts.single');
