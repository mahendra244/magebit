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
    return view('User.auth.login');
});

// user Registration and login
Route::get('user-registration', 'UserController@index');
Route::post('user-store', 'UserController@userPostRegistration');
Route::get('user-login', 'UserController@userLoginIndex');
Route::post('login', 'UserController@userPostLogin');
Route::get('user/dashboard', 'UserController@dashboard');
Route::get('user/logout', 'UserController@logout');
Route::get('user/change-password', 'UserController@getChangePassword');
Route::post('user/change-password', 'UserController@postChangePassword');
Route::get('forget-password', 'Auth\ForgotPasswordController@showForgetPasswordForm')->name('forget.password.get');
Route::post('forget-password', 'Auth\ForgotPasswordController@submitForgetPasswordForm')->name('forget.password.post'); 
Route::get('reset-password/{token}','Auth\ForgotPasswordController@showResetPasswordForm')->name('reset.password.get');
Route::post('reset-password','Auth\ForgotPasswordController@submitResetPasswordForm')->name('reset.password.post');

// user Dashboard
Route::get('user/dashboard', 'User\EmployeeController@index')->name('user.dashboard');
Route::get('user/employee-data/{id}', 'User\EmployeeController@employeeData');
Route::get('user/company-data/{id}', 'User\EmployeeController@companyData');
Route::post('user/update-status', 'User\EmployeeController@updateStatus');
Route::post('user/employee-data/{id}', 'User\EmployeeController@employeeDataFilter');
Route::get('user/employee-data/delete/{id}', 'User\IndexController@employeedelete');
Route::get('user/company-data/delete/{id}', 'User\IndexController@companyDelete');
Route::get('user/company-name/', 'User\IndexController@getProduct');
Route::get('user/employee-data-import', 'User\EmployeeDataImportController@getImportForm')->name('user.employee-data-import');
Route::post('user/post-import-employee-data', 'User\EmployeeDataImportController@postImportExcel');
Route::post('user/post-employee-data', 'User\EmployeeDataImportController@uploadEmployeeData');
Route::get('user/company-data-import', 'User\CompanyDataImportController@getImportForm')->name('user.company-data-import');
Route::post('user/post-import-company-data', 'User\CompanyDataImportController@postImportExcel');
Route::post('user/post-company-data', 'User\CompanyDataImportController@postCompanyData');
Route::get('user/updated-list/{id?}', 'User\EmployeeController@updateList')->name('user.updated-list');
Route::get('user/employee-updated-report/{id?}', 'User\EmployeeController@employeeUpdatedReport');
Route::get('user/all-employee-updated-report/{id?}', 'User\EmployeeController@allemployeeUpdatedReport');
Route::get('user/get-company/{id}', 'User\EmployeeController@Listofcompany');
Route::get('user/emp_match_preview/{id}', 'User\EmployeeController@matchDashboard');
Route::get('user/emp_match_update/{id}', 'User\EmployeeController@empCompMatchUpdate');
// sendgrid import
Route::get('user/sendgrid-data-import', 'User\SendgridDataImportController@getSendgridImportForm')->name('user.sendgrid-data-import');
Route::post('user/post-sendgrid-data', 'User\SendgridDataImportController@uploadsendgridData')->name('user.post-sendgrid-data');
Route::get('user/sendgrid-data/{id}', 'User\SendgridController@getSendgridData');
Route::get('user/sendgrid-delete/{id}', 'User\SendgridController@getSendgridDelete');
Route::get('user/sendgrid-email-filter/{id}', 'User\SendgridController@getEmailFilter');
Route::get('user/sendgrid-user-detail/{user_id}', 'User\SendgridController@getMailDetails');
Route::get('user/email-details-report/{user_id?}', 'User\SendgridController@getMailDetailsReports');
Route::get('user/sendgrid-all-report/{unique_id?}', 'User\SendgridController@getSendgridAllReports');




