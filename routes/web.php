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
    return view('/api/items');
});

Route::get('/home', function () {
    return redirect('/api/items');
});

Route::get('/home', function () {
    return redirect('/api/items');
});

Auth::routes();

Route::get('/login', function () {
    dd('test');
    return redirect('/api/items');
});


Route::get('/items/add', [ItemApiController::class, 'create'])->name('items.add');
Route::post('/items/add',  [ItemApiController::class, 'create'])->name('items.add');
Route::post('/items/store', [ItemApiController::class, 'store'])->name('items.store');
Route::get('/items/edit/{id}',  [ItemApiController::class, 'edit'])->name('items.edit');
Route::post('/items/edit/{id}',  [ItemApiController::class, 'edit'])->name('items.edit');
Route::post('/items/update/{id}', [ItemApiController::class, 'update'])->name('items.update');
Route::get('/items/destroy/{id}', [ItemApiController::class, 'destroy'])->name('items.destroy');
Route::post('/items/destroy/{id}', [ItemApiController::class, 'destroy'])->name('items.destroy');
Route::get('/items/status/{id}/{status}', [ItemApiController::class, 'status'])->name('items.status');
Route::post('/items/status/{id}/{status}', [ItemApiController::class, 'status'])->name('items.status');


Route::get('/categories/add', [CategoryApiController::class, 'create'])->name('categories.add');
Route::post('/categories/add',  [CategoryApiController::class, 'create'])->name('categories.add');
Route::post('/categories/store', [CategoryApiController::class, 'store'])->name('categories.store');
Route::get('/categories/edit/{id}',  [CategoryApiController::class, 'edit'])->name('categories.edit');
Route::post('/categories/edit/{id}',  [CategoryApiController::class, 'edit'])->name('categories.edit');
Route::post('/categories/update/{id}', [CategoryApiController::class, 'update'])->name('categories.update');
Route::get('/categories/destroy/{id}', [CategoryApiController::class, 'destroy'])->name('categories.destroy');
Route::post('/categories/destroy/{id}', [CategoryApiController::class, 'destroy'])->name('categories.destroy');
Route::get('/categories/status/{id}/{status}', [CategoryApiController::class, 'status'])->name('categories.status');
Route::post('/categories/status/{id}/{status}', [CategoryApiController::class, 'status'])->name('categories.status');
