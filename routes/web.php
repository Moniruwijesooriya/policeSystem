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
])->middleware('auth');

Route::post('/registerPoliceOffice',[
    'uses'=>'AdminController@registerPoliceOffice',
    'as'=>'registerPoliceOffice'
])->middleware('auth');

Route::post('/registerCitizen',[
    'uses'=>'CitizenController@registerCitizen',
    'as'=>'registerCitizen'
]);

Route::get('/admin','AdminController@index');
Route::get('/IGP','IGPController@index');
Route::get('/RegisteredCitizen','CitizenLoginController@index');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

