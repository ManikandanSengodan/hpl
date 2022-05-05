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

    Route::get('sellers', [\App\Http\Controllers\Admin\SellerController::class, 'index'])->name('sellers.index');
    Route::get('sellers/create', [\App\Http\Controllers\Admin\SellerController::class, 'create'])->name('sellers.create');
    Route::post('sellers', [\App\Http\Controllers\Admin\SellerController::class, 'store'])->name('sellers.store');
    Route::get('sellers/{seller}/edit', [\App\Http\Controllers\Admin\SellerController::class, 'edit'])->name('sellers.edit');
    Route::put('sellers/{seller}', [\App\Http\Controllers\Admin\SellerController::class, 'update'])->name('sellers.update');
    Route::get('sellers/{seller}', [\App\Http\Controllers\Admin\SellerController::class, 'show'])->name('sellers.show');
    Route::delete('sellers/{seller}', [\App\Http\Controllers\Admin\SellerController::class, 'destroy'])->name('sellers.destroy');

    Route::get('customers', [\App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('customer.index');
    Route::get('customers/create', [\App\Http\Controllers\Admin\CustomerController::class, 'create'])->name('customer.create');
    Route::post('customers', [\App\Http\Controllers\Admin\CustomerController::class, 'store'])->name('customer.store');
    Route::get('customers/{buyer}/edit', [\App\Http\Controllers\Admin\CustomerController::class, 'edit'])->name('customer.edit');
    Route::put('customers/{buyer}', [\App\Http\Controllers\Admin\CustomerController::class, 'update'])->name('customer.update');
    Route::get('customers/{buyer}', [\App\Http\Controllers\Admin\CustomerController::class, 'show'])->name('customer.show');
    Route::delete('customers/{buyer}', [\App\Http\Controllers\Admin\CustomerController::class, 'destroy'])->name('customer.destroy');
    Route::get('viewprofile', [\App\Http\Controllers\Admin\CustomerController::class, 'viewprofile'])->name('customer.viewprofile');

    Route::get('stafflist/{role}', [\App\Http\Controllers\Admin\StaffController::class, 'index'])->name('staffs.index');
    Route::get('staffs/create', [\App\Http\Controllers\Admin\StaffController::class, 'create'])->name('staffs.create');
    Route::post('staffs', [\App\Http\Controllers\Admin\StaffController::class, 'store'])->name('staffs.store');
    Route::get('staffs/{staff}/edit', [\App\Http\Controllers\Admin\StaffController::class, 'edit'])->name('staffs.edit');
    Route::put('staffs/{staff}', [\App\Http\Controllers\Admin\StaffController::class, 'update'])->name('staffs.update');
    Route::get('staffs/{staff}', [\App\Http\Controllers\Admin\StaffController::class, 'show'])->name('staffs.show');
    Route::delete('staffs/{staff}', [\App\Http\Controllers\Admin\StaffController::class, 'destroy'])->name('staffs.destroy');


    //Designer

    Route::get('designers', [\App\Http\Controllers\Admin\DesignerController::class, 'index'])->name('designers.index');
    Route::get('designers/create', [\App\Http\Controllers\Admin\DesignerController::class, 'create'])->name('designers.create');
    Route::post('designers', [\App\Http\Controllers\Admin\DesignerController::class, 'store'])->name('designers.store');
    Route::get('designers/{designer}/edit', [\App\Http\Controllers\Admin\DesignerController::class, 'edit'])->name('designers.edit');
    Route::put('designers/{designer}', [\App\Http\Controllers\Admin\DesignerController::class, 'update'])->name('designers.update');
    Route::get('designers/{designer}', [\App\Http\Controllers\Admin\DesignerController::class, 'show'])->name('designers.show');
    Route::delete('designers/{designer}', [\App\Http\Controllers\Admin\DesignerController::class, 'destroy'])->name('designers.destroy');

    //MOU
    Route::get('mous', [\App\Http\Controllers\Admin\MouController::class, 'index'])->name('mous.index');
    Route::get('mous/create', [\App\Http\Controllers\Admin\MouController::class, 'create'])->name('mous.create');
    Route::post('mous', [\App\Http\Controllers\Admin\MouController::class, 'store'])->name('mous.store');
    Route::get('mous/{mou}/edit', [\App\Http\Controllers\Admin\MouController::class, 'edit'])->name('mous.edit');
    Route::put('mous/{mou}', [\App\Http\Controllers\Admin\MouController::class, 'update'])->name('mous.update');
    Route::get('mous/{mou}', [\App\Http\Controllers\Admin\MouController::class, 'show'])->name('mous.show');
    Route::delete('mous/{mou}', [\App\Http\Controllers\Admin\MouController::class, 'destroy'])->name('mous.destroy');



    //Warp Masters

    Route::get('warps', [\App\Http\Controllers\Admin\WarpController::class, 'index'])->name('warps.index');
    Route::get('warps/create', [\App\Http\Controllers\Admin\WarpController::class, 'create'])->name('warps.create');
    Route::post('warps', [\App\Http\Controllers\Admin\WarpController::class, 'store'])->name('warps.store');
    Route::get('warps/{warp}/edit', [\App\Http\Controllers\Admin\WarpController::class, 'edit'])->name('warps.edit');
    Route::put('warps/{warp}', [\App\Http\Controllers\Admin\WarpController::class, 'update'])->name('warps.update');
    Route::get('warps/{warp}', [\App\Http\Controllers\Admin\WarpController::class, 'show'])->name('warps.show');
    Route::delete('warps/{warp}', [\App\Http\Controllers\Admin\WarpController::class, 'destroy'])->name('warps.destroy');
 

    //wovenqualitys

    Route::get('wovenqualitys', [\App\Http\Controllers\Admin\wovenQualityController::class, 'index'])->name('wovenqualitys.index');
    Route::get('wovenqualitys/create', [\App\Http\Controllers\Admin\wovenQualityController::class, 'create'])->name('wovenqualitys.create');
    Route::post('wovenqualitys', [\App\Http\Controllers\Admin\wovenQualityController::class, 'store'])->name('wovenqualitys.store');
    Route::get('wovenqualitys/{wovenquality}/edit', [\App\Http\Controllers\Admin\wovenQualityController::class, 'edit'])->name('wovenqualitys.edit');
    Route::put('wovenqualitys/{wovenquality}', [\App\Http\Controllers\Admin\wovenQualityController::class, 'update'])->name('wovenqualitys.update');
    Route::get('wovenqualitys/{wovenquality}', [\App\Http\Controllers\Admin\wovenQualityController::class, 'show'])->name('wovenqualitys.show');
    Route::delete('wovenqualitys/{wovenquality}', [\App\Http\Controllers\Admin\wovenQualityController::class, 'destroy'])->name('wovenqualitys.destroy');


     //finishingmachines

     Route::get('finishingmachines', [\App\Http\Controllers\Admin\FinishingMachinesController::class, 'index'])->name('finishingmachines.index');
     Route::get('finishingmachines/create', [\App\Http\Controllers\Admin\FinishingMachinesController::class, 'create'])->name('finishingmachines.create');
     Route::post('finishingmachines', [\App\Http\Controllers\Admin\FinishingMachinesController::class, 'store'])->name('finishingmachines.store');
     Route::get('finishingmachines/{finishingmachine}/edit', [\App\Http\Controllers\Admin\FinishingMachinesController::class, 'edit'])->name('finishingmachines.edit');
     Route::put('finishingmachines/{finishingmachine}', [\App\Http\Controllers\Admin\FinishingMachinesController::class, 'update'])->name('finishingmachines.update');
     Route::get('finishingmachines/{finishingmachine}', [\App\Http\Controllers\Admin\FinishingMachinesController::class, 'show'])->name('finishingmachines.show');
     Route::delete('finishingmachines/{finishingmachine}', [\App\Http\Controllers\Admin\FinishingMachinesController::class, 'destroy'])->name('finishingmachines.destroy');
 


      //looms

      Route::get('looms', [\App\Http\Controllers\Admin\LoomController::class, 'index'])->name('looms.index');
      Route::get('looms/create', [\App\Http\Controllers\Admin\LoomController::class, 'create'])->name('looms.create');
      Route::post('looms', [\App\Http\Controllers\Admin\LoomController::class, 'store'])->name('looms.store');
      Route::get('looms/{loom}/edit', [\App\Http\Controllers\Admin\LoomController::class, 'edit'])->name('looms.edit');
      Route::put('looms/{loom}', [\App\Http\Controllers\Admin\LoomController::class, 'update'])->name('looms.update');
      Route::get('looms/{loom}', [\App\Http\Controllers\Admin\LoomController::class, 'show'])->name('looms.show');
      Route::delete('looms/{loom}', [\App\Http\Controllers\Admin\LoomController::class, 'destroy'])->name('looms.destroy');
  
  
      //yarns

  Route::get('yarns', [\App\Http\Controllers\Admin\YarnController::class, 'index'])->name('yarns.index');
  Route::get('yarns/create', [\App\Http\Controllers\Admin\YarnController::class, 'create'])->name('yarns.create');
  Route::post('yarns', [\App\Http\Controllers\Admin\YarnController::class, 'store'])->name('yarns.store');
  Route::get('yarns/{yarn}/edit', [\App\Http\Controllers\Admin\YarnController::class, 'edit'])->name('yarns.edit');
  Route::put('yarns/{yarn}', [\App\Http\Controllers\Admin\YarnController::class, 'update'])->name('yarns.update');
  Route::get('yarns/{yarn}', [\App\Http\Controllers\Admin\YarnController::class, 'show'])->name('yarns.show');
  Route::delete('yarns/{yarn}', [\App\Http\Controllers\Admin\YarnController::class, 'destroy'])->name('yarns.destroy');


  //folds

  Route::get('folds', [\App\Http\Controllers\Admin\FoldController::class, 'index'])->name('folds.index');
  Route::get('folds/create', [\App\Http\Controllers\Admin\FoldController::class, 'create'])->name('folds.create');
  Route::post('folds', [\App\Http\Controllers\Admin\FoldController::class, 'store'])->name('folds.store');
  Route::get('folds/{fold}/edit', [\App\Http\Controllers\Admin\FoldController::class, 'edit'])->name('folds.edit');
  Route::put('folds/{fold}', [\App\Http\Controllers\Admin\FoldController::class, 'update'])->name('folds.update');
  Route::get('folds/{fold}', [\App\Http\Controllers\Admin\FoldController::class, 'show'])->name('folds.show');
  Route::delete('folds/{fold}', [\App\Http\Controllers\Admin\FoldController::class, 'destroy'])->name('folds.destroy');

 // printed-folds
  Route::get('printed-folds', [\App\Http\Controllers\Admin\PrintedFoldController::class, 'index'])->name('printed-folds.index');
  Route::get('printed-folds/create', [\App\Http\Controllers\Admin\PrintedFoldController::class, 'create'])->name('printed-folds.create');
  Route::post('printed-folds', [\App\Http\Controllers\Admin\PrintedFoldController::class, 'store'])->name('printed-folds.store');
  Route::get('printed-folds/{fold}/edit', [\App\Http\Controllers\Admin\PrintedFoldController::class, 'edit'])->name('printed-folds.edit');
  Route::put('printed-folds/{fold}', [\App\Http\Controllers\Admin\PrintedFoldController::class, 'update'])->name('printed-folds.update');
  Route::get('printed-folds/{fold}', [\App\Http\Controllers\Admin\PrintedFoldController::class, 'show'])->name('printed-folds.show');
  Route::delete('printed-folds/{fold}', [\App\Http\Controllers\Admin\PrintedFoldController::class, 'destroy'])->name('printed-folds.destroy');


 //woven design card

 Route::get('woven-design-cards', [\App\Http\Controllers\Admin\WovenController::class, 'index'])->name('woven.index');
 Route::get('woven-design-card/create', [\App\Http\Controllers\Admin\WovenController::class, 'create'])->name('woven.create');
 Route::post('woven-design-card', [\App\Http\Controllers\Admin\WovenController::class, 'store'])->name('woven.store');
 Route::get('woven-design-card/{woven}/edit', [\App\Http\Controllers\Admin\WovenController::class, 'edit'])->name('woven.edit');
 Route::put('woven-design-card/{woven}', [\App\Http\Controllers\Admin\WovenController::class, 'update'])->name('woven.update');
 Route::get('woven-design-card/{woven}', [\App\Http\Controllers\Admin\WovenController::class, 'show'])->name('woven.show');
 Route::delete('woven-design-card/{woven}', [\App\Http\Controllers\Admin\WovenController::class, 'destroy'])->name('woven.destroy');
 Route::get('create-purchaseorder/{woven}', [\App\Http\Controllers\Admin\WovenController::class, 'po'])->name('create.purchaseorder');
  
  //create.purchaseorder
  
  

    Route::get('roles',[RoleController::class,'index'])->name('role.index');
    Route::get('roles/create',[RoleController::class,'create'])->name('role.create');
    Route::post('roles/store',[RoleController::class,'store'])->name('role.store');
    Route::get('roles/{role}',[RoleController::class,'show'])->name('role.show');
    Route::get('roles/{role}/edit',[RoleController::class,'edit'])->name('role.edit');
    Route::put('roles/{role}',[RoleController::class,'update'])->name('role.update');
    Route::delete('roles/{role}',[RoleController::class,'destroy'])->name('role.destroy');

    Route::get('categories',[CategoryController::class,'index'])->name('category.index');
    Route::get('categories/create',[CategoryController::class,'create'])->name('category.create');
    Route::post('categories/store',[CategoryController::class,'store'])->name('category.store');
    Route::get('categories/{category}',[CategoryController::class,'show'])->name('category.show');
    Route::get('categories/{category}/edit',[CategoryController::class,'edit'])->name('category.edit');
    Route::put('categories/{category}',[CategoryController::class,'update'])->name('category.update');
    Route::delete('categories/{category}',[CategoryController::class,'destroy'])->name('category.destroy');
  
  
   //woven design card

 Route::get('purchase-order', [\App\Http\Controllers\Admin\PurchaseorderController::class, 'index'])->name('purchaseorder.index');
 Route::get('purchase-order/create', [\App\Http\Controllers\Admin\PurchaseorderController::class, 'create'])->name('purchaseorder.create');
 Route::get('purchase-order/createpo/{woven}', [\App\Http\Controllers\Admin\PurchaseorderController::class, 'createpo'])->name('purchaseorder.createpo');
 Route::post('purchase-order', [\App\Http\Controllers\Admin\PurchaseorderController::class, 'store'])->name('purchaseorder.store');
 Route::get('purchase-order/{woven}/edit', [\App\Http\Controllers\Admin\PurchaseorderController::class, 'edit'])->name('purchaseorder.edit');
 Route::put('purchase-order/{woven}', [\App\Http\Controllers\Admin\PurchaseorderController::class, 'update'])->name('purchaseorder.update');
 Route::get('purchase-order/{woven}', [\App\Http\Controllers\Admin\PurchaseorderController::class, 'show'])->name('purchaseorder.show');
 Route::delete('purchase-order/{woven}', [\App\Http\Controllers\Admin\PurchaseorderController::class, 'destroy'])->name('purchaseorder.destroy');
 
 
  
  
  
  //printed woven design card

 Route::get('printed-design-cards', [\App\Http\Controllers\Admin\PrintedController::class, 'index'])->name('printed.index');
 Route::get('printed-design-card/create', [\App\Http\Controllers\Admin\PrintedController::class, 'create'])->name('printed.create');
 Route::post('printed-design-card', [\App\Http\Controllers\Admin\PrintedController::class, 'store'])->name('printed.store');
 Route::get('printed-design-card/{printed}/edit', [\App\Http\Controllers\Admin\PrintedController::class, 'edit'])->name('printed.edit');
 Route::put('printed-design-card/{printed}', [\App\Http\Controllers\Admin\PrintedController::class, 'update'])->name('printed.update');
 Route::get('printed-design-card/{printed}', [\App\Http\Controllers\Admin\PrintedController::class, 'show'])->name('printed.show');
 Route::delete('printed-design-card/{printed}', [\App\Http\Controllers\Admin\PrintedController::class, 'destroy'])->name('printed.destroy');
 Route::get('create-purchaseorder/{printed}', [\App\Http\Controllers\Admin\PrintedController::class, 'po'])->name('printed.purchaseorder');
  
  //create.purchaseorder
  
  
 Route::get('printed-purchase-order', [\App\Http\Controllers\Admin\PrintedPurchaseOrderController::class, 'index'])->name('printed.purchaseorder.index');
 Route::get('printed-purchase-order/create', [\App\Http\Controllers\Admin\PrintedPurchaseOrderController::class, 'create'])->name('printed.purchaseorder.create');
 Route::get('printed-purchase-order/createpo/{printed}', [\App\Http\Controllers\Admin\PrintedPurchaseOrderController::class, 'createpo'])->name('printed.purchaseorder.createpo');
 Route::post('printed-purchase-order', [\App\Http\Controllers\Admin\PrintedPurchaseOrderController::class, 'store'])->name('printed.purchaseorder.store');
 Route::get('printed-purchase-order/{printed}/edit', [\App\Http\Controllers\Admin\PrintedPurchaseOrderController::class, 'edit'])->name('printed.purchaseorder.edit');
 Route::put('printed-purchase-order/{printed}', [\App\Http\Controllers\Admin\PrintedPurchaseOrderController::class, 'update'])->name('printed.purchaseorder.update');
 Route::get('printed-purchase-order/{printed}', [\App\Http\Controllers\Admin\PrintedPurchaseOrderController::class, 'show'])->name('printed.purchaseorder.show');
 Route::delete('printed-purchase-order/{printed}', [\App\Http\Controllers\Admin\PrintedPurchaseOrderController::class, 'destroy'])->name('printed.purchaseorder.destroy');
 
 
  
  
 
  //ink
  Route::get('ink', [\App\Http\Controllers\Admin\InkController::class, 'index'])->name('ink.index');
  Route::get('ink/create', [\App\Http\Controllers\Admin\InkController::class, 'create'])->name('ink.create');
  Route::post('ink', [\App\Http\Controllers\Admin\InkController::class, 'store'])->name('ink.store');
  Route::get('ink/{ink}/edit', [\App\Http\Controllers\Admin\InkController::class, 'edit'])->name('ink.edit');
  Route::put('ink/{ink}', [\App\Http\Controllers\Admin\InkController::class, 'update'])->name('ink.update');
  Route::get('ink/{ink}', [\App\Http\Controllers\Admin\InkController::class, 'show'])->name('ink.show');
  Route::delete('ink/{ink}', [\App\Http\Controllers\Admin\InkController::class, 'destroy'])->name('ink.destroy');



  Route::get('material-master', [\App\Http\Controllers\Admin\MaterialMasterController::class, 'index'])->name('material-master.index');
  Route::get('material-master/create', [\App\Http\Controllers\Admin\MaterialMasterController::class, 'create'])->name('material-master.create');
  Route::post('material-master', [\App\Http\Controllers\Admin\MaterialMasterController::class, 'store'])->name('material-master.store');
  Route::get('material-master/{ink}/edit', [\App\Http\Controllers\Admin\MaterialMasterController::class, 'edit'])->name('material-master.edit');
  Route::put('material-master/{ink}', [\App\Http\Controllers\Admin\MaterialMasterController::class, 'update'])->name('material-master.update');
  Route::get('material-master/{ink}', [\App\Http\Controllers\Admin\MaterialMasterController::class, 'show'])->name('material-master.show');
  Route::delete('material-master/{ink}', [\App\Http\Controllers\Admin\MaterialMasterController::class, 'destroy'])->name('material-master.destroy');

  Route::get('cut-fold-machine',[\App\Http\Controllers\Admin\CutFoldMachineController::class,'index'])->name('cut-fold-machine.index');
  Route::get('cut-fold-machine/create',[\App\Http\Controllers\Admin\CutFoldMachineController::class,'create'])->name('cut-fold-machine.create');
  Route::post('cut-fold-machine/store',[\App\Http\Controllers\Admin\CutFoldMachineController::class,'store'])->name('cut-fold-machine.store');
  Route::get('cut-fold-machine/{cutFold}',[\App\Http\Controllers\Admin\CutFoldMachineController::class,'show'])->name('cut-fold-machine.show');
  Route::get('cut-fold-machine/{cutFold}/edit',[\App\Http\Controllers\Admin\CutFoldMachineController::class,'edit'])->name('cut-fold-machine.edit');
  Route::put('cut-fold-machine/{cutFold}',[\App\Http\Controllers\Admin\CutFoldMachineController::class,'update'])->name('cut-fold-machine.update');
  Route::delete('cut-fold-machine/{cutFold}',[\App\Http\Controllers\Admin\CutFoldMachineController::class,'destroy'])->name('cut-fold-machine.destroy');

  Route::get('machine-master',[\App\Http\Controllers\Admin\MachineMasterController::class,'index'])->name('machine-master.index');
  Route::get('machine-master/create',[\App\Http\Controllers\Admin\MachineMasterController::class,'create'])->name('machine-master.create');
  Route::post('machine-master/store',[\App\Http\Controllers\Admin\MachineMasterController::class,'store'])->name('machine-master.store');
  Route::get('machine-master/{machine}',[\App\Http\Controllers\Admin\MachineMasterController::class,'show'])->name('machine-master.show');
  Route::get('machine-master/{machine}/edit',[\App\Http\Controllers\Admin\MachineMasterController::class,'edit'])->name('machine-master.edit');
  Route::put('machine-master/{machine}',[\App\Http\Controllers\Admin\MachineMasterController::class,'update'])->name('machine-master.update');
  Route::delete('machine-master/{machine}',[\App\Http\Controllers\Admin\MachineMasterController::class,'destroy'])->name('machine-master.destroy');

  Route::get('size-master-mm',[\App\Http\Controllers\Admin\SizeMasterController::class,'index'])->name('size-master-mm.index');
  Route::get('size-master-mm/create',[\App\Http\Controllers\Admin\SizeMasterController::class,'create'])->name('size-master-mm.create');
  Route::post('size-master-mm/store',[\App\Http\Controllers\Admin\SizeMasterController::class,'store'])->name('size-master-mm.store');
  Route::get('size-master-mm/{size}',[\App\Http\Controllers\Admin\SizeMasterController::class,'show'])->name('size-master-mm.show');
  Route::get('size-master-mm/{size}/edit',[\App\Http\Controllers\Admin\SizeMasterController::class,'edit'])->name('size-master-mm.edit');
  Route::put('size-master-mm/{size}',[\App\Http\Controllers\Admin\SizeMasterController::class,'update'])->name('size-master-mm.update');
  Route::delete('sizemastermm/{size}',[\App\Http\Controllers\Admin\SizeMasterController::class,'destroy'])->name('size-master-mm.destroy');


  Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
  Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

  Route::get('invoice', [\App\Http\Controllers\Admin\InvoiceController::class, 'index'])->name('invoice.index');
  Route::get('invoice/create', [\App\Http\Controllers\Admin\InvoiceController::class, 'create'])->name('invoice.create');
  Route::post('invoice/store', [\App\Http\Controllers\Admin\InvoiceController::class, 'store'])->name('invoice.store');
  Route::get('invoice/{invoice}/edit', [\App\Http\Controllers\Admin\InvoiceController::class, 'edit'])->name('invoice.edit');
  Route::get('invoice/{invoice}', [\App\Http\Controllers\Admin\InvoiceController::class, 'show'])->name('invoice.show');
  Route::put('invoice/{invoice}', [\App\Http\Controllers\Admin\InvoiceController::class, 'update'])->name('invoice.update');
  Route::delete('invoice/{invoice}', [\App\Http\Controllers\Admin\InvoiceController::class, 'destroy'])->name('invoice.destroy');
  Route::get('generate-invoice-pdf/{invoice}', [\App\Http\Controllers\Admin\InvoiceController::class, 'generateInvoicePDF'])->name('invoice.pdf');

  Route::get('company-profile', [\App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('company-profile.index');
  Route::get('company-profile/create', [\App\Http\Controllers\Admin\ProfileController::class, 'create'])->name('company-profile.create');
  Route::post('company-profile', [\App\Http\Controllers\Admin\ProfileController::class, 'store'])->name('company-profile.store');
  Route::get('company-profile/{profile}/edit', [\App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('company-profile.edit');
  Route::put('company-profile/{profile}', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('company-profile.update');
  Route::get('company-profile/{profile}', [\App\Http\Controllers\Admin\ProfileController::class, 'show'])->name('company-profile.show');
  Route::delete('company-profile/{profile}', [\App\Http\Controllers\Admin\ProfileController::class, 'destroy'])->name('company-profile.destroy');
});
