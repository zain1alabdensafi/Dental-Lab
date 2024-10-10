<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CaseController;
use App\Http\Controllers\categorycontroller;
use App\Http\Controllers\itemcontroller;
use App\Http\Controllers\subcategorycontroller;
use App\Http\Controllers\TeethController;
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
    return view('main-lab');
})->name('main');
Route::get('/Cases',[CaseController::class,'show_cases_admin'])->name('Cases');
Route::post('/Cases-del',[CaseController::class,'delete_case_user'])->name('Cases-del');


Route::get('/Cases-add',[CaseController::class,'add_case_admin'])->name('Cases-add');
Route::get('/Cases.add',function(){
return view('Cases.add');
})->name('Cases.add');
Route::post('/Cases-add', [CaseController::class,'add_case_admin'])->name('Cases-add');

Route::get('Cases.details',[CaseController::class,'show_case_details_admin'])->name('Cases.details');
Route::post('Cases.details',[CaseController::class,'show_case_details_admin'])->name('Cases.details');

//Route::post('/Cases',[CaseController::class,'add_case'])->name('/Cases');
// add
//Route::get('/Cases/add',[CaseController::class, 'add']);


// edit
Route::get('/Cases/details', function () {
    return view('Cases.details');
})->name('Cases-details');

// delete
Route::get('/exit-permissions/delete', function () {
    return view('Cases.index');
})->name('Cases-delete');

// // 
// Route::get('/Bills', function () {
//     return view('Bills.index');
// })->name('Bills');
Route::get('/Bills',[BillController::class,'all_bill_admin'])->name('Bills');
Route::post('/Bills-ad',[BillController::class,'add_bill'])->name('Bills-ad');
Route::post('/Bills-del',[BillController::class,'delete_bill'])->name('Bills-del');
Route::get('/Bills-s',[BillController::class,'search_bills_user'])->name('search_bills_user');
Route::post('/Bills-s',[BillController::class,'search_bills_user'])->name('Bills-s');
Route::get('/Bills-e',[BillController::class,'update_bill'])->name('update_bill');
Route::post('/Bills-e',[BillController::class,'update_bill'])->name('update_bill');
// Route::get('/Bills/add', function () {
//     return view('Bills.index');
// })->name('add');

Route::get('/Bills/detils', function () {
    return view('Bills.detils');
})->name('detils');
Route::get('/Bills/delete', function () {
    return view('Billls.index');
})->name('delete');

////
// Route::get('/Clients', function () {
//     return view('Clients.index');
// })->name('Clients');
////////////////////////////////////

//Route::post('/Cases-del',[UserController::class,'delete_case_user'])->name('Cases-del');

// //////////////////////////////////////////
Route::get('/Clients',[UserController::class,'all_users_admin'])->name('Clients');
//Route::post('/Clients-edit',[UserController::class, 'update'])->name('Clients');
Route::post('/Clients-del',[UserController::class,'delete_user_admin'])->name('Clients-del');

Route::post('/Clients',[UserController::class,'add_user_admin'])->name('/Clients');
Route::post('/Clients',[UserController::class,'update_profile_user'])->name('/Clients');
// Route::get('/Clients/add', function () {
//     return view('Clients');
// })->name('Clients-add');
// show
// Route::get('/Clients/{name}/show', function () {
//     return view('Clients.show');
// })->name('Clients-show');
 // edit
//  Route::get('/Clients//update', function () {
//     return view('Clients.update');
// })->name('Clients-update');
// delete
Route::get('/Clients/delete/{id}', function () {
    return view('Clients.index');
})->name('Clients-delete');

// Route::get('/Inventory', function () {
//     return view('Inventory.index');
// })->name('Inventory');
Route::get('/Inventory',[itemcontroller::class,'show'])->name('Inventory');
Route::post('/Inventory.index',[itemcontroller::class,'show'])->name('Inventory');

Route::get('/Inventory-add',[ItemController::class,'create'])->name('Inventory-add');
Route::get('/Inventory.add',function(){
return view('Inventory');
})->name('Inventory');
Route::post('/Inventory-add', [ItemController::class,'create'])->name('Inventory-add');

Route::get('/Inventory-add1',[categorycontroller::class,'create'])->name('Inventory-add1');
Route::post('/Inventory-add1', [categorycontroller::class,'create'])->name('Inventory-add1');

Route::get('/Inventory-add2',[subcategorycontroller::class,'create'])->name('Inventory-add2');
Route::post('/Inventory-add2', [subcategorycontroller::class,'create'])->name('Inventory-add2');
Route::post('/Inventory-del',[itemcontroller::class,'destroy'])->name('Inventory-del');
Route::post('/Inventory-edit',[itemcontroller::class,'update'])->name('Inventory-edit');

Route::get('teeth',function(){
    return view('teeth');
})->name('teeth');
Route::get('teeth1',[TeethController::class,'add_teeth'])->name('teeth1');
Route::post('teeth1',[TeethController::class,'add_teeth'])->name('teeth1');
// delete
// Route::get('/Clients/delete/{id}', function () {
//     return view('Clients.index');
// })->name('Clients-delete');


// Route::get('/', function () {
//     return view('welcome');
// });
//Treatment

/*//$seeder = new DataSeeder($request->type_treatment);
Route::get('/seed_treatment', function (Illuminate\Http\Request $request) {
    $seeder = new d($request->type_treatment);
    $seeder->run();
});

//Material
Route::get('/seed_material', function (Illuminate\Http\Request $request) {
    $seeder = new DataSeeder($request->type_material);
    $seeder->run();
});
*/
// Route::post('/ase', [CaseController::class, 'add_case'])->name('ase');  
// Route::get('/ase', [CaseController::class, 'add_case'])->name('ase');  
