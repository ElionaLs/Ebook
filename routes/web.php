<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;

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

// Route::get('/', function () {
//     return view('dashboard.index');
// });

// Route::get('/login', function () {
//     return view('dashboard.login');
// });

Route::middleware('isGuest')->group(function () {
    Route::get('/login', [BukuController::class, 'login'])->name('login');
    Route::post('/login', [BukuController::class, 'auth'])->name('login.auth');
    Route::get('/register', [BukuController::class, 'register'])->name('register');
    Route::post('/register', [BukuController::class, 'inputRegister'])->name('register.post');
});

Route::get('/', [BukuController::class, 'index'])->name('index');
Route::get('/logout', [BukuController::class, 'logout'])->name('logout');

Route::middleware('isLogin', 'cekRole:user')->group(function () {
});
Route::get('/library', [BukuController::class, 'library'])->name('library');
Route::get('/library/category/{category}', [BukuController::class, 'getBooksByCategory'])->name('books.category');

Route::middleware('isLogin', 'cekRole:admin')->group(function () {
    Route::get('/admin', [BukuController::class, 'admin'])->name('admin.index');

    //crud user
    Route::get('/user', [BukuController::class, 'user'])->name('user');
    Route::get('/edituser{id}', [BukuController::class, 'edituser'])->name('edituser');
    Route::patch('/updateuser/{id}', [BukuController::class, 'updateuser'])->name('updateuser');
    Route::delete('/deleteuser/{id}', [BukuController::class, 'destroyuser'])->name('deleteuser');
    Route::get('/export-excel', [BukuController::class, 'userExportExcel'])->name('userExportExcel');
    Route::get('/users/printable', [BukuController::class, 'userPrintable'])->name('userPrintable');

    //crud buku ke library
    Route::get('/book', [BukuController::class, 'book'])->name('book');
    Route::get('/createBook', [BukuController::class, 'createBook'])->name('createBook');
    Route::post('/book/store', [BukuController::class, 'bookstore'])->name('bookstore');
    Route::get('/editBook{id}', [BukuController::class, 'editBook'])->name('editBook');
    Route::patch('/updateBook/{id}', [BukuController::class, 'updateBook'])->name('updateBook');
    Route::delete('/deleteBook/{id}', [BukuController::class, 'bookDestroy'])->name('deleteBook');
    Route::get('/exportbook-excel', [BukuController::class, 'bookExportExcel'])->name('bookExportExcel');

    //crud category
    Route::get('/category', [BukuController::class, 'category'])->name('category');
    Route::post('/store', [BukuController::class, 'store'])->name('store');
    Route::get('/editCategory{id}', [BukuController::class, 'editCategory'])->name('editCategory');
    Route::patch('/updateCategory/{id}', [BukuController::class, 'updateCategory'])->name('updateCategory');
    Route::delete('/deleteCategory/{id}', [BukuController::class, 'categoryDestroy'])->name('deleteCategory');
});

Route::get('/404', function () {
    return view('404');
});

