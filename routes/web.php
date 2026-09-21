<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BlogController;

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');  
Route::get('/', [BlogController::class, 'index'])->name('home');
Route::get('detail/{id}',[BlogController::class,'detail']);

Route::get('/basbe', function () {
    return view('Basbe');
})->name('basbe');

Route::get('/aboutme', function () {
    $name = 'jiraphol';
    $nickname = 'Hom';
    $age = 21;
    $birthday = '14/11/2004';
    return view('aboutme', compact('name', 'nickname', 'age', 'birthday'));
})->name('aboutme');

Route::get('/serve', function () {
    $serve = [
        ['id' => 1, 'name' => 'Web Design', 'price' => 10000, 'status' => 'available'],
        ['id' => 2, 'name' => 'App Design', 'price' => 20000, 'status' => 'available'],
        ['id' => 3, 'name' => 'Graphic Design', 'price' => 30000, 'status' => 'not available'],
    ];
    return view('serve', compact('serve'));
})->name('serve');

// Admin Routes
Route::get('/admin/dashboard', [AdminController::class, 'blog2'])->name('admin.dashboard');
Route::get('/admin/about', [AdminController::class, 'about2'])->name('admin.about');
Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
Route::post('/admin/insert', [AdminController::class, 'insert'])->name('admin.insert');
Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
Route::post('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');
Route::get('/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');

// Book Routes (Assignment 5)
use App\Http\Controllers\BookController;
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
Route::post('/books/insert', [BookController::class, 'insert'])->name('books.insert');

Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return "เชื่อมต่อฐานข้อมูลสำเร็จ! Database name: " . DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        return "ไม่สามารถเชื่อมต่อฐานข้อมูลได้: " . $e->getMessage();
    }
});