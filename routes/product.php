<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::group(
    [
        'prefix' => '/redirect',
        'namespace' => '',
        'middleware' => ['auth'],
    ],
    function () {
        Route::prefix('/product')
            ->as('product.')
            ->group(function () {
                Route::get('/', [AdminController::class, 'index'])
                    ->name('index');
                Route::get('/create', [AdminController::class, 'create'])
                    ->name('create');
                // Route::get('/{category}', [AdminController::class, 'show'])
                //     ->name('show');
                Route::post('/', [AdminController::class, 'store'])
                    ->name('store');
                Route::get('/{product}/edit', [AdminController::class, 'edit'])
                    ->name('edit');
                Route::put('/{product}', [AdminController::class, 'update'])
                    ->name('update');
                Route::delete('/{product}', [AdminController::class, 'destroy'])
                    ->name('destroy');
                Route::delete('/deleteImages/{product}/{key}', [AdminController::class, 'deleteImages'])
                    ->name('deleteImages');
            });
    }
);






// Route::get('/',[PostController::class,'index']);

// Route::get('/create',function(){
// return view('create');
// });

// Route::post('/post',[PostController::class,'store']);
// Route::delete('/delete/{id}',[PostController::class,'destroy']);
// Route::get('/edit/{id}',[PostController::class,'edit']);

// Route::delete('/deleteimage/{id}',[PostController::class,'deleteimage']);
// Route::delete('/deletecover/{id}',[PostController::class,'deletecover']);

// Route::put('/update/{id}',[PostController::class,'update']);
