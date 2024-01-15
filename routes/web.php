<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemApiController;
use App\Http\Controllers\CategoryApiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


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
    return view('/web/items');
});


Route::get('/web/home', function () {
    return view('/api/items');
});

Route::get('web', function () {
    return view('/api/items');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/web/logout', function () {
    return view('/welcome');
});


Auth::Routes();

Route::get('/items', [ItemApiController::class, 'index'])->name('items.index')->middleware('auth');
Route::get('/items/add', [ItemApiController::class, 'create'])->name('items.add')->middleware('auth');
Route::post('/items/add',  [ItemApiController::class, 'create'])->name('items.add')->middleware('auth');
Route::post('/items/store', [ItemApiController::class, 'store'])->name('items.store')->middleware('auth');
Route::get('/items/edit/{id}',  [ItemApiController::class, 'edit'])->name('items.edit')->middleware('auth');
Route::post('/items/edit/{id}',  [ItemApiController::class, 'edit'])->name('items.edit')->middleware('auth');
Route::post('/items/update/{id}', [ItemApiController::class, 'update'])->name('items.update')->middleware('auth');
Route::get('/items/destroy/{id}', [ItemApiController::class, 'destroy'])->name('items.destroy')->middleware('auth');
Route::post('/items/destroy/{id}', [ItemApiController::class, 'destroy'])->name('items.destroy')->middleware('auth');
Route::get('/items/status/{id}/{status}', [ItemApiController::class, 'status'])->name('items.status')->middleware('auth');
Route::post('/items/status/{id}/{status}', [ItemApiController::class, 'status'])->name('items.status')->middleware('auth');

Route::get('/categories', [CategoryApiController::class, 'index'])->name('categories.index')->middleware('auth');
Route::get('/categories/add', [CategoryApiController::class, 'create'])->name('categories.add')->middleware('auth');
Route::post('/categories/add',  [CategoryApiController::class, 'create'])->name('categories.add')->middleware('auth');
Route::post('/categories/store', [CategoryApiController::class, 'store'])->name('categories.store')->middleware('auth');
Route::get('/categories/edit/{id}',  [CategoryApiController::class, 'edit'])->name('categories.edit')->middleware('auth');
Route::post('/categories/edit/{id}',  [CategoryApiController::class, 'edit'])->name('categories.edit')->middleware('auth');
Route::post('/categories/update/{id}', [CategoryApiController::class, 'update'])->name('categories.update')->middleware('auth');
Route::get('/categories/destroy/{id}', [CategoryApiController::class, 'destroy'])->name('categories.destroy')->middleware('auth');
Route::post('/categories/destroy/{id}', [CategoryApiController::class, 'destroy'])->name('categories.destroy')->middleware('auth');
Route::get('/categories/status/{id}/{status}', [CategoryApiController::class, 'status'])->name('categories.status')->middleware('auth');
Route::post('/categories/status/{id}/{status}', [CategoryApiController::class, 'status'])->name('categories.status')->middleware('auth');
