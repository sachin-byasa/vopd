<?php
use Illuminate\Support\Facades\Route;
$CommonUtils = new \App\Library\CommonUtils();

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
    return Redirect::to(route('dashboard.index'));
});
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('maintenance', 'Admin\UnderConstructionController@index')->name('under-construction.index');

Auth::routes();

Route::group(['namespace' => 'Admin', 'prefix' => 'admin','middleware' => [ 'auth:vopd', 'user.control']], function($CommonUtils){

	 //route for dashboard
    
    Route::get('/reports', 'ReportController@index')->name('report.index');
    Route::get('/reports/doctor', 'ReportController@doctor_report')->name('report.doctor');
    Route::get('/reports/agent', 'ReportController@agent_report')->name('report.agent');
    Route::get('/reports/call_listing', 'ReportController@call_listing')->name('report.call_listing');
    Route::get('/reports/call_listing/export/{start_date}/{end_date}/{caller_number}', 'ReportController@call_listing_export')->name('report.call_listing.export');
    Route::get('/reports/doctor/export/{start_date}/{end_date}', 'ReportController@doctor_export')->name('report.doctor.export');
    Route::get('/reports/agent/export/{start_date}/{end_date}', 'ReportController@agent_export')->name('report.agent.export');
    Route::get('/reports/export/{start_date}/{end_date}', 'ReportController@report_export')->name('report.index.export');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');

    //Route::post('/reports/summary', 'ReportController@get_summary')->name('report.summary');

    Route::get('/group-menu/{group_id?}', 'GroupMenuController@index')->name('group-menu.index');
    // Route::post('/group-menu', 'GroupMenuController@index')->name('group-menu.index');
    Route::post('/group-menu/update', 'GroupMenuController@update')->name('group-menu.update');
    Route::get('/group-menu/export', 'GroupMenuController@export')->name('group-menu.export');

    Route::get('/group-master', 'GroupMasterController@index');
    Route::post('/group-master', 'GroupMasterController@index')->name('group-master.index');
    Route::get('/group-master/create', 'GroupMasterController@create')->name('group-master.group.create');
    Route::post('/group-master/store', 'GroupMasterController@store')->name('group-master.group.store');
    Route::get('/edit-group/{id}', 'GroupMasterController@edit')->name('group-master.group.edit');
    Route::post('/group/update/{id}', 'GroupMasterController@update')->name('group-master.group.update');
    Route::post('/add-group', 'GroupMasterController@store')->name('group-master.group.add');
    Route::get('/group-master/disable/{id}', 'GroupMasterController@destroy')->name('group-master.group.disable');
    Route::get('/group-master/enable/{id}', 'GroupMasterController@activate')->name('group-master.group.enable');

     Route::get('/user-master', 'UserMasterController@index');
    Route::post('/user-master', 'UserMasterController@index')->name('user-master.index');
    Route::get('/user-master/create', 'UserMasterController@create')->name('user-master.create');
    Route::post('/user-master/store', 'UserMasterController@store')->name('user-master.store');
    Route::get('/edit-user/{id}', 'UserMasterController@edit')->name('user-master.edit');
    Route::post('/user/update/{id}', 'UserMasterController@update')->name('user-master.update');
    Route::post('/add-user', 'UserMasterController@store')->name('user-master.add');
    Route::get('user-master/disable/{id}', 'UserMasterController@disable')->name('user-master.disable');
    Route::get('user-master/enable/{id}', 'UserMasterController@enable')->name('user-master.enable');
    
      Route::get('phc/disable/{id}', 'PhcController@disable')->name('phc.disable');
    Route::get('phc/enable/{id}', 'PhcController@enable')->name('phc.enable');
    Route::get('phc/export', 'PhcController@export')->name('phc.export');
    Route::get('phc/getSubCentresFromPHC/{phc}', 'PhcController@getSubCentresFromPHC');
    Route::resource('phc', 'PhcController',[
        'only' => [ 'index', 'create', 'store', 'show', 'edit', 'update']
    ]);
       //route for my profile page
    Route::get('/profile', 'MyProfileController@index')->name('my-profile.index');
      //route for change password
    Route::post('/profile/change/password', 'MyProfileController@change_password')->name('my-profile.change.password');
});


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
