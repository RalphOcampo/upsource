<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\gameController;

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

Route::group(['middleware' => ['web']], function () {
    Route::get('/', [gameController::class, 'index']);
    Route::get('/introduction', [gameController::class, 'introduction']);
    Route::get('/chapter', [gameController::class, 'chapter']);
    
    // Get Details
    Route::get('/get_user_selected_detail', [gameController::class, 'get_user_selected_detail']);
    Route::get('/get_user_introduction', [gameController::class, 'get_user_introduction']);
    Route::get('/get_user_chapter', [gameController::class, 'get_user_chapter']);
    

    // Master List
    Route::get('/master_avatar_list', [gameController::class, 'master_avatar_list']);

    // Transaction

    Route::get('/update_user_character_selected', [gameController::class, 'update_user_character_selected']);
    Route::get('/update_user_introduction', [gameController::class, 'update_user_introduction']);

    Route::post('/update_user_chapter', [gameController::class, 'update_user_chapter']);
    Route::post('/update_user_chapter_unlocked', [gameController::class, 'update_user_chapter_unlocked']);

    //Clear session
    Route::get('/resetgame', [gameController::class, 'resetgame']);
    
});