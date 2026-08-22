<?php

use App\Http\Controllers\Admin\BulletinController as AdminBulletinController;
use App\Http\Controllers\Admin\CertificateController as AdminCertificateController;
use App\Http\Controllers\Admin\ContentGridController as AdminContentGridController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\MemberApplicationController as AdminMemberApplicationController;
use App\Http\Controllers\Admin\MemberController as AdminMemberController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberApplicationController;
use App\Http\Controllers\MemberPublicController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - GAE AG (Asociación Gremial del Gas, Agua y Energía)
|--------------------------------------------------------------------------
*/

// Public Web Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profesionales/{slug}', [MemberPublicController::class, 'show'])->name('members.public_show');
Route::post('/postular-socio', [MemberApplicationController::class, 'store'])->name('members.apply_store');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected Admin Panel Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Member Management
    Route::get('/socios', [AdminMemberController::class, 'index'])->name('members.index');
    Route::get('/socios/crear', [AdminMemberController::class, 'create'])->name('members.create');
    Route::post('/socios', [AdminMemberController::class, 'store'])->name('members.store');
    Route::get('/socios/{member}', [AdminMemberController::class, 'show'])->name('members.show');
    Route::get('/socios/{member}/editar', [AdminMemberController::class, 'edit'])->name('members.edit');
    Route::put('/socios/{member}', [AdminMemberController::class, 'update'])->name('members.update');
    Route::delete('/socios/{member}', [AdminMemberController::class, 'destroy'])->name('members.destroy');

    // Member Applications Management
    Route::get('/solicitudes', [AdminMemberApplicationController::class, 'index'])->name('applications.index');
    Route::post('/solicitudes/{application}/aprobar', [AdminMemberApplicationController::class, 'approve'])->name('applications.approve');
    Route::post('/solicitudes/{application}/rechazar', [AdminMemberApplicationController::class, 'reject'])->name('applications.reject');
    Route::delete('/solicitudes/{application}', [AdminMemberApplicationController::class, 'destroy'])->name('applications.destroy');

    // Certificates Management
    Route::post('/socios/{member}/certificados', [AdminCertificateController::class, 'store'])->name('certificates.store');
    Route::delete('/certificados/{certificate}', [AdminCertificateController::class, 'destroy'])->name('certificates.destroy');

    // AI Bulletin & Mailer Management
    Route::get('/boletines', [AdminBulletinController::class, 'index'])->name('bulletins.index');
    Route::get('/boletines/crear', [AdminBulletinController::class, 'create'])->name('bulletins.create');
    Route::post('/boletines/generar-ia', [AdminBulletinController::class, 'generateAi'])->name('bulletins.generate_ai');
    Route::post('/boletines', [AdminBulletinController::class, 'store'])->name('bulletins.store');
    Route::get('/boletines/{bulletin}', [AdminBulletinController::class, 'show'])->name('bulletins.show');
    Route::post('/boletines/{bulletin}/procesar-envios', [AdminBulletinController::class, 'processSends'])->name('bulletins.process_sends');
    Route::delete('/boletines/{bulletin}', [AdminBulletinController::class, 'destroy'])->name('bulletins.destroy');

    // AI Content Grid Scheduler
    Route::get('/grilla-contenido', [AdminContentGridController::class, 'index'])->name('content_grid.index');
    Route::post('/grilla-contenido/generar', [AdminContentGridController::class, 'generateGrid'])->name('content_grid.generate');
    Route::post('/grilla-contenido/{item}/convertir', [AdminContentGridController::class, 'convertToBulletin'])->name('content_grid.convert');
    Route::delete('/grilla-contenido/{item}', [AdminContentGridController::class, 'destroy'])->name('content_grid.destroy');

    // Settings & API Keys
    Route::get('/configuracion', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::post('/configuracion', [AdminSettingController::class, 'update'])->name('settings.update');
});
