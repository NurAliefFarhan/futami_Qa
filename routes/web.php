<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FutamiController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\MikrobiologiAirController;
use App\Http\Controllers\UserController;


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


//Route Profile
Route::middleware('isLogin', 'cekRole:operator,staff,supervisor')->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::patch('/profile/{id}', [UserController::class, 'updateProfile'])->name('profile.post'); 
    Route::get('/profile/password_verify', [UserController::class, 'password_verify'])->name('password_verify');
    Route::post('/profile/password_verify', [UserController::class, 'verify'])->name('verify.post');
    Route::get('/profile/password', [UserController::class, 'password'])->name('password');
    Route::patch('/profile/update_password/{id}', [UserController::class, 'updatePassword'])->name('password.update');
    
    
});

Route::middleware('isLogin', 'cekRole:superadmin')->group(function () {
    Route::get('/superadmin/profile', [UserController::class, 'superadmin_profile'])->name('superadmin_profile');
    Route::patch('/superadmin/profile/{id}', [UserController::class, 'superadmin_updateProfile'])->name('superadmin_profile.post'); 
    Route::get('/superadmin/profile/password', [UserController::class, 'superadmin_password'])->name('superadmin_password');
    Route::patch('/superadmin/profile/update_password/{id}', [UserController::class, 'superadmin_updatePassword'])->name('superadmin_password.update');
    
});


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



// PROJECT Route mikrobiologi air 
Route::middleware('isLogin', 'cekRole:operator,staff,supervisor,superadmin')->group(function () {
    //Route Operator 
    Route::get('/operator/mikrobiologi', [MikrobiologiAirController::class, 'mikrobiologi'])->name('mikrobiologi');
    Route::get('/operator/add_mikrobiologi', [MikrobiologiAirController::class, 'add_mikrobiologi'])->name('add_mikrobiologi');
    Route::post('/operator/add_mikrobiologi', [MikrobiologiAirController::class, 'input_mikrobiologi'])->name('mikrobiologi.post');
    Route::get('/operator/sampel_mikrobiologi/{id}', [MikrobiologiAirController::class, 'sampel_mikrobiologi'])->name('sampel_mikrobiologi');
    Route::post('/operator/sampel_mikrobiologi/{id}', [MikrobiologiAirController::class, 'input_sampel_mikrobiologi'])->name('sampel_mikrobiologi.post');
    Route::patch('/operator/mikrobiologi/ttd/{id}', [MikrobiologiAirController::class, 'mikrobiologi_operatorttd'])->name('mikrobiologi_operatorttd');  
    Route::get('/operator/mikrobiologi/sampel/{id}', [MikrobiologiAirController::class, 'mikrobiologi_sampel'])->name('mikrobiologi_sampel');
    Route::get('/operator/mikrobiologi/edit/{id}', [MikrobiologiAirController::class, 'edit_mikrobiologi'])->name('edit_mikrobiologi');
    Route::patch('/operator/mikrobiologi/edit/{id}', [MikrobiologiAirController::class, 'update_mikrobiologi'])->name('update_mikrobiologi.post');    
    Route::patch('/operator/mikrobiologi/Delete/{id}', [MikrobiologiAirController::class, 'mikrobiologi_Destroy'])->name('mikrobiologi_Delete'); //route untuk btn delete todo index 
    Route::delete('/operator/mikrobiologi/sampelDelete/{id}', [MikrobiologiAirController::class, 'sampel_mikrobiologi_Destroy'])->name('sampel_mikrobiologi_Delete'); //route untuk btn delete todo index 
    Route::get('/operator/mikrobiologi/pdf/{id}', [MikrobiologiAirController::class, 'operator_mikrobiologi_pdf'])->name('operator_mikrobiologi_pdf');
    Route::get('/operator/mikrobiologi/history', [MikrobiologiAirController::class, 'mikrobiologi_history'])->name('mikrobiologi_history');



    // //Route Staff 
    Route::get('/staff/mikrobiologi', [MikrobiologiAirController::class, 'staff_mikrobiologi'])->name('staff_mikrobiologi');
    Route::patch('/staff/mikrobiologi/ttd/{id}', [MikrobiologiAirController::class, 'mikrobiologi_staffttd'])->name('mikrobiologi_staffttd');  
    Route::patch('/staff/mikrobiologi/declinettd/{id}', [MikrobiologiAirController::class, 'mikrobiologi_staff_declinettd'])->name('mikrobiologi_staff_declinettd');  
    Route::get('/staff/mikrobiologi/pdf/{id}', [MikrobiologiAirController::class, 'staff_mikrobiologi_pdf'])->name('staff_mikrobiologi_pdf');




    //Route Supervisor 
    Route::get('/supervisor/mikrobiologi', [MikrobiologiAirController::class, 'supervisor_mikrobiologi'])->name('supervisor_mikrobiologi');
    Route::patch('/supervisor/mikrobiologi/ttd/{id}', [MikrobiologiAirController::class, 'mikrobiologi_supervisorttd'])->name('mikrobiologi_supervisorttd');  
    Route::get('/supervisor/mikrobiologi/pdf/{id}', [MikrobiologiAirController::class, 'supervisor_mikrobiologi_pdf'])->name('supervisor_mikrobiologi_pdf');
     




    //Route Superadmin 
    Route::get('/superadmin/mikrobiologi/info', [MikrobiologiAirController::class, 'superadmin_mikrobiologi'])->name('superadmin_mikrobiologi');
    Route::get('/superadmin/mikrobiologi/sampel/{id}', [MikrobiologiAirController::class, 'superadmin_mikrobiologi_sampel'])->name('superadmin_mikrobiologi_sampel');
    Route::get('/superadmin/mikrobiologi/pdf/{id}', [MikrobiologiAirController::class, 'superadmin_mikrobiologi_pdf'])->name('superadmin_mikrobiologi_pdf');
    Route::get('/superadmin/mikrobiologi/history', [MikrobiologiAirController::class, 'superadmin_mikrobiologi_history'])->name('superadmin_mikrobiologi_history');

});
// Route::middleware('isLogin', 'cekRole:staff')->group(function () {
//     //Route Staff 
//     Route::get('/staff/mikrobiologi', [MikrobiologiAirController::class, 'staff_mikrobiologi'])->name('staff_mikrobiologi');
//     Route::patch('/staff/mikrobiologi/ttd/{id}', [MikrobiologiAirController::class, 'mikrobiologi_staffttd'])->name('mikrobiologi_staffttd');  
//     Route::patch('/staff/mikrobiologi/declinettd/{id}', [MikrobiologiAirController::class, 'mikrobiologi_staff_declinettd'])->name('mikrobiologi_staff_declinettd');  
//     Route::get('/staff/mikrobiologi/pdf/{id}', [MikrobiologiAirController::class, 'staff_mikrobiologi_pdf'])->name('staff_mikrobiologi_pdf');

// });


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
    Route::patch('/admin/adduser/reset/{id}', [SuperadminController::class, 'userReset'])->name('user.reset'); //route untuk btn delete todo index 

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

