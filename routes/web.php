<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;

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


Route::group(['middleware' => 'prevent-back-history'],function(){
    Auth::routes();
    Route::get('/', function () { return view('welcome');
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    

    });

    
// Change Password
Route::get('/changePassword', [App\Http\Controllers\HomeController::class, 'showChangePasswordGet'])->name('changePasswordGet');
Route::post('/changePassword', [App\Http\Controllers\HomeController::class, 'changePasswordPost'])->name('changePasswordPost');

// Authenticate check

Route::group(['middleware' => 'auth'], function() {
    Route::get('/changePassword',[App\Http\Controllers\HomeController::class, 'showChangePasswordGet'])->name('changePasswordGet');
    Route::post('/changePassword',[App\Http\Controllers\HomeController::class, 'changePasswordPost'])->name('changePasswordPost');
});

//Forget Password
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');




Route::middleware(['auth'])->group(function () {

// HOME DASHBOARD
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::post('/home', [HomeController::class, 'home'])->name('home');
    Route::put('/home', [HomeController::class,'update_image'])->name('member_update_image');
    Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');



// TITHES & OFFERINGS

    Route::get('/tithes&offerings/reports', [AdminController::class, 'ad_reports']);
    Route::post('/ad_reports', [AdminController::class, 'ad_reports']);
    Route::get('/tithes&offerings/summary', [AdminController::class, 'tithes_offerings_dashboard']);
    Route::get('/tithes&offerings/payment', [AdminController::class, 'online_payment_details']); 
    Route::get('/tithes&offerings/pending', [AdminController::class, 'ad_requests']);
    Route::put('/approve_requests/{toID}', [AdminController::class, 'approve_requests']);
    Route::get('/tithes&offerings/co-admin-request', [AdminController::class, 'co_admin_request']); 
    Route::get('/tithes&offerings/members-request', [AdminController::class, 'tithes_offerings_requests']); 
    Route::get('/tithes&offerings/co-admin-approval', [AdminController::class, 'co_admin_for_approval_page']); 

    Route::get('/tithe_view/{toID}', [AdminController::class, 'tithe_view']);

    

// PAYMENT
    Route::post('/online_payment_details', [AdminController::class, 'upload_online_payment_details']); 
    Route::put('/online_payment_visible/{oID}', [AdminController::class, 'visible_online_payment']); 
    Route::put('/online_payment_hidden/{oID}', [AdminController::class, 'hide_online_payment']); 
    Route::put('/approve_co_admin_request/{toID}', [AdminController::class, 'approve_co_admin_request']); 

        

// SABBATH

    Route::get('/sabbath-offerings/summary', [AdminController::class, 'sabbath_offering_dashboard']);
    Route::get('/sabbath-offerings/records', [AdminController::class, 'sabbath_offering'])->name('sabbath.offering');
    Route::get('/sabbath-offerings/pending', [AdminController::class, 'sabbath_offering_pending']); 

    Route::post('/sabbath_offering', [AdminController::class, 'sabbath_offering']);
    Route::get('/sabbath_view/{toID}', [AdminController::class, 'sabbath_view']);
    Route::get('/sabbath_edit/{toID}', [AdminController::class, 'sabbath_edit']);
    Route::post('/sabbath_update/{toID}', [AdminController::class,'sabbath_update']);
    Route::get('/sabbath_revision_history/{toID}', [AdminController::class,'sabbath_revision_history']);
    Route::post('delete_sabbath/{toID}', [AdminController::class,'delete_sabbath']);
    Route::post('retrieve_sabbath/{toID}', [AdminController::class,'retrieve_sabbath']);

    
// CHURCH LIST

    Route::get('/church_members', [AdminController::class, 'ad_register']);
    Route::post('/search/member', [AdminController::class, 'ad_register']);
    Route::post('/church_members', [AdminController::class, 'add_new'])->name('ad.register');
    Route::get('/edit/{uID}', [AdminController::class, 'edit_officer']);
    Route::post('/update/{uID}', [AdminController::class, 'update_officer']);
    Route::get('/edit_profile', [AdminController::class, 'ad_edit']);
    Route::post('/edit_profile', [AdminController::class,'update_image'])->name('update_image');
    Route::put('/edit_profile/{uID}', [AdminController::class, 'edit_profile']);


   
// DISBURSEMENT
    Route::get('disbursement/summary', [AdminController::class, 'disbursement_dashboard']);







   
    Route::post('/add_new_tithes', [HomeController::class, 'add_new_tithes']);


    Route::get('/pending_request', [HomeController::class, 'pending_member_request'])->name('home');



    Route::get('/search', [AdminController::class, 'create']);
    Route::post('/search', [AdminController::class, 'create']);


// ADMIN


Route::post('/admin_add_church_member', [AdminController::class, 'add_church_member'])->name('admin_add.church.member');

Route::post('/admin_add_tithes', [AdminController::class, 'add_tithes'])->name('admin_add.new.tithes');

Route::get('/tithe_edit/{toID}', [AdminController::class, 'tithe_edit']);

Route::post('/update_tithes/{toID}', [AdminController::class,'update_tithes'])->name('tithes');

Route::post('/admin_add_offerings', [AdminController::class, 'add_offer'])->name('admin_add.new.offerings');

Route::post('/admin_add_disbursement', [AdminController::class, 'add_disbursement'])->name('admin_add.new.disbursement');

Route::post('/admin_update_offer/{toID}', [AdminController::class,'update_offer'])->name('admin_update.offer');



Route::get('/ad_layoutPDF', [AdminController::class, 'ad_layoutPDF']);

Route::post('/activate/{uID}', [AdminController::class, 'activate_officer']);

Route::post('/deactivate/{uID}', [AdminController::class, 'deactivate_officer']);

Route::post('delete_tithe/{toID}', [AdminController::class,'delete_tithe']);


Route::post('/retrieve_tithe/{toID}', [AdminController::class,'retrieve_tithe'])->name('retrieve.tithe');

Route::put('/admin_delete_offer/{toID}', [AdminController::class,'delete_offer']);

// Route::put('/retrieve_offer/{toID}', [AdminController::class,'retrieve_offer'])->name('retrieve.offer');

Route::post('/retrieve_disbursement/{dsID}', [AdminController::class,'retrieve_disbursement']);


Route::get('/revision_history/{toID}', [AdminController::class,'revision_history']);
//<<<<<< DAN POGI
Route::get('/revision_history_disbursement/{dsID}', [OfficerController::class,'revision_history_disbursement']);

Route::get('/member_tithes/{uID}', [AdminController::class,'member_tithes']);

Route::post('/member_tithes/{uID}', [AdminController::class, 'member_tithes']);

Route::get('/deleted_tithes_offerings', [AdminController::class,'deleted_tithes_offerings']);


Route::put('/approve_member_request/{toID}', [AdminController::class, 'approve_member_request']); 

Route::put('/decline_member_request/{toID}', [AdminController::class, 'decline_member_request']); 

Route::post('/retrieve_member_request/{toID}', [AdminController::class, 'retrieve_member_request']); 

Route::post('/update_member_info/{uID}', [AdminController::class, 'update_member_info']); 


Route::get('/member_setting', [AdminController::class, 'get_member_details']); 

Route::post('/update_member_details/{uID}', [AdminController::class, 'update_member_details']); 



Route::get('/email_status/{uID}', [AdminController::class, 'email_status']); 

Route::put('/delete_online_payment/{oID}', [AdminController::class, 'delete_online_payment']); 

Route::get('/disbursement_report', [AdminController::class, 'disbursement_report']); 

Route::post('/disbursement_report', [AdminController::class, 'disbursement_report']); 

Route::get('/storing', [AdminController::class, 'ch_add_disbursement']);

Route::post('/storings', [AdminController::class, 'store_new'])->name('add.disbursement');

Route::get('/disbursement_view/{dsID}', [AdminController::class, 'disbursement_view']);

Route::get('/disbursement_edit/{dsID}', [AdminController::class, 'disbursement_edit']);

Route::get('/edits/{dsID}', [AdminController::class, 'ch_edit_disbursement']);

Route::post('/updates/{dsID}', [AdminController::class, 'update_disbursement']);

Route::post('/editing/{dsID}', [AdminController::class,'ch_updating_image']);

Route::post('/remove_disbursement/{dsID}', [AdminController::class,'remove_disbursement']);

Route::get('/member_view_notification/{nID}', [AdminController::class, 'member_view_notification']); 


Route::post('/add_offering', [AdminController::class, 'add_offering']); 

Route::put('/approve_sabbath_offer/{toID}', [AdminController::class, 'approve_sabbath_offer']); 

Route::put('/decline_sabbath_offer/{toID}', [AdminController::class, 'decline_sabbath_offer']); 

Route::get('/sabbath_offering_for_approval', [AdminController::class, 'sabbath_offering_for_approval']); 

Route::post('/retrieve_sabbath_offering_request/{toID}', [AdminController::class, 'retrieve_sabbath_offering_request']); 
 
Route::get('/disbursement_pending_list', [AdminController::class, 'disbursement_pending_list']); 

// view and edit





Route::get('/view_notification/{nID}', [AdminController::class, 'view_notification']);
Route::post('/remove_notification/{nID}', [AdminController::class, 'remove_notification']);
Route::post('/mark_as_read/{nID}', [AdminController::class, 'mark_as_read']);


Route::get('/offering_view/{toID}', [OfficerController::class, 'offering_view']);

Route::get('/offering_edit/{toID}', [OfficerController::class, 'offering_edit']);


Route::get('/ad_setting', [AdminController::class, 'ad_setting']);

Route::get('/ad_change_pass', [AdminController::class, 'ad_change_pass']);




});

});
