<?php

use App\Http\Controllers\Admin\MemberController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){
    Route::match(['get','post'],'login','AdminController@login');
    Route::group(['middleware'=>['admin']], function(){
        Route::get('dashboard','AdminController@dashboard');
        Route::match(['get','post'],'update-password','AdminController@updatePassword');
        Route::match(['get','post'],'update-details','AdminController@updateDetails');
        Route::post('check-current-password','AdminController@checkCurentPassword');

        Route::get('logout','AdminController@logout');

        //Cms pages
        Route::get('cms-pages','CmsPageController@index');
        Route::post('update-cms-page-status','CmsPageController@update');
        Route::match(['get','post'],'add-edit-cms-page/{id?}','CmsPageController@edit');
        Route::get('delete-cms-page/{id?}','CmsPageController@destroy');

        //Sub Admins
        Route::get('sub-admins','AdminController@subadmins');
        Route::post('update-subadmin-status','AdminController@updateSubadminStatus');
        Route::get('delete-sub-admin/{id?}','AdminController@destroySubadmin');
        Route::match(['get','post'],'add-edit-sub-admin/{id?}','AdminController@addEditSubadmin');
        Route::match(['get','post'], 'update-sub-admin-role/{id?}', 'AdminController@UpdateSubadminRole');

        //Members
        Route::get('members', 'MemberController@index');
        Route::match(['get','post'],'add-edit-member/{id?}','MemberController@addEdit');
        Route::post('update-member-status','MemberController@updateMemberStatus');
        Route::get('delete-member/{id?}','MemberController@destroy');

        //Loans
        Route::get('loans','LoanController@index');
        Route::match(['get','post'],'add-edit-loan/{id?}','LoanController@addEdit');
        Route::match(['get','post'],'update-loan-status','LoanController@updateLoanStatus');

        //Loan types
        Route::get('loan_types','LoanTypeController@index');
        Route::match(['get','post'],'add-edit-loan-type/{id?}','LoanTypeController@addEdit');


    });

});
