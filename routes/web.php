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
    'as'=>'viewOICEntry'
])->middleware('auth');

Route::post('/acceptOICEntry',[
    'uses'=>'EntryController@acceptOICEntry',
    'as'=>'acceptOICEntry'
])->middleware('auth');

Route::post('/viewBOICEntry',[
    'uses'=>'EntryController@viewBOICEntry',
    'as'=>'viewBOICEntry'
])->middleware('auth');

Route::post('/updateCitizenEntry',[
    'uses'=>'EntryController@updateCitizenEntry',
    'as'=>'updateCitizenEntry'
])->middleware('auth');

Route::post('/viewCitizenEntry',[
    'uses'=>'EntryController@viewCitizenEntry',
    'as'=>'viewCitizenEntry'
])->middleware('auth');

Route::post('/acceptBOICEntry',[
    'uses'=>'EntryController@acceptBOICEntry',
    'as'=>'acceptBOICEntry'
]);

Route::post('/reviewCitizenRegistrationRequest',[
    'uses'=>'CitizenController@ViewRequest',
    'as'=>'reviewCitizenRegistrationRequest'
]);

Route::post('/acceptCitizenRequest',[
    'uses'=>'CitizenController@AcceptCitizenRequest',
    'as'=>'acceptCitizenRequest'
]);

Auth::routes(['verify' => true]);


Route::get('/admin','AdminController@index');
Route::get('/IGP','IGPController@index');
Route::get('/RegisteredCitizen','CitizenController@index')->middleware('verified');
Route::get('/OIC','OICController@index')->middleware('auth');
Route::get('/BOIC','BOICController@index');
Route::get('/DOIG','DOIGController@index');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('verify/{token}','verifyController@verifyEmail');

