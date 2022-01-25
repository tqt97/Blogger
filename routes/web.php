<?php

use App\Http\Controllers\Backend\AdminTagController;
use Illuminate\Support\Facades\Route;





Route::get('app/get_tags', [AdminTagController::class, 'index']);
Route::post('app/create_tag', [AdminTagController::class, 'store']);
Route::post('app/edit_tag', [AdminTagController::class, 'update']);
Route::post('app/delete_tag', [AdminTagController::class, 'delete']);

Route::get('/', function () {
    return view('welcome');
});
Route::any('{slug}', function () {
    return view('welcome');
});
