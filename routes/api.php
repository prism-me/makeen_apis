<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::resource('mentors', 'MentorController');
Route::post('contact_form', 'ContactQueryController@contact_form');
Route::post('waitlist', 'ContactQueryController@waitlist');
Route::post('request_for_call', 'ContactQueryController@request_for_call');
Route::post('book_tour', 'ContactQueryController@book_tour');
Route::get('get_all_queries' , 'ContactQueryController@get_all_queries');

Route::resource('uploads', 'UploadController');
Route::resource('todos', 'TodoController');
Route::resource('sections', 'SectionController');
Route::get('all_sections/{id}', 'SectionController@all_sections');

Route::resource('pages','PageController');

Route::resource('studentCare','StudentCareController');

Route::resource('exp_and_life','ExpAgsController');

Route::put('update_exp/{id}','ExpAgsController@update_exp');

Route::post('upload_media', 'UploadController@upload_media')->name('upload_media');

Route::get('get_all_images', 'UploadController@get_all_images');

Route::delete('delete_images/{id}', 'UploadController@delete_images');

Route::put('update_image/{file}/{id}', 'UploadController@update_image');


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
    Route::resource('/wishlist','WishlistController');
});


Route::fallback(function () {
    echo  json_encode(['message'=>'Undefined Route']);
});


// Route::get('custom-slug/{id}', function($value) {

//    // $text = "Custom Facade in Laravel 8";

//     MyFacade::slugify($value);

// });

