<?php

use App\Http\Controllers\Fontend\CategoryController;
use App\Http\Controllers\Fontend\PostController;

use App\Http\Controllers\Member\DashboardController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Fontend\BlogController;
use Illuminate\Support\Facades\Route;

Route::get('lang/{language}', function ($locale) {
    if (!in_array($locale, ['en', 'vi'])) {
        abort(404);
    }
    session()->put('locale', $locale);
    return redirect()->back();
});

/* API ROUTE */
require __DIR__.'/api.php';

/* FONTEND */
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [PostController::class, 'show'])->name('blog.show');
Route::get('/blog/categories/{slug}', [CategoryController::class, 'show'])->name('blog.categories');

/* ADMIN ROUTE */
require __DIR__.'/admin.php';

/* MEMBER ROUTE */
require __DIR__.'/member.php';

/* stu route */
require __DIR__.'/stu.php';

/* note route */
require __DIR__.'/note.php';

/* auth route */
require __DIR__.'/auth.php';

Route::post('ckeditor/upload', [DashboardController::class, 'upload'])->name('ckeditor.upload');