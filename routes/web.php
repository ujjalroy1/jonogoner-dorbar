<?php

use App\Http\Controllers\TeamController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';



//user
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/registration', [HomeController::class, 'registration'])->name('registration');
Route::post('/registration/save', [HomeController::class, 'registration_save'])->name('registration_save');
Route::get('/registration_list', [HomeController::class, 'registration_list'])->name('registration_list');
Route::get('/approve_list', [HomeController::class, 'approve_list'])->name('approve_list');
Route::get('/payment/create', [HomeController::class, 'payment_create'])->name('payment_create');
Route::post('/payment/store', [HomeController::class, 'payment_save'])->name('payment_save');
Route::get('project-showcase', [HomeController::class, 'project_showcase'])->name('project_showcase');
Route::get('main-registration', [HomeController::class, 'main_registration'])->name('main_registration');
Route::get('gaming-contest', [HomeController::class, 'gaming_contest'])->name('gaming_contest');
Route::get('poster-presentation', [HomeController::class, 'poster_presentation'])->name('poster_presentation');
Route::get('itquiz', [HomeController::class, 'itquiz'])->name('itquiz');


//admin
Route::get('/teams', [TeamController::class, 'index'])->middleware(['auth', 'admin'])->name('teams.index');
Route::get('/teams/{id}', [TeamController::class, 'show'])->middleware(['auth', 'admin'])->name('teams.show');
Route::post('/teams/{id}', [TeamController::class, 'update'])->middleware(['auth', 'admin'])->name('teams.update');
Route::delete('/teams/{id}', [TeamController::class, 'destroy'])->middleware(['auth', 'admin'])->name('teams.destroy');

Route::get('/teams_payments', [PaymentController::class, 'viewPayments'])->middleware(['auth', 'admin'])->name('teams_payments');
Route::post('/teams_payments/approve/{id}', [PaymentController::class, 'approvePayment'])->middleware(['auth', 'admin'])->name('approvePayment');
Route::delete('/teams_payments/delete/{id}', [PaymentController::class, 'deletePayment'])->middleware(['auth', 'admin'])->name('deletePayment');

Route::get('/complaint', [HomeController::class, 'complaint'])->name('complaint');
Route::get('gellary', [HomeController::class, 'gellary'])->name('gellary');
Route::get('contact', [HomeController::class, 'contact'])->name('contact');

//admin
Route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'admin'])->name('admin.dashboard');

Route::get('/message-form', [MessageController::class, 'showForm'])->middleware(['auth', 'admin'])->name('showForm');
Route::post('/send-message', [MessageController::class, 'sendMessage'])->middleware(['auth', 'admin'])->name('sendMessage');

////
use App\Http\Controllers\OvijogController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\EmergencyController;
use App\Http\Controllers\UserController;

Route::get('/ovijogs', [OvijogController::class, 'index'])->middleware(['auth'])->name('ovijogs.index');
Route::post('/ovijogs', [OvijogController::class, 'store'])->middleware(['auth'])->name('ovijogs.store');
Route::delete('/ovijogs/{id}', [OvijogController::class, 'destroy'])->middleware(['auth'])->name('ovijogs.destroy');
Route::get('/all-ovijogs/{id}', [OvijogController::class, 'all_ovijogs'])->name('all_ovijogs');

Route::middleware(['auth'])->group(function () {
    Route::get('/user/emergency', [EmergencyController::class, 'create'])->name('emergency.create');
    Route::post('/user/emergency', [EmergencyController::class, 'store'])->name('emergency.store');
});
Route::middleware('auth', 'admin')->group(function () {
    Route::get('/admin/emergencies', [EmergencyController::class, 'index'])->name('emergency.index');
    Route::patch('/admin/emergencies/{emergency}/status', [EmergencyController::class, 'updateStatus'])->name('emergency.updateStatus');
    Route::delete('/admin/emergencies/{emergency}', [EmergencyController::class, 'destroy'])->name('emergency.delete');
});

// User routes
Route::middleware(['auth'])->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/join', [ChatController::class, 'joinQueue'])->name('chat.join');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::post('/chat/leave', [ChatController::class, 'leaveChat'])->name('chat.leave');
});

// Admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/chat', [ChatController::class, 'adminIndex'])->name('admin.chat.index');
    Route::post('/admin/chat/end', [ChatController::class, 'endChat'])->name('admin.chat.end');
    Route::post('/admin/chat/next', [ChatController::class, 'nextUser'])->name('admin.chat.next');
});

//admin department
Route::get('admin/vumiseba', [AdminController::class, 'vumiseba'])->middleware(['auth', 'admin'])->name('vumiseba');
Route::post('admin/status-change/{id}', [AdminController::class, 'status_change'])->middleware(['auth', 'admin'])->name('status_change');
Route::get('admin/vumiseba-delete/{id}', [AdminController::class, 'vumiseba_delete'])->middleware(['auth', 'admin'])->name('vumiseba_delete');
Route::post('admin/type-change/{id}', [AdminController::class, 'type_change'])->middleware(['auth', 'admin'])->name('type_change');


//after login
Route::get('/user', [UserController::class, 'index'])->middleware(['auth'])->name('userindex');
