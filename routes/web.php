<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PacienteController;
use Illuminate\Support\Facades\Route;

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
Route::post('login', [AuthController::class, 'homePage']);
//Route::get('logout',[AuthController::class, 'logout']);


Route::group(['middleware' => ['auth']], function () {
    Route::get('/create', [PacienteController::class,'create'])->name('create');
    Route::get('/edit/{id}', [PacienteController::class, 'edit'])->name('edit');


    Route::post('/store', [PacienteController::class,'store'])->name('store');
    Route::get('/show/{id}', [PacienteController::class, 'show'])->name('show');
    Route::put('/update/{id}', [PacienteController::class, 'update'])->name('update');
    Route::get('/paciente', [PacienteController::class, 'index'])->name('paciente');
    
    Route::delete('/destroy/{id}', [PacienteController::class, 'destroy'])->name('destroy');
    Route::post('/logout', [AuthController::class, 'logout']);
});


   

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
