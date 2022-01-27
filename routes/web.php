<?php

use App\Http\Controllers\Backend\AdminAuthController;
use App\Http\Controllers\Backend\AdminCategoryController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminTagController;
use App\Http\Controllers\Backend\AdminUploadController;
use App\Http\Controllers\Backend\AdminUserController;
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

// Users
Route::get('app/get_users', [AdminUserController::class, 'index']);
Route::post('app/create_user', [AdminUserController::class, 'store']);
Route::post('app/edit_user', [AdminUserController::class, 'update']);

//Authentication
Route::post('app/admin_login', [AdminAuthController::class, 'login']);
Route::get('app/admin_logout', [AdminAuthController::class, 'logout']);

// Dashboard
Route::get('/', [AdminController::class, 'index']);
Route::get('{slug}', [AdminController::class, 'index']);


// Route::get('/', function () {
//     return view('welcome');
// });
// Route::any('{slug}', function () {
//     return view('welcome');
// });
