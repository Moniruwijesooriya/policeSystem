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



Route::post('/viewOICEntry',[
    'uses'=>'EntryController@viewOICEntry',
    'as'=>'viewOICEntry'
])->middleware('auth');

Route::post('/entryOICAction',[
    'uses'=>'EntryController@entryOICAction',
    'as'=>'entryOICAction'
])->middleware('auth');

Route::post('/viewBOICEntry',[
    'uses'=>'EntryController@viewBOICEntry',
    'as'=>'viewBOICEntry'
])->middleware('auth');



Route::post('/viewCitizenEntry',[
    'uses'=>'EntryController@viewCitizenEntry',
    'as'=>'viewCitizenEntry'
])->middleware('auth');

Route::post('/acceptBOICEntry',[
    'uses'=>'EntryController@acceptBOICEntry',
    'as'=>'acceptBOICEntry'
]);



Route::post('/acceptCitizenRequest',[
    'uses'=>'CitizenController@AcceptCitizenRequest',
    'as'=>'acceptCitizenRequest'
]);

Auth::routes(['verify' => true]);


Route::get('/admin','AdminController@index');
Route::get('/IGP','IGPController@index');

Route::get('/OIC','OICController@index')->middleware('auth');
Route::get('/BOIC','BOICController@index');
Route::get('/DOIG','DOIGController@index');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('verify/{token}','verifyController@verifyEmail');

//citizen
Route::get('/RegisteredCitizen','CitizenLoginController@index')->middleware('verified');
Route::get('updateFormView','CitizenController@updateFormView');
Route::post('citizenInfoUpdate','CitizenController@citizenInfoUpdate');

Route::post('/updateCitizenEntry',[
    'uses'=>'EntryController@updateCitizenEntry',
    'as'=>'updateCitizenEntry'
])->middleware('auth');
Route::post('/registerCitizen',[
    'uses'=>'CitizenController@registerCitizen',
    'as'=>'registerCitizen'
]);
Route::post('/reviewCitizenRegistrationRequest',[
    'uses'=>'CitizenController@ViewRequest',
    'as'=>'reviewCitizenRegistrationRequest'
]);

Route::post('/citizenAccountDeactivate',[
    'uses'=>'CitizenController@citizenAccountDeactivate',
    'as'=>'citizenAccountDeactivate'
]);

Route::post('/citizenPasswordChange',[
    'uses'=>'CitizenController@citizenPasswordChange',
    'as'=>'citizenPasswordChange'
]);

//Oic
Route::get('/test','OICController@test');

Route::post('/createPost','PostsController@createPost');

Route::get('/viewNewEntries',[
    'uses'=>'EntryController@viewOICNewEntries',
    'as'=>'NewEntries'
])->middleware('auth');

Route::get('/viewOngoingEntries',[
    'uses'=>'EntryController@viewOICOngoingEntries',
    'as'=>'OngoingEntries'
])->middleware('auth');

Route::get('/viewClosedEntries',[
    'uses'=>'EntryController@viewClosedEntries',
    'as'=>'ClosedEntries'
])->middleware('auth');

Route::get('/viewNewCitizenRequests',[
    'uses'=>'OICController@viewNewCitizenRequests',
    'as'=>'viewNewCitizenRequests'
])->middleware('auth');

Route::get('/viewRegisteredCitizens',[
    'uses'=>'OICController@viewRegisteredCitizens',
    'as'=>'viewRegisteredCitizens'
])->middleware('auth');


Route::get('/viewClosedAccounts',[
    'uses'=>'OICController@viewClosedAccounts',
    'as'=>'viewClosedAccounts'
])->middleware('auth');

Route::post('/oicPasswordChange',[
    'uses'=>'OICController@oicPasswordChange',
    'as'=>'oicPasswordChange'
]);
Route::post('/manageCitizen',[
    'uses'=>'OICController@manageCitizen',
    'as'=>'manageCitizen'
]);
Route::post('/viewBranch',[
    'uses'=>'OICController@viewBranch',
    'as'=>'viewBranch'
]);




Route::get('/viewClosedEntries',[
    'uses'=>'EntryController@viewClosedEntries',
    'as'=>'ClosedEntries'
])->middleware('auth');

//admin////////////////////


Route::post('removeFormView','AdminController@removeFormView');
Route::post('/removePoliceOfficer',[
    'uses'=>'AdminController@removePoliceOfficer',
    'as'=>'removePoliceOfficer'
])->middleware('auth');

