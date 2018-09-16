<?php

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

Route::get('/', function () {
    return view('welcome');
    
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'AdminController@index')->name('admin');

Route::get('/colombo', [
    'uses'=>'PostsController@colomboPost',
    'as'=>'colomboPost'
])->middleware('Auth');

Route::post('/submitCrimeEntry',[
    'uses'=>'EntryController@submitEntry',
    'as'=>'submitEntry'
])->middleware('auth');

Route::post('/registerPoliceOfficer',[
    'uses'=>'AdminController@registerPoliceOfficer',
    'as'=>'registerPoliceOfficer'
]);

Route::post('/registerPoliceOffice',[
    'uses'=>'AdminController@registerPoliceOffice',
    'as'=>'registerPoliceOffice'
])->middleware('auth');

Route::get('/admin','AdminController@index');
Route::get('/IGP','IGPController@index');

