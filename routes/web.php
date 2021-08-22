<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\DatalkpdController;

// use Illuminate\Support\Facades\Auth;
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
Route::get('/', [App\Http\Controllers\SliderController::class, 'sliderLogin']);
Route::middleware(['middleware'=>'PreventBackHistory'])->group(function () {
    Auth::routes();
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'admin', 'middleware'=>'isAdmin','auth','PreventBackHistory'], function () {
    // get profile
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('dashboard', [AdminController::class, 'userOnlineStatus'])->name('admin.dashboard');
        // Route::get('/status', 'UserController@userOnlineStatus');
    // Post PROFILE
    Route::post('update-profile-info', [AdminController::class, 'updateInfo'])->name('adminUpdateInfo');
    Route::post('change-password', [AdminController::class, 'changePassword'])->name('adminChangePassword');
    Route::post('change-profile-picture', [AdminController::class, 'updatePicture'])->name('adminPictureUpdate');

    // END
    // Setting
    Route::resource('/settings', AdminController::class);

    Route::get('settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::get('status', [AdminController::class, 'status'])->name('admin.status');
    Route::get('dashboard', [AdminController::class, 'totalUsers'])->name('admin.dashboard');
    // Route::post('updateWeb', [AdminController::class, 'updateWeb'])->name('adminUpdateWeb');

    // getSetting

    Route::post('crop', [AdminController::class, 'crop'])->name('crop');
    // Forums
    Route::resource('/forum', ForumController::class);
    Route::get('/forum/read/{slug}', [ForumController::class, 'show'])->name('forumslug');
    Route::post('/comment/addComment/{forum}' ,[CommentController::class, 'addComment'])->name('addComment');
    Route::post('/comment/replyComment/{comment}' ,[CommentController::class, 'replyComment'])->name('replyComment');
    // Route::get('/forum/create', [ForumController::class, 'createFile']);
    Route::get('/populars', [ForumController::class, 'populars'])->name('populars');
    Route::resource('/tag', TagController::class);
    Route::get('/tag/read/{slug}', [TagController::class, 'show'])->name('tagslug');

    Route::get('/dashboard', [TagController::class, 'showTag'])->name('admin.dashboard');
    // Users
    Route::resource('/datausers', ProfileController::class);
    Route::post('/datausers', [ProfileController::class, 'update_password'])->name('update_password');
    // Route::get('/status', 'UserController@userOnlineStatus');
    Route::resource('sliders', SliderController::class);

    // LKPD
    Route::resource('datalkpd', DatalkpdController::class);

    Route::get('/datalkpd/read/{slug}', [DatalkpdController::class, 'show'])->name('datalkpdslug');



});

Route::group(['prefix'=>'user', 'middleware'=>'isUser','auth', 'PreventBackHistory'], function () {
    Route::get('dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('change-password', [UserController::class, 'changePassword'])->name('userChangePassword');
    // Route::post('change-password', [AdminController::class, 'changePassword'])->name('adminChangePassword');
    Route::post('update-profile-user', [UserController::class, 'updateUser'])->name('userUpdateInfo');
    Route::post('change-profile-picture', [UserController::class, 'updatePicture'])->name('userPictureUpdate');
    Route::get('settings', [UserController::class, 'settings'])->name('user.settings');


    Route::get('datalkpd-read', [DatalkpdController::class, 'datalkpdread'])->name('user.datalkpdread');
    Route::get('/datalkpd-read-show/read/{slug}', [DatalkpdController::class, 'datalkpdreadhow'])->name('datalkpdreadhow');

    Route::get('forumread', [ForumController::class, 'forumread'])->name('user.forumread');
    // Route::get('forumread', [ForumController::class, 'forumread'])->name('user.forumread');
        // Forums
    // Route::get('/forumread', ForumController::class);
    Route::get('/forumread/read/{slug}', [ForumController::class, 'forumshow'])->name('forumshowslug');
    Route::post('/comment/addComment/{forum}' ,[CommentController::class, 'addComment'])->name('addComment');
    Route::post('/comment/replyComment/{comment}' ,[CommentController::class, 'replyComment'])->name('replyComment');
    // Route::get('/forum/create', [ForumController::class, 'createFile']);
    Route::get('/populars', [ForumController::class, 'readpopulars'])->name('user.populars');
    // Route::get('/tag', [TagController::class, 'showTagUser'])->name('showTagUser');
    Route::get('/dashboard', [TagController::class, 'showTagUser'])->name('user.dashboard');

});
