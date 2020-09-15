<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CommonData;

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
Route::get('/top', 'TuserController@topPage')->name('top')->middleware(CommonData::class);
Route::post('/login', 'TuserController@login')->name('login');
Route::post('/update_content', 'TuserController@updateContent')->name('update_content');
Route::get('/logout/{logout_location?}', 'TuserController@logout')->name('logout');

// 全社報告書
// Route::get('/inclusion_result', 'InclusionResultController@index')->name('inclusion_result');
Route::get('/inclusion_result', 'InclusionResultController@index')->name('inclusion_result')->middleware(CommonData::class);
Route::get('/inclusion_report', 'InclusionReportController@index')->name('inclusion_report')->middleware(CommonData::class);

//　個別報告書
Route::get('/individual_result', 'IndividualResultController@index')->name('individual_result')->middleware(CommonData::class);
Route::get('/create_report', 'IndividualResultController@create_report')->name('create_report')->middleware(CommonData::class);
Route::get('/detail_report/{report_number}', 'IndividualResultController@detail_report')->name('detail_report')->middleware(CommonData::class);

//　要望提案書
Route::get('/correspondence_result', 'CorrespondenceResultController@index')->name('correspondence_result')->middleware(CommonData::class);

// 報告書提出
Route::post('report_register', 'IndividualResultController@register')->name('report_register')->middleware(CommonData::class);

//　営業集計
Route::get('/sales_total', 'SalesTotalController@index')->name('sales_total')->middleware(CommonData::class);

// Api Group Routings
Route::group(['middleware' => ['api']], function(){
  Route::get('/api/individual_result', 'Api\InclusionResultController@index')->name('api_individual_result');
});
