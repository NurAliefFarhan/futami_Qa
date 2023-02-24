<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FutamiController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\SuperadminController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware('isGuest')->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'auth'])->name('login.auth');
    Route::get('/register', [LoginController::class, 'register'])->name('register');
    Route::post('/register', [LoginController::class, 'inputRegister'])->name('register.post'); 
});
Route::get('/', [LoginController::class, 'lending'])->name('lending');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');



Route::middleware('isLogin', 'cekRole:operator')->group(function () {
    //Route Operator 
    Route::get('/operator', [OperatorController::class, 'operator'])->name('operator');
    Route::get('/operator/data', [OperatorController::class, 'data'])->name('data');
    Route::get('/operator/tambahdata', [OperatorController::class, 'tambahData'])->name('tambahData');
    Route::post('/operator/tambahdata', [OperatorController::class, 'inputData'])->name('data.post'); 
    Route::patch('/delete/{id}', [OperatorController::class, 'dataDestroy'])->name('delete'); //route untuk btn delete todo index 
    
    
    // Route::get('/edit/{id}', [OperatorController::class, 'dataEdit'])->name('edit'); //untuk mengedit-> {id} untuk mengedit id yang dipilih
    // Route::patch('/update/{id}', [OperatorController::class, 'dataUpdate'])->name('update');
    Route::patch('/operatorttd/{id}', [OperatorController::class, 'operatorttd'])->name('operatorttd');  
    Route::get('/operatoranalisakimia/pdf/{id}', [OperatorController::class, 'operator_analisakimiapdf'])->name('operator_analisakimiapdf');
    
    Route::get('/operator/analisakimia', [OperatorController::class, 'data_analisa_kimia'])->name('data_analisa_kimia');
    Route::post('/operator/analisakimia', [OperatorController::class, 'input_data_analisa_kimia'])->name('data_analisa_kimia.post');
    Route::get('/operator/sampelanalisakimia/{id}', [OperatorController::class, 'sampel_analisa_kimia'])->name('sampel_analisa_kimia');
    Route::post('/operator/sampelanalisakimia/{id}', [OperatorController::class, 'input_sampel_analisa_kimia'])->name('sampel_analisa_kimia.post');
    
    Route::get('/operator/analisakimia/edit/{id}', [OperatorController::class, 'edit_data_analisa_kimia'])->name('edit_data_analisa_kimia');
    Route::patch('/operator/analisakimia/edit/{id}', [OperatorController::class, 'update_data_analisa_kimia'])->name('update_data_analisa_kimia');    
    Route::get('/operator/analisakimia/sampel/{id}', [OperatorController::class, 'sampel'])->name('sampel');
    Route::delete('/operator/analisakimia/delete/{id}', [OperatorController::class, 'sampelDestroy'])->name('sampelDelete'); //route untuk btn delete todo index 

    Route::get('/operator/analisakimia/history', [OperatorController::class, 'analisakimia_history'])->name('analisakimia_history');
    
});




//Staff Route 
Route::middleware('isLogin', 'cekRole:staff')->group(function () {
    Route::get('/staff', [StaffController::class, 'staff'])->name('staff');
    Route::get('/staff/data', [StaffController::class, 'datastaff'])->name('datastaff');
    Route::patch('/staffttd/{id}', [StaffController::class, 'staffttd'])->name('staffttd');  
    Route::patch('/declinettd/{id}', [StaffController::class, 'declinettd'])->name('declinettd');  
    Route::get('/staffanalisakimia/pdf/{id}', [StaffController::class, 'staff_analisakimiapdf'])->name('staff_analisakimiapdf');
    Route::get('/staff/analisakimia/history', [StaffController::class, 'staff_analisakimia_history'])->name('staff_analisakimia_history');

});


//Route Supervisor 
Route::middleware('isLogin', 'cekRole:supervisor')->group(function () {
    Route::get('/supervisor', [SupervisorController::class, 'supervisor'])->name('supervisor');
    Route::get('/supervisor/data', [SupervisorController::class, 'datasupervisor'])->name('datasupervisor');
    Route::patch('/supervisorttd/{id}', [SupervisorController::class, 'supervisorttd'])->name('supervisorttd');  
    Route::get('/supervisoranalisakimia/pdf/{id}', [SupervisorController::class, 'supervisor_analisakimiapdf'])->name('supervisor_analisakimiapdf');
    Route::get('/supervisor/analisakimia/history', [SupervisorController::class, 'supervisor_analisakimia_history'])->name('supervisor_analisakimia_history');

});



//Admin Route 
Route::middleware('isLogin', 'cekRole:superadmin')->group(function () {
    Route::get('/admin', [SuperadminController::class, 'admin'])->name('admin');
    Route::get('/admin/role', [SuperadminController::class, 'role'])->name('role');
    Route::post('/admin/role', [SuperadminController::class, 'inputrole'])->name('inputrole');
    
    Route::get('/admin/adduser', [SuperadminController::class, 'adduser'])->name('adduser');
    Route::post('/admin/adduser', [SuperadminController::class, 'inputUser'])->name('user.post'); 
    Route::delete('/admin/adduser/delete/{id}', [SuperadminController::class, 'userDestroy'])->name('user.delete'); //route untuk btn delete todo index 
    Route::get('/admin/adduser/edit/{id}', [SuperadminController::class, 'userEdit'])->name('user.edit'); //untuk mengedit-> {id} untuk mengedit id yang dipilih
    Route::patch('/admin/adduser/update/{id}', [SuperadminController::class, 'userUpdate'])->name('user.update');
    Route::get('/admin/info', [SuperadminController::class, 'info'])->name('info');
    Route::get('/admin/analisakimia/pdf/{id}', [SuperadminController::class, 'superadmin_analisakimiapdf'])->name('superadmin_analisakimiapdf');
    Route::get('/admin/analisakimia/history', [SuperadminController::class, 'history'])->name('history');

    // Route::get('/superadmin', [SuperadminController::class, 'superadmin'])->name('superadmin');

});


// Route::get('/adhaodhaohd', function () {
//     return view('welcome');
// });

