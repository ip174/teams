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

Auth::routes();

/*
 * Social login
 */
//Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
//Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/', 'HomeController@index');
Route::get('/how-it-works', 'HomeController@howItWorks');
Route::get('/help-centre', 'HomeController@helpCentre');
Route::get('/service-fee', 'HomeController@serviceFee');
Route::get('/contact-us', 'HomeController@contactUs');
Route::get('/community', 'HomeController@Community');
Route::get('/dispute', 'HomeController@Dispute');

Route::get('/increse-your-views', 'UserController@increseYourViews');

Route::get('logout', function(){
	Auth::logout();
	return redirect('/login');
});

Route::get('registration-confirm', 'Auth\RegisterController@registration_confirm');
Route::get('/user/verify-account/{id}/{time}', 'Auth\RegisterController@verify_account');
Route::get('/reset-password/{id}', 'Auth\RegisterController@reset_password');
Route::post('/reset-password/{id}', 'Auth\RegisterController@reset_password');

Route::get('/my-account', 'UserController@myAccount')->name('my-account');
Route::post('/user/change-password', 'UserController@changePassword')->name('change-password-action');
Route::post('/customer/save-address', 'UserController@saveCustomerAddress')->name('save-customer-address');
Route::get('/user/dashboard', 'UserController@user_dashboard');
Route::get('/user/my-profile', 'UserController@userProfile');
Route::post('/user/portfolio-upload', 'UserController@upload_portfolio');
Route::post('/user/get-portfolio', 'UserController@getPortfolioById');
Route::post('/user/edit-portfolio', 'UserController@editPortfolio');
Route::post('/user/portfolio-action', 'UserController@action_against_portfolio');
Route::get('/user/edit-profile', 'UserController@edit_profile');
Route::post('/user/edit-profile', 'UserController@edit_profile');
Route::get('/user/upload-profile-picture', 'UserController@upload_profile_picture');
Route::post('/user/upload-profile-picture', 'UserController@upload_profile_picture');
Route::post('/user/change-profile-picture', 'UserController@uploadProfilePicture');
Route::post('/user/hirer-subscription', 'HomeController@hirerSubscription');
Route::post('user/set-online-offline', 'UserController@setOnlineOffline');
Route::post('/user/get-a-quote', 'UserController@getAQuote');


Route::get('/freelancers/search-freelancers', 'FreelancerController@find_freelancers');
Route::post('/freelancers/request-freelancers', 'FreelancerController@request_freelancer');
Route::get('/freelancers/freelancer-details/{name}/{id}', 'FreelancerController@freelancerDetails');

Route::get('/jobs/post-jobs', 'JobsController@postNewJob');
//Route::get('/jobs/post-jobs/{type}', 'JobsController@postNewJob');
Route::post('/jobs/post-jobs', 'JobsController@postNewJob');
Route::get('/jobs/my-jobs-list', 'JobsController@jobsListByUser');
Route::post('/jobs/my-jobs-list/{id}', 'JobsController@jobsListByUser');
Route::get('/jobs/edit-posted-jobs/{id}', 'JobsController@editPostedJob');
Route::post('/jobs/update-posted-jobs', 'JobsController@updatePostedJob');
Route::get('/jobs/search-jobs', 'JobsController@jobsSearchListByUser');
Route::post('/jobs/search-jobs', 'JobsController@jobsSearchListByUser');
Route::get('/jobs/send-proposal/{job_id}', 'JobsController@sendJobProposal');
Route::post('/jobs/send-proposal/{job_id}', 'JobsController@sendJobProposal');
Route::get('/jobs/view-project/{job_id}', 'JobsController@viewProjectProposals');
Route::post('/jobs/view-proposal', 'JobsController@viewProjectProposalById');
Route::post('/jobs/shortlist-proposal', 'JobsController@shortlistProjectProposalById');
Route::post('/jobs/accept-proposal', 'JobsController@acceptProjectProposalById');
Route::post('/jobs/get-untouched-proposals', 'JobsController@getUntouchedProposals');
Route::post('/jobs/get-shortlisted-proposals', 'JobsController@getShortlistedProposals');
Route::post('/jobs/add-jobs-review', 'JobsController@addJobsReview');

