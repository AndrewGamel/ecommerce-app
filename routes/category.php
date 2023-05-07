<?php
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['auth'],
    'prefix' => '/redirect',
], function () {
    Route::prefix('/category')
    ->as('category.')
    ->group( function () {
            Route::get('/', [CategoryController::class, 'index'])
                ->name('index');
            Route::get('/create', [CategoryController::class, 'create'])
                ->name('create');
// Route::get('/{category}', [CategoryController::class, 'show'])
//     ->name('show');
            Route::post('/', [CategoryController::class, 'store'])
                ->name('store');
                 // Route::get('/{product}/edit', [CategoriesController::class, 'edit'])
            //     ->name('edit');
            // Route::put('/{product}', [CategoriesController::class, 'update'])
            //     ->name('update');
            // Route::delete('/{product}', [CategoriesController::class, 'destroy'])
            //     ->name('destroy');
        });

});