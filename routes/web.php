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

Route::post('/viewOICEntry',[
    'uses'=>'EntryController@viewOICEntry',
    'as'=>'viewEntry'
]);

Route::post('/accepOICtEntry',[
    'uses'=>'EntryController@acceptOICEntry',
    'as'=>'acceptEntry'
]);

Route::post('/viewBOICEntry',[
    'uses'=>'EntryController@viewBOICEntry',
    'as'=>'viewEntry'
]);

Route::post('/acceptBOICEntry',[
    'uses'=>'EntryController@acceptBOICEntry',
    'as'=>'acceptEntry'
]);

Route::post('/reviewCitizenRegistrationRequest',[
    'uses'=>'CitizenController@ViewRequest',
    'as'=>'reviewCitizenRegistrationRequest'
]);

Route::post('/acceptCitizenRequest',[
    'uses'=>'CitizenController@AcceptCitizenRequest',
    'as'=>'acceptCitizenRequest'
]);


Route::get('/admin','AdminController@index');
Route::get('/IGP','IGPController@index');
Route::get('/RegisteredCitizen','CitizenLoginController@index');
Route::get('/OIC','OICController@index');
Route::get('/BOIC','BOICController@index');
Route::get('/DOIG','DOIGController@index');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

