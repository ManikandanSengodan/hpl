<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\CategoryController;

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

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
  
  	//Admin
   Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
    Route::post('users', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
    Route::get('users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'show'])->name('users.show');
    Route::get('users/{user}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');
    Route::get('change-password', '\App\Http\Controllers\Admin\UserController@showChangePasswordForm');
//    Route::get('users/change-password', [\App\Http\Controllers\Admin\UserController::class, 'showChangePasswordForm']);
    Route::post('users/change-password', [\App\Http\Controllers\Admin\UserController::class, 'changePassword'])->name('changePassword');
    
    // Customers
    Route::get('customers', [\App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('customer.index');
    Route::get('customers/create', [\App\Http\Controllers\Admin\CustomerController::class, 'create'])->name('customer.create');
    Route::post('customers', [\App\Http\Controllers\Admin\CustomerController::class, 'store'])->name('customer.store');
    Route::get('customers/{buyer}/edit', [\App\Http\Controllers\Admin\CustomerController::class, 'edit'])->name('customer.edit');
    Route::put('customers/{buyer}', [\App\Http\Controllers\Admin\CustomerController::class, 'update'])->name('customer.update');
    Route::get('customers/{buyer}', [\App\Http\Controllers\Admin\CustomerController::class, 'show'])->name('customer.show');
    Route::delete('customers/{buyer}', [\App\Http\Controllers\Admin\CustomerController::class, 'destroy'])->name('customer.destroy');
    Route::get('viewprofile', [\App\Http\Controllers\Admin\CustomerController::class, 'viewprofile'])->name('customer.viewprofile');

    //MOU
    Route::get('/moulist', [\App\Http\Controllers\Admin\MouController::class, 'index'])->name('mous.index');
    Route::get('mous/create', [\App\Http\Controllers\Admin\MouController::class, 'create'])->name('mous.create');
    Route::post('mous/store', [\App\Http\Controllers\Admin\MouController::class, 'store'])->name('mous.store');
    Route::get('mous/{mou}/edit', [\App\Http\Controllers\Admin\MouController::class, 'edit'])->name('mous.edit');
    Route::put('mous/{mou}', [\App\Http\Controllers\Admin\MouController::class, 'update'])->name('mous.update');
    Route::get('mous/{mou}', [\App\Http\Controllers\Admin\MouController::class, 'show'])->name('mous.show');
    Route::delete('mous/{mou}', [\App\Http\Controllers\Admin\MouController::class, 'destroy'])->name('mous.destroy');
    
    // Customer Mou
    Route::get('customer/mou', [\App\Http\Controllers\Admin\MouCustomerController::class, 'index'])->name('customermou.index');
    Route::get('customer/mou/{mou}', [\App\Http\Controllers\Admin\MouCustomerController::class, 'show'])->name('customermou.show');
    Route::put('customer/mou/upload/{mou}', [\App\Http\Controllers\Admin\MouCustomerController::class, 'upload'])->name('customermou.upload');
    Route::put('exportpdf/{mou}', [\App\Http\Controllers\Admin\MouCustomerController::class, 'downloadPdf'])->name('customermou.downloadPdf');

   //Incentive Masters
    Route::get('incentive/{mou_id}', [\App\Http\Controllers\Admin\MouController::class, 'incentive'])->name('incentive.view');
    Route::post('/calculate', [\App\Http\Controllers\Admin\MouController::class, 'calculate'])->name('incentive.calculate');
    Route::get('details/{mou_id}', [\App\Http\Controllers\Admin\MouController::class, 'incentiveDetails'])->name('incentive.details');
  

    Route::get('roles',[RoleController::class,'index'])->name('role.index');
    Route::get('roles/create',[RoleController::class,'create'])->name('role.create');
    Route::post('roles/store',[RoleController::class,'store'])->name('role.store');
    Route::get('roles/{role}',[RoleController::class,'show'])->name('role.show');
    Route::get('roles/{role}/edit',[RoleController::class,'edit'])->name('role.edit');
    Route::put('roles/{role}',[RoleController::class,'update'])->name('role.update');
    Route::delete('roles/{role}',[RoleController::class,'destroy'])->name('role.destroy');

  Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
  Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

  Route::get('company-profile', [\App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('company-profile.index');
  Route::get('company-profile/create', [\App\Http\Controllers\Admin\ProfileController::class, 'create'])->name('company-profile.create');
  Route::post('company-profile', [\App\Http\Controllers\Admin\ProfileController::class, 'store'])->name('company-profile.store');
  Route::get('company-profile/{profile}/edit', [\App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('company-profile.edit');
  Route::put('company-profile/{profile}', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('company-profile.update');
  Route::get('company-profile/{profile}', [\App\Http\Controllers\Admin\ProfileController::class, 'show'])->name('company-profile.show');
  Route::delete('company-profile/{profile}', [\App\Http\Controllers\Admin\ProfileController::class, 'destroy'])->name('company-profile.destroy');
});
