<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserWebController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\PusherController;
Route::match(['get', 'post'],'/history/{id}', [UserWebController::class, 'history']);
Route::match(['get', 'post'],'/checkleave', [PusherController::class, 'checkleave']);
Route::match(['get', 'post'],'/leave', [PusherController::class, 'leave']);
Route::match(['get', 'post'],'/checkotheruser', [PusherController::class, 'checkotheruser']);
Route::match(['get', 'post'],'/create', [PusherController::class, 'create']);
Route::match(['get', 'post'],'/broadcast', [PusherController::class, 'broadcast']);
Route::match(['get', 'post'],'/chat', [PusherController::class, 'index']);
Route::match(['get', 'post'],'/receive', [PusherController::class, 'receive']);
Route::match(['get', 'post'],'/logout', [UserWebController::class, 'logout']);
Route::match(['get', 'post'],'/wall/{id}', [QuestionController::class, 'wall']);
Route::match(['get', 'post'],'/forum/{id}', [QuestionController::class, 'questionforum']);
Route::match(['get', 'post'],'/addanswerforum', [QuestionController::class, 'answerforum']);
Route::match(['get', 'post'],'/questionforumcheck', [QuestionController::class, 'questionforumcheck']);
Route::match(['get', 'post'],'/forum/{type}/{id}', [QuestionController::class, 'forum']);
Route::match(['get', 'post'],'/logincheck', [UserWebController::class, 'login']);
Route::match(['get', 'post'],'/registercheck', [UserWebController::class, 'register']);
Route::match(['get', 'post'],'/forgetcheck', [UserWebController::class, 'forget']);
// Route::match(['get', 'post'],'/alluser', [UserWebController::class, 'alluser']);
Route::match(['get', 'post'],'/addquestion', [QuestionController::class, 'addquestion']);
Route::match(['get', 'post'],'/answer', [AnswerController::class, 'answer']);
Route::match(['get', 'post'],'/editanswer', [AnswerController::class, 'editanswer']);
Route::match(['get', 'post'],'/deletequestion', [AnswerController::class, 'deletequestion']);

Route::match(['get'],'/welcome', [UserWebController::class, 'getIp']);
Route::match(['get', 'post'],'/updatenickname', [UserWebController::class, 'updatenickname']);
Route::match(['get', 'post'],'/updatedescription', [UserWebController::class, 'updatedescription']);
Route::match(['get', 'post'],'/updatepassword', [UserWebController::class, 'updatepassword']);
Route::match(['get', 'post'],'/addtimemail', [UserWebController::class, 'addtimemail']);
Route::match(['get', 'post'],'/checkemail', [UserWebController::class, 'checkemail']);
Route::match(['get', 'post'],'/payment', [UserWebController::class, 'payment']);
Route::match(['get', 'post'],'/paymentcheck', [UserWebController::class, 'paymentcheck']);
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
Route::get('/history', function () {
    return view('history');
});
Route::get('/timemail', function () {
    return view('timemail');
});
Route::get('/addquestionforum', function () {
    return view('forum.addquestion');
});
Route::get('/alluser', function () {
    return view('UserWeb.allprofile');
});
Route::get('addquestion', function () {
    return view('UserWeb.addquestion');
});
Route::get('/404', function () {
    return view('error'); // Thay 'errors.404' bằng tên view của trang bạn muốn hiển thị khi gặp lỗi 404.
})->name('404');
Route::get('update', function () {
    return view('UserWeb.update');
});
Route::get('/', function () {
    return view('home1');
});
Route::get('login', function () {
    return view('login');
});
Route::get('register', function () {
    return view('register');
});
Route::get('profile', function () {
    return view('UserWeb.profile');
});
Route::get('forget', function () {
    return view('forget');
});
Route::get('help', function () {
    return view('help');
});

