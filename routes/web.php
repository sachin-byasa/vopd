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
    return Redirect::to(route('report.index'));
});
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('maintenance', 'Admin\UnderConstructionController@index')->name('under-construction.index');

Auth::routes();

Route::group(['namespace' => 'Admin', 'prefix' => 'admin','middleware' => [ 'auth:vopd', 'user.control']], function($CommonUtils){

	 //route for dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
    Route::get('/reports', 'ReportController@index')->name('report.index');
    Route::get('/reports/doctor', 'ReportController@doctor_report')->name('report.doctor');
    Route::get('/reports/agent', 'ReportController@agent_report')->name('report.agent');
    Route::get('/reports/call_listing', 'ReportController@call_listing')->name('report.call_listing');
    Route::get('/reports/call_listing/export/{start_date}/{end_date}/{caller_number}', 'ReportController@call_listing_export')->name('report.call_listing.export');
    Route::get('/reports/doctor/export/{start_date}/{end_date}', 'ReportController@doctor_export')->name('report.doctor.export');
    Route::get('/reports/agent/export/{start_date}/{end_date}', 'ReportController@agent_export')->name('report.agent.export');
    Route::get('/reports/export/{start_date}/{end_date}', 'ReportController@report_export')->name('report.index.export');
    //Route::post('/reports/summary', 'ReportController@get_summary')->name('report.summary');
});



Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
