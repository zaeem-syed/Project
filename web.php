<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShowTutionsController;
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



Route::get('/','WelcomeController@index');

Route::get('/pro', function () {
    return view('Pro');
});
Route::group(['middleware' =>['auth','admin'] ], function () {
 
    Route::get('/admin', function () {
        return view('admin.dashboard');
    });
    Route::resource('location', 'LocationController');
    Route::resource('grade','GradeController');
    Route::resource('subject', 'SubjectController');
    Route::resource('city','CitiesController');
});

Route::get('/log', function () {
    return view('user.login1');
});

Auth::routes();

Route::get('Profile','ProfileController@index')->name('Profile');
Route::get('Profile/{user}',[ProfileController::class,'show'])->name('Profile.show');

Route::resource('user', 'UsersController');
Route::put('image/{user}','UsersController@ImageUpload')->name('image.upload');
Route::put('Profile/{user}','UsersController@ProfileUpdate')->name('Profile.update');

Route::post('Rating','RatingController@store')->name('Rating.profile');


Route::get('showTution','ShowTutionsController@index')->name('showTution.index');
Route::get('showtutions/{tution}',[ShowTutionsController::class,'show'])->name('showTution.show');
Route::get('tutions/{city}',[ShowTutionsController::class,'city'])->name('showTution.city');
Route::resource('tution', 'TutionsController');
Route::get('/home', 'HomeController@index')->name('home');
