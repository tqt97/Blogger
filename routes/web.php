<?php

use App\Http\Controllers\Backend\AdminCategoryController;
use App\Http\Controllers\Backend\AdminTagController;
use App\Http\Controllers\Backend\AdminUploadController;
use Illuminate\Support\Facades\Route;




// tags
Route::get('app/get_tags', [AdminTagController::class, 'index']);
Route::post('app/create_tag', [AdminTagController::class, 'store']);
Route::post('app/edit_tag', [AdminTagController::class, 'update']);
Route::post('app/delete_tag', [AdminTagController::class, 'delete']);

// category
Route::post('app/upload', [AdminCategoryController::class, 'upload']);
Route::post('app/delete_image', [AdminCategoryController::class, 'deleteImage']);
Route::post('app/create_category', [AdminCategoryController::class, 'store']);
Route::get('app/get_categories', [AdminCategoryController::class, 'index']);
Route::post('app/edit_category', [AdminCategoryController::class, 'update']);
Route::post('app/delete_category', [AdminCategoryController::class, 'delete']);


Route::get('/', function () {
    return view('welcome');
});
Route::any('{slug}', function () {
    return view('welcome');
});