Route::post('/jobs/pay-now', 'JobsController@payNow')->name('pay-now');
Route::get('/jobs/stripe-form/{txn}', 'JobsController@stripeForm')->name('stripe-form');
Route::post('/jobs/stripe-payment/{txn}', 'JobsController@stripePayment')->name('stripe-payment');

Route::get('/jobs/my-workstream', 'JobsController@FreelancerWorkstream');
Route::post('/jobs/my-workstream/{status}', 'JobsController@FreelancerWorkstream');

Route::get('/chat/job-chat-box/{job_id?}/{fetch_type?}', 'ChatController@JobChatBox')->name('/chat/job-chat-box');
Route::get('/chat/job-chat-mailbox/{job_id?}/{fetch_type?}', 'ChatController@JobChatMailbox');
Route::post('/chat/get-chat-messages', 'ChatController@getChatMessages');
Route::post('/chat/send-chat-messages', 'ChatController@sendChatMessages');
Route::post('/chat/send-chat-email', 'ChatController@sendChatEmail');
Route::post('/chat/set-as-starred-messages', 'ChatController@setAsStarredMessages');
Route::post('/chat/chatdelete-messages', 'ChatController@chatDeleteMessages');
Route::post('/chat/get-message-notification', 'ChatController@getMessageNotification');
Route::post('/chat/get-profile-notification', 'ChatController@getProfileNotification');

Route::get('/jobs/preview-job/{job_id?}', 'JobsController@previewJobProposal');
Route::get('/jobs/job-assets/{job_id?}/{parent_id?}', 'JobsController@JobAssets');
Route::post('/jobs/create-asset-folder/{job_id?}/{parent_id?}', 'JobsController@createAssetFolder');
Route::post('/jobs/create-asset-file/{job_id?}/{parent_id?}', 'JobsController@createAssetFile');
Route::get('/jobs/download-asset-file/{asset_id}', 'JobsController@downloadAssetFile');

Route::get('/workflow/view-workflow/{job_id?}', 'WorkflowController@viewWorkflow');
Route::post('/workflow/assign-task-to-user', 'WorkflowController@assignTaskToUser');
Route::get('/workflow/view-task/{job_id?}/{task_id?}', 'WorkflowController@viewTask');
Route::get('/workflow/edit-task/{job_id?}/{task_id?}', 'WorkflowController@editTask');
Route::post('/workflow/update-task', 'WorkflowController@updateTaskToUser');
Route::post('/workflow/delete-attachment', 'WorkflowController@deleteAttachment');

Route::get('/payments/view-payments/{job_id?}', 'PaymentsController@viewPayments');
Route::post('/payments/release-payments', 'PaymentsController@releasePayments');
Route::get('/payments/payments-overview', 'PaymentsController@paymentsOverview');
Route::post('/payments/calculate-my-earnings', 'PaymentsController@calculateMyEarnings');
Route::post('/payments/money-withdraw-request', 'PaymentsController@moneyWithdrawRequest');
Route::post('/payments/create-invoice', 'PaymentsController@createInvoice');
//Route::post('/payments/deposite-funds', 'PaymentsController@depositeFunds');
Route::post('/payments/pay-now', 'PaymentsController@payNow');
Route::get('/payments/stripe-form/{txn}/{amount}', 'PaymentsController@stripeForm');
Route::post('/payments/stripe-payment/{txn}/{amount}', 'PaymentsController@stripePayment');
Route::get('/payments/statements', 'PaymentsController@viewStatements');
Route::get('/payments/transaction-history', 'PaymentsController@viewTransactionHistory');
Route::get('/payments/download-invoice', 'PaymentsController@exportInvoice');
Route::get('/payments/download-statements', 'PaymentsController@exportStatement');
Route::get('/payments/download-transaction-details', 'PaymentsController@exportTransactionDetails');

Route::get('/invoice/view-invoice', 'InvoiceController@viewInvoice');
Route::get('/invoice/search-invoice', 'InvoiceController@searchInvoice');
Route::post('/invoice/pay-invoice', 'InvoiceController@payInvoice');
Route::get('/invoice/stripe-form/{txn}/{amount}', 'InvoiceController@stripeForm');
Route::post('/invoice/stripe-payment/{txn}/{amount}', 'InvoiceController@stripePayment');
Route::get('/invoice/download-invoice', 'InvoiceController@exportInvoice');

