<?php

use App\Http\Controllers\Backend\AdminAuthController;
use App\Http\Controllers\Backend\AdminBlogController;
use App\Http\Controllers\Backend\AdminCategoryController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminRoleController;
use App\Http\Controllers\Backend\AdminTagController;
use App\Http\Controllers\Backend\AdminUploadController;
use App\Http\Controllers\Backend\AdminUserController;
use Illuminate\Support\Facades\Route;


Route::prefix('app')->middleware([AdminCheck::class])->group(function(){
// Route::group(['prefix' => 'app', 'middleware' => ['AdminCheck']], function () {
    // tags
    Route::get('/get_tags', [AdminTagController::class, 'index']);
    Route::post('/create_tag', [AdminTagController::class, 'store']);
    Route::post('/edit_tag', [AdminTagController::class, 'update']);
    Route::post('/delete_tag', [AdminTagController::class, 'delete']);

    // category
    Route::post('/upload', [AdminCategoryController::class, 'upload']);
    Route::post('/delete_image', [AdminCategoryController::class, 'deleteImage']);
    Route::post('/create_category', [AdminCategoryController::class, 'store']);
    Route::get('/get_categories', [AdminCategoryController::class, 'index']);
    Route::post('/edit_category', [AdminCategoryController::class, 'update']);
    Route::post('/delete_category', [AdminCategoryController::class, 'delete']);

    // Users
    Route::get('/get_users', [AdminUserController::class, 'index']);
    Route::post('/create_user', [AdminUserController::class, 'store']);
    Route::post('/edit_user', [AdminUserController::class, 'update']);

    // Roles
    Route::get('/get_roles', [AdminRoleController::class, 'index']);
    Route::post('/create_role', [AdminRoleController::class, 'store']);
    Route::post('/edit_role', [AdminRoleController::class, 'update']);
    Route::post('/delete_role', [AdminRoleController::class, 'delete']);
    Route::post('/permissions', [AdminRoleController::class, 'assign']);


    //Authentication
    Route::post('/admin_login', [AdminAuthController::class, 'login']);
    Route::get('/admin_logout', [AdminAuthController::class, 'logout']);

    // Blogs
    Route::get('/get_blogs', [AdminBlogController::class, 'index']);
    Route::get('/get_blog/{id}', [AdminBlogController::class, 'edit']);

    Route::post('/create_blog', [AdminBlogController::class, 'store']);
    Route::post('/update_blog/{id}', [AdminBlogController::class, 'update']);
    Route::post('/delete_blog', [AdminBlogController::class, 'delete']);

});
Route::post('/createBlog', [AdminUploadController::class, 'upload']);

// Dashboard
Route::get('/', [AdminController::class, 'index']);
// Route::any('{slug}', [AdminController::class, 'index'])->where('slug', '/^[a-z0-9]([0-9a-z_\-\s])+$/i');

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::any('{slug}', function () {
//     return view('welcome');
// });
Route::any('{any}', function () {
    return view('welcome');
})->where('any','.*');
