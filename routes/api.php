<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\CaseController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SyncDataController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Admin test

//User
Route::post('add_user_admin',[UserController::class,'add_user_admin']);
Route::post('search_user_admin',[UserController::class,'search_user_admin']);
Route::post('delete_user_admin',[UserController::class,'delete_user_admin']);
Route::get('all_user_admin',[UserController::class,'all_user_admin']);
//Case
Route::post('add_case_admin',[CaseController::class,'add_case_admin']);
Route::post('delete_case_user',[CaseController::class,'delete_case_user']);
Route::post('status_admin',[CaseController::class,'status_admin']);
Route::get('all_cases_admin',[CaseController::class,'show_cases_admin']);
Route::post('show_case_details_admin',[CaseController::class,'show_case_details_admin']);
Route::post('search_case_admin',[CaseController::class,'search_case_admin']);
//Comment
Route::post('add_comment_admin',[CommentController::class,'add_comment_admin']);
Route::post('all_comments_user_admin',[CommentController::class,'all_comments_user_admin']);
Route::post('delete_comment_admin',[CommentController::class,'delete_comment_admin']);
Route::get('all_comments_admin',[CommentController::class,'all_comments_admin']);
//Bill
Route::post('add_bill',[BillController::class,'add_bill']);
Route::post('update_bill',[BillController::class,'update_bill']);
Route::post('all_bills_user',[BillController::class,'all_bills_user']);
Route::post('search_bills_user',[BillController::class,'search_bills_user']);




//User Api

Route::post('register_user',[UserController::class,'register']);
Route::post('login_user',[UserController::class,'login']);
Route::post('email',[EmailVerificationController::class,'email_verfication']);
Route::post('forgot_password',[ForgetPasswordController::class,'forgotPassword']);
Route::post('reset_password',[ResetPasswordController::class,'ResetPassword']);

Route::middleware(['auth:sanctum','verified'])->group(function(){
    Route::get('profile_user',[UserController::class,'profile']);
    Route::get('logout',[UserController::class,'logout']);
    Route::get('update_profile',[UserController::class,'update_profile']);
});

Route::middleware(['auth:sanctum'])->group(function(){

    //Case
    Route::post('/add_case', [CaseController::class, 'add_case']);
    Route::post('/add_teeth', [CaseController::class, 'add_teeth']);
    Route::post('delete_case',[CaseController::class,'delete_case']);    
    Route::get('all_cases', [CaseController::class,'all_cases']);
    Route::post('case_details',[CaseController::class,'case_details']);
    Route::post('search_case',[CaseController::class,'search_case']);
    Route::post('rate',[UserController::class,'rate']);
    Route::post('confirm_delivery',[UserController::class,'confirm_delivery']); 
    //Comment
    Route::post('add_comment',[CommentController::class,'add_comment']);
    Route::post('update_comment',[CommentController::class,'update_comment']);
    Route::post('delete_comment',[CommentController::class,'delete_comment']);
    Route::get('all_comments',[CommentController::class,'all_comments']);
    //Bill
    Route::get('all_bills',[BillController::class,'all_bills']);
    Route::post('search_bills',[BillController::class,'search_bills']);
    Route::post('details_bill',[BillController::class,'details_bill']);
});
Route::post('add_bill',[BillController::class,'add_bill']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