Route::get('/settings/view-project-settings/{job_id?}', 'SettingsController@viewProjectSettings');
Route::post('/settings/save-project-settings', 'SettingsController@saveProjectSettings');
Route::get('/settings/user-general-settings', 'SettingsController@UserGeneralSettings');
Route::post('/settings/change-password', 'SettingsController@changePassword');
Route::post('/settings/change-security-question', 'SettingsController@changeSecurityQuestion');
Route::post('/settings/change-availability', 'SettingsController@changeAvailability');
Route::post('/settings/edit-profile', 'SettingsController@updateUser');
Route::post('/settings/change-notification-settings', 'SettingsController@changeNotificationSettings');
Route::post('/settings/change-need-update-settings', 'SettingsController@changeUpdateNeedsSettings');
Route::post('/settings/change-nda-settings', 'SettingsController@changeNdaSettings');
Route::post('/settings/upload-profile-signature', 'SettingsController@uploadProfileSignature');

Route::get('/my-notification', 'NotificationController@usersNotifications');
Route::post('/delete-notification', 'NotificationController@deleteNotification');
Route::post('/delete-bulk-notification', 'NotificationController@deleteBulkNotification');
Route::post('/check-starred-notification', 'NotificationController@starredNotification');

//Added on 03-11-2017
Route::post('/jobs/check-is-need-payment', 'JobsController@checkIsNeedPayment');
Route::get('/jobs/pay-now-for-job-post/{job_id}/{turn_around_time}/{need_to_pay}', 'JobsController@payNowForJobPost');
Route::get('/jobs/stripe-form-for-job-post/{txn}', 'JobsController@stripeFormForJobPost');
Route::post('/jobs/stripe-payment-for-job-post/{txn}', 'JobsController@stripePaymentForJobPost');
Route::post('/settings/check-available-bid-credit', 'SettingsController@checkAvailableBidCredit');

Route::post('/settings/buy-bid-credit', 'SettingsController@buyBidCredit');
Route::get('/settings/deduct-from-wallet-for-bid-purchase/{bid_id}/{creditLimit}/{amount}', 'SettingsController@deductBalanceFromWalletBuyBid');
Route::get('/settings/pay-now-for-bid-purchase/{bid_id}/{creditLimit}/{amount}', 'SettingsController@payNowBuyBid');
Route::get('/settings/stripe-form-for-bid-purchase/{txn}', 'SettingsController@stripeFormBuyBid');
Route::post('/settings/stripe-payment-for-bid-purchase/{txn}', 'SettingsController@stripePaymentBuyBid');


Route::get('/jobs/pay-now-for-send-proposal/{job_id}/{proposal_id}/{need_to_pay}', 'JobsController@payNowForSendProposal');
Route::get('/jobs/stripe-form-for-send-proposal/{txn}', 'JobsController@stripeFormForSendProposal');
Route::post('/jobs/stripe-payment-for-send-proposal/{txn}', 'JobsController@stripePaymentForSendProposal');
Route::get('/jobs/edit-proposal/{proposal_id}', 'JobsController@editJobProposal');
Route::post('/jobs/edit-proposal/{proposal_id}', 'JobsController@editJobProposal');

Route::post('/fetch-sub-category', 'JobsController@fetchSubCategory');



/**
* Define uri prefix for admin control pages..
**/
define('ADMIN_PREFIX', 'admin');

/**
* Admin control routes.
**/
Route::group(['namespace' => 'Admin', 'prefix' => ADMIN_PREFIX], function () {
    Route::get('/', 'Auth\LoginController@showLoginForm');
    Route::post('login', 'Auth\LoginController@login');
    
	Route::get('logout', 'Auth\LoginController@logout');
    Route::post('logout', 'Auth\LoginController@logout');
    
	Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    
	Route::get('register', 'Auth\RegisterController@showRegistrationForm');
    Route::post('register', 'Auth\RegisterController@register');

    Route::get('dashboard', 'AdminController@index');
    
    Route::get('users', 'AdminController@users');
    
    Route::get('categories', 'AdminController@categories');

    Route::get('edit-user', 'AdminController@viewUser');

});