Route::post('/addCrimeCategories',[
    'uses'=>'AdminController@addCrimeCategories',
    'as'=>'addCrimeCategory'
])->middleware('auth');

Route::get('/viewCrimeTypeList',[
    'uses'=>'AdminController@viewCrimeTypeList',
    'as'=>'CrimeTypeList'
])->middleware('auth');

Route::post('/deleteCrimeType',[
    'uses'=>'AdminController@deleteCrimeType',
    'as'=>'deleteCrimeType'
])->middleware('auth');

Route::post('/updateViewCrimeType',[
    'uses'=>'AdminController@updateViewCrimeType',
    'as'=>'updateViewCrimeType'
])->middleware('auth');

Route::post('/updateCrimeType',[
    'uses'=>'AdminController@updateCrimeType',
    'as'=>'updateCrimeType'
])->middleware('auth');

Route::post('/viewCrimeCategorySection',[
    'uses'=>'AdminController@viewCrimeCategorySection',
    'as'=>'viewCrimeCategorySection'
])->middleware('auth');

Route::post('/updateRankFormView',[
    'uses'=>'AdminController@updateRankFormView',
    'as'=>'updateRankFormView'
])->middleware('auth');

Route::get('/viewPoliceOfficesList',[
    'uses'=>'AdminController@viewPoliceOfficesList',
    'as'=>'viewPoliceOfficesList'
])->middleware('auth');

Route::post('/deletePoliceOffices',[
    'uses'=>'AdminController@deletePoliceOffices',
    'as'=>'deletePoliceOffices'
])->middleware('auth');


Route::post('/updatePoliceOfficesFormView',[
    'uses'=>'AdminController@updatePoliceOfficesFormView',
    'as'=>'updatePoliceOfficesFormView'
])->middleware('auth');

Route::post('/getRemovedUserInfo',[
    'uses'=>'EntryController@getRemovedUserInfo',
    'as'=>'getRemovedUserInfo'
])->middleware('auth');

Route::post('/updatePoliceOffices',[
    'uses'=>'AdminController@updatePoliceOffices',
    'as'=>'updatePoliceOffices'
])->middleware('auth');

Route::get('/viewPoliceOfficersList',[
    'uses'=>'AdminController@viewPoliceOfficersList',
    'as'=>'viewPoliceOfficersList'
])->middleware('auth');


Route::post('/updatePoliceOfficerFormView',[
    'uses'=>'AdminController@updatePoliceOfficerFormView',
    'as'=>'updatePoliceOfficerFormView'
])->middleware('auth');

Route::post('/updatePoliceOfficer',[
    'uses'=>'AdminController@updatePoliceOfficer',
    'as'=>'updatePoliceOfficer'
])->middleware('auth');

Route::get('/viewIGPRegisterForm',[
    'uses'=>'AdminController@viewIGPRegisterForm',
    'as'=>'viewIGPRegisterForm'
])->middleware('auth');

Route::get('/viewDORegisterForm',[
    'uses'=>'AdminController@viewDORegisterForm',
    'as'=>'viewDORegisterForm'
])->middleware('auth');

Route::get('/viewPSRegisterForm',[
    'uses'=>'AdminController@viewPSRegisterForm',
    'as'=>'viewPSRegisterForm'
])->middleware('auth');

Route::get('/viewBORegisterForm',[
    'uses'=>'AdminController@viewBORegisterForm',
    'as'=>'viewBORegisterForm'
])->middleware('auth');

Route::get('/viewPoliceOfficesList',[
    'uses'=>'AdminController@viewPoliceOfficesList',
    'as'=>'viewPoliceOfficesList'
])->middleware('auth');

Route::get('/viewAddCrimeTypeForm',[
    'uses'=>'AdminController@viewAddCrimeTypeForm',
    'as'=>'viewAddCrimeTypeForm'
])->middleware('auth');

Route::get('/viewregisterPoliceOfficer',[
    'uses'=>'AdminController@viewregisterPoliceOfficerForm',
    'as'=>'viewregisterPoliceOfficer'
])->middleware('auth');



//general
Route::post('/getUserInfo',[
    'uses'=>'EntryController@getUserInfo',
    'as'=>'getUserInfo'
])->middleware('auth');

Route::get('/viewRegisterLTE',[
    'uses'=>'AdminController@viewRegisterLTE',
    'as'=>'viewRegisterLTE'
])->middleware('auth');





