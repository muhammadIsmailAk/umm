<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SupervisorController;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'firstpage'])->middleware('guest');



Route::get('doc', function () {
    return view('admin.doctors');
});

















Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', [LoginController::class,'logout']);


// Users Routes

Route::middleware(['auth', 'user-access:student'])->group(function () {
  
    // Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    
    Route::get('/homeu', [StudentController::class, 'student'])->name('homeu');
    Route::get('/sapp/{id}', [StudentController::class, 'aprove'])->name('sapp');
    Route::post('/aqu', [StudentController::class, 'aquire'])->name('aqu');
    Route::get('/penstatus', [StudentController::class, 'stdpending'])->name('penstatus');
    // Route::get('/homeu', [StudentController::class, 'student'])->name('homeu');
});

// Manager Routes

Route::middleware(['auth', 'user-access:faculty'])->group(function () {
  
    Route::get('/homef', [HomeController::class, 'faculty'])->name('homef');
    Route::get('/pendf', [HomeController::class, 'pending'])->name('pendf');
    Route::get('/accf', [HomeController::class, 'accepted'])->name('accf');
    Route::get('/rejf', [HomeController::class, 'rejected'])->name('rejf');
    Route::get('/proxd', [HomeController::class, 'products'])->name('proxd');
    Route::post('/facSa/{id}', [HomeController::class, 'facacc'])->name('facSa');
    Route::post('/facrej/{id}', [HomeController::class, 'facrej'])->name('facrej');
});  


Route::middleware(['auth', 'user-access:supervisor'])->group(function () {
  
    Route::get('/homes', [SupervisorController::class, 'supervisor'])->name('homes');
    Route::get('/req', [SupervisorController::class, 'request'])->name('req');
    Route::get('/rej', [SupervisorController::class, 'reject'])->name('rej');
    Route::get('/app', [SupervisorController::class, 'approved'])->name('app');
    Route::get('/sup/inv', [SupervisorController::class, 'supitem'])->name('supInv');
    Route::get('/reci', [SupervisorController::class, 'received'])->name('reci');
    Route::get('/recstati', [SupervisorController::class, 'recstati'])->name('recstati');
    Route::get('/statis', [SupervisorController::class, 'statis'])->name('statis');
    Route::post('/add/inv/sup', [SupervisorController::class, 'supstore'])->name('supitem');
    Route::post('/supa/{id}/{pid}', [SupervisorController::class, 'Supacc'])->name('supa');
    Route::post('/suprej/{id}', [SupervisorController::class, 'Suprej'])->name('suprej');
    Route::get('/seditinventory/{id}', [SupervisorController::class, 'edit'])->name('supeditinv');
    Route::get('sdeleteinv/{id}', [SupervisorController::class,'destroy'])->name('supdeleteinv');
    Route::post('supdateinv/{id}', [SupervisorController::class,'update'])->name('supupdateinv');
    Route::post('statusrec', [SupervisorController::class,'statusrec'])->name('statusrec');
}); 

// Super Admin Routes


    // Route::group(['prefix' => 'post', 'middleware' => ['auth', 'user-access:admin']],function () {
    Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'admin'])->name('admin');
    Route::get('/add', [AdminController::class, 'addInventory'])->name('add');
    Route::get('/sup', [AdminController::class, 'addSup'])->name('sup');
    Route::get('/fac', [AdminController::class, 'addFac'])->name('fac');
    Route::get('/status', [AdminController::class, 'statusp'])->name('status');
    Route::get('/availble', [AdminController::class, 'available'])->name('availble');
    Route::post('/affixfac', [AdminController::class, 'affixFac'])->name('affixfac');
    Route::get('/stud', [AdminController::class, 'addStud'])->name('stud');
    Route::get('/Statusstudent', [AdminController::class, 'stuall'])->name('stastud');
    Route::get('/Statusfac', [AdminController::class, 'facall'])->name('stafac');
    Route::get('/statussup', [AdminController::class, 'superall'])->name('stasup');
    Route::post('/addinventory', [AdminController::class, 'store'])->name('invform');
    Route::get('/editinventory/{id}', [AdminController::class, 'edit'])->name('editinv');
    Route::get('/inventory', [AdminController::class, 'all'])->name('inventory');
    Route::post('updateinv/{id}', [AdminController::class,'update'])->name('updateinv');
    Route::get('deleteinv/{id}', [AdminController::class,'destroy'])->name('deleteinv');
    Route::post('/addstu', [AdminController::class,'addStudent'])->name('addstu');
    Route::get('/editstu/{id}', [AdminController::class, 'stuedit'])->name('editstu');
    Route::post('/upstu/{id}', [AdminController::class, 'updatestu'])->name('upstu');
    Route::get('delsup/{id}', [AdminController::class,'supdes'])->name('delsup');
    Route::get('/delstu/{id}', [AdminController::class, 'delstu'])->name('delstu');
    Route::post('/affixsup', [AdminController::class, 'affixSuper'])->name('affixsup');
    Route::get('/editsup/{id}', [AdminController::class, 'superedit'])->name('editsup');
    Route::post('updatesup/{id}', [AdminController::class,'updateSuper'])->name('updatesup');
    Route::get('delsup/{id}', [AdminController::class,'supdes'])->name('delsup');
    Route::get('/editfac/{id}', [AdminController::class, 'facedit'])->name('editfac');
    Route::post('/upfac/{id}', [AdminController::class, 'updatefac'])->name('upfac');
    Route::get('delfac/{id}', [AdminController::class,'facdes'])->name('delfac');
    


});
 


Route::get('/auth/google', [LoginController::class,'redirectToGoogle'])->name('google');
Route::get('/auth/google/callback',  [LoginController::class,'handleGoogleCallback'])->name('authgoogle');;
