<?php

use App\Http\Controllers\AgencyController;
use App\Http\Controllers\AppartementController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ReservationsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserContoller;
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




// routes/web.php

Route::get('/calendar', [AgencyController::class, 'addAgency'])->name('addAgency')->middleware('checkuser');
Route::post('/calendar/store', [AgencyController::class, 'storeAgency'])->name('storeAgency')->middleware('checkuser');

Route::get('/login', [UserContoller::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserContoller::class, 'login']);

Route::get('/profile/{id}',[ClientsController::class, 'getClient'])->name('profile')->middleware('checkuser');


Route::get('/settings', [SettingController::class, 'get'])->name('settings')->middleware('checkuser');
Route::post('/settings/store', [SettingController::class, 'store'])->name('storeSettings')->middleware('checkuser');
Route::post('/settings/update', [SettingController::class, 'update'])->name('updateSettings')->middleware('checkuser');

Route::get('/', [Controller::class, 'showDashboard'])->name('dashboard')->middleware('checkuser');

Route::get('/clients', [ClientsController::class, 'getClients'])->name('clients')->middleware('checkuser');
Route::get('/add-client', [ClientsController::class, 'addClient'])->name('add_client')->middleware('checkuser');
Route::post('/add-client/store', [ClientsController::class, 'store'])->name('storeClient')->middleware('checkuser');
Route::get('/edit-client/{id}', [ClientsController::class, 'editclient'])->name('edit_client')->middleware('checkuser');
Route::post('/edit-client/update/{id}', [ClientsController::class, 'update'])->name('updateClient')->middleware('checkuser');
Route::get('/clients/delete/{id}', [ClientsController::class, 'deleteClient'])->name('delete_client')->middleware('checkuser');



Route::get('/appartements', [AppartementController::class, 'getAppartements'])->name('appartements')->middleware('checkuser');
Route::post('/appartements/status/{id}', [AppartementController::class, 'status'])->name('status')->middleware('checkuser');
Route::get('/add-appartement', [AppartementController::class, 'addAppartement'])->name('add_appartement')->middleware('checkuser');
Route::post('/add-appartement/store', [AppartementController::class, 'store'])->name('storeaAppartement')->middleware('checkuser');
Route::get('/edit-appartement/{id}', [AppartementController::class, 'editappartement'])->name('edit_appartement')->middleware('checkuser');
Route::post('/edit-appartement/update/{id}', [AppartementController::class, 'update'])->name('updateAppartement')->middleware('checkuser');
Route::get('/appartements/delete/{id}', [AppartementController::class, 'deleteAppartement'])->name('delete_appartement')->middleware('checkuser');



Route::get('/reservation', [ReservationsController::class, 'getReservations'])->name('reservations')->middleware('checkuser');
Route::post('/reservation/statusConfirme/{id}', [ReservationsController::class, 'statusConfirme'])->name('statusConfirme')->middleware('checkuser');
Route::post('/reservation/statusAnnule/{id}', [ReservationsController::class, 'statusAnnule'])->name('statusAnnule')->middleware('checkuser');
Route::get('/add-reservation', [ReservationsController::class, 'addReservation'])->name('add_reservation')->middleware('checkuser');
Route::post('/add-reservation/store', [ReservationsController::class, 'store'])->name('storeReservation')->middleware('checkuser');
Route::get('/get-reservation', [ReservationsController::class, 'getReservation'])->name('getReservation')->middleware('checkuser');
Route::get('/edit-reservation/{id}', [ReservationsController::class, 'editReservation'])->name('edit_reservation')->middleware('checkuser');
Route::post('/edit-reservation/update/{id}', [ReservationsController::class, 'update'])->name('updateReservation')->middleware('checkuser');
Route::get('/reservation/delete/{id}', [ReservationsController::class, 'deleteReservation'])->name('delete_reservation')->middleware('checkuser');
Route::get('/view-reservation/{id}', [ReservationsController::class, 'ViewReservations'])->name('view_reservation')->middleware('checkuser');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
