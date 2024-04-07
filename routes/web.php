<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Faker\Guesser\Name;
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

// Route::get('/', function () {
//     return view('user_index');
// })->name('home');

Route::controller(HomeController::class)->group(function(){
    Route::get('/', 'index')->name('home');
    Route::get('/productInfo/{id:product_code}', 'productInfo')->name('productInfo');
    Route::get('/productList', 'productList')->name('product_list');
});

Route::controller(AuthenticationController::class)->group(function (){
    Route::get('/register', 'register')->name('register');  //to go register view
    Route::post('/register', 'storeUser')->name('store_user');  //to register user data
    Route::get('/login', 'login')->name('login')->name('login');    //to go login view
    Route::post('/login', 'authenticate')->name('authenticate');    //for login user

    Route::get('/forgot-password', 'forgotPassword')->name('forgot_password');  //to go forgot password view
    Route::post('forgot-passoword', 'sendForgotPasswordEmail')->name('send_forgot_password_email');

    Route::get('/logout', 'logout')->name('logout');
});

Route::resource('cart', CartController::class);
Route::get('store-order', [CartController::class, 'storeOrder'])->name('store_order');

Route::controller(UserController::class)->group(function (){
    Route::get('/profile', 'userProfile')->name('user_profile');
    Route::put('/profile', 'userProfileUpdate')->name('user_profile_update');
    Route::post('/user-image-update', 'userImageUpdate')->name('user_image_update');    //file method ko lagi post nai chaincha
});

Route::group(['prefix' => '/admin', 'middleware' => ['checkRoles']], function () {
    Route::controller(AdminController::class)->group(function (){
        Route::get('/', 'index')->name('admin_home');
        Route::get('/user-list', 'usersList')->name('admin_user_list');
        Route::get('/edit-user/{id}', 'editUsers')->name('admin-edit-user');
        Route::put('/update-user/{id}', 'updateUser')->name('admin-update-user');
        Route::post('/admin-image-update/{id}', 'adminImageUpdate')->name('admin_image_update');
        Route::get('/register-user', 'adminRegisterUserProfile')->name('admin_register_user'); //to show register page
        Route::post('/register-user', 'adminRegisterUserProfileData')->name('admin_register_user_data');    //data register grna
        Route::get('/change-user-status/{id}/{status?}', 'changeUserStatus')->name('admin_change_user_status');
                                           //status is optional
    });

    //resource controller
    Route::resource('brand', BrandsController::class);
    Route::controller(BrandsController::class)->group(function (){
        Route::post('/change-brand-image/{id}', 'changeBrandImage')->name('admin_brand_image_change');
        Route::get('/change-brand-status/{id}/{status?}', 'changeBrandStatus')->name('admin_change_brand_status');
    });

    Route::resource('product', ProductController::class);
    Route::post('product-image-update/{product}', [ProductController::class, 'productImageUpdate'])->name('admin_product_image_change');
});
