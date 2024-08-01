<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GeneralController;

Route::prefix('admin')->middleware(['role:admin|super-admin'])->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.index');
    Route::get('/note', [App\Http\Controllers\Admin\NOTEController::class, 'index'])->name('admin.note.index');
    Route::get('/stu', [App\Http\Controllers\Admin\STUController::class, 'index'])->name('admin.stu.index');
    Route::get('/stu/{id}', [App\Http\Controllers\Admin\STUController::class, 'show'])->name('admin.stu.show');

    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard.index');
    Route::get('/access', [App\Http\Controllers\Admin\AccessController::class, 'index'])->name('admin.access.index');
    
    Route::get('/invoices', [App\Http\Controllers\Admin\InvoiceController::class, 'index'])->name('admin.invoices.index');
    Route::get('/invoices/{id}/pending', [App\Http\Controllers\Admin\InvoiceController::class, 'pending'])->name('admin.invoices.pending');
    Route::get('/invoices/{id}/watched', [App\Http\Controllers\Admin\InvoiceController::class, 'watched'])->name('admin.invoices.watched');
    Route::get('/invoices/{id}/success', [App\Http\Controllers\Admin\InvoiceController::class, 'success'])->name('admin.invoices.success');
    Route::get('/invoices/{id}/refuse', [App\Http\Controllers\Admin\InvoiceController::class, 'refuse'])->name('admin.invoices.refuse');
    Route::get('/invoices/{id}/contact', [App\Http\Controllers\Admin\InvoiceController::class, 'contact'])->name('admin.invoices.contact');

    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{id}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.users.update');
    Route::get('/users/{id}', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('admin.users.show');

    Route::get('/approve', [App\Http\Controllers\Admin\ApproveInvoiceController::class, 'index'])->name('admin.approve.index');
    Route::get('/payment', [App\Http\Controllers\Admin\PaymentInvoiceController::class, 'index'])->name('admin.payment.index');


    Route::get('/roles', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('admin.roles.index');
    Route::post('/roles', [App\Http\Controllers\Admin\RoleController::class, 'store'])->name('admin.roles.store');
    Route::get('/roles/{id}/give-permissions', [App\Http\Controllers\Admin\RoleController::class, 'add'])->name('admin.roles.add');
    Route::put('/roles/{id}/give-permissions', [App\Http\Controllers\Admin\RoleController::class, 'give'])->name('admin.roles.give');
    Route::get('/roles/{id}/edit', [App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('admin.roles.edit');
    Route::put('/roles/{id}', [App\Http\Controllers\Admin\RoleController::class, 'update'])->name('admin.roles.update');
    Route::get('/roles/{id}/delete', [App\Http\Controllers\Admin\RoleController::class, 'destroy'])->name('admin.roles.destroy');

    Route::get('/permissions', [App\Http\Controllers\Admin\PermissionController::class, 'index'])->name('admin.permissions.index');
    Route::post('/permissions', [App\Http\Controllers\Admin\PermissionController::class, 'store'])->name('admin.permissions.store');

    Route::get('/permissions/{id}/edit', [App\Http\Controllers\Admin\PermissionController::class, 'edit'])->name('admin.permissions.edit');
    Route::put('/permissions/{id}', [App\Http\Controllers\Admin\PermissionController::class, 'update'])->name('admin.permissions.update');
    Route::get('/permissions/{id}/delete', [App\Http\Controllers\Admin\PermissionController::class, 'destroy'])->name('admin.permissions.destroy');

    Route::get('/general', [GeneralController::class, 'index'])->name('admin.general.index');
    Route::post('/general', [GeneralController::class, 'update'])->name('admin.general.update');

    Route::get('/levels', [LevelController::class, 'index'])->name('admin.level.index');
    Route::get('/levels/create', [LevelController::class, 'create'])->name('admin.level.create');
    Route::post('/levels/store', [LevelController::class, 'store'])->name('admin.level.store');
    Route::get('/levels/{id}/edit', [LevelController::class, 'edit'])->name('admin.level.edit');
    Route::put('/levels/{id}', [LevelController::class, 'update'])->name('admin.level.update');
    Route::get('/levels/{id}/config', [LevelController::class, 'editConfig'])->name('admin.level.editConfig');
    Route::put('/levels/{id}/config', [LevelController::class, 'updateConfig'])->name('admin.level.updateConfig');

    Route::get('/payment-methods', [App\Http\Controllers\Admin\PaymentMethodController::class, 'index'])->name('admin.payment-methods.index');
    Route::get('/payment-methods/create', [App\Http\Controllers\Admin\PaymentMethodController::class, 'create'])->name('admin.payment-methods.create');
    Route::post('/payment-methods/store', [App\Http\Controllers\Admin\PaymentMethodController::class, 'store'])->name('admin.payment-methods.store');
    Route::get('/payment-methods/{id}/edit', [App\Http\Controllers\Admin\PaymentMethodController::class, 'edit'])->name('admin.payment-methods.edit');
    Route::put('/payment-methods/{id}', [App\Http\Controllers\Admin\PaymentMethodController::class, 'update'])->name('admin.payment-methods.update');

    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
    // Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');

    Route::get('/posts', [PostController::class, 'index'])->name('admin.post.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('admin.post.create');
    Route::post('/posts', [PostController::class, 'store'])->name('admin.post.store');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('admin.post.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('admin.post.update');

});