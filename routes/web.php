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
use App\Http\Controllers\PageController;
use App\Http\Controllers\PsychologicalTestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - GAE AG (Asociación Gremial del Gas, Agua y Energía)
|--------------------------------------------------------------------------
*/

// Public SEO & Internal Pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/quienes-somos', [PageController::class, 'quienesSomos'])->name('pages.quienes_somos');
Route::get('/beneficios-socios', [PageController::class, 'beneficios'])->name('pages.beneficios');
Route::get('/unete-al-gremio', [PageController::class, 'unete'])->name('pages.unete');
Route::get('/sitemap.xml', [PageController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [PageController::class, 'robots'])->name('robots');

// Public Member Profiles & Applications
Route::get('/profesionales/{slug}', [MemberPublicController::class, 'show'])->name('members.public_show');
Route::get('/profesionales/{slug}/qr.png', [MemberPublicController::class, 'qrImage'])->name('members.qr_image');
Route::post('/postular-socio', [MemberApplicationController::class, 'store'])->name('members.apply_store');

// Psychological Admission Evaluation (Paso 2)
Route::get('/evaluacion-admision/{token}', [PsychologicalTestController::class, 'show'])->name('psych.test');
Route::post('/evaluacion-admision/{token}', [PsychologicalTestController::class, 'submit'])->name('psych.submit');
Route::get('/evaluacion-admision/{token}/completado', [PsychologicalTestController::class, 'completed'])->name('psych.completed');

// Production Fallback Route for Storage Files (prevents 404 if storage:link is missing on production server)
Route::get('/storage/{path}', function ($path) {
    $publicFile = public_path($path);
    $storageFile = storage_path('app/public/' . $path);

    if (file_exists($publicFile)) {
        return response()->file($publicFile);
    }
    if (file_exists($storageFile)) {
        return response()->file($storageFile);
    }
    abort(404);
})->where('path', '.+')->name('storage.fallback');

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
    Route::post('/socios-regenerar-qr', [AdminMemberController::class, 'regenerateAllQrs'])->name('members.regenerate_all_qrs');
    Route::get('/socios/{member}', [AdminMemberController::class, 'show'])->name('members.show');
    Route::get('/socios/{member}/editar', [AdminMemberController::class, 'edit'])->name('members.edit');
    Route::put('/socios/{member}', [AdminMemberController::class, 'update'])->name('members.update');
    Route::delete('/socios/{member}', [AdminMemberController::class, 'destroy'])->name('members.destroy');

    // Member Applications & Psychological Reports Management
    Route::get('/solicitudes', [AdminMemberApplicationController::class, 'index'])->name('applications.index');
    Route::post('/solicitudes', [AdminMemberApplicationController::class, 'store'])->name('applications.store');
    Route::get('/solicitudes/{application}/informe-psicologico', [AdminMemberApplicationController::class, 'psychReport'])->name('applications.psych_report');
    Route::post('/solicitudes/{application}/generar-test', [AdminMemberApplicationController::class, 'generateTestToken'])->name('applications.generate_test');
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
    Route::post('/boletines/{bulletin}/programar', [AdminBulletinController::class, 'schedule'])->name('bulletins.schedule');
    Route::post('/boletines/{bulletin}/procesar-envios', [AdminBulletinController::class, 'processSends'])->name('bulletins.process_sends');
    Route::delete('/boletines/{bulletin}', [AdminBulletinController::class, 'destroy'])->name('bulletins.destroy');

    // AI Content Grid Scheduler
    Route::get('/grilla-contenido', [AdminContentGridController::class, 'index'])->name('content_grid.index');
    Route::post('/grilla-contenido/generar', [AdminContentGridController::class, 'generateGrid'])->name('content_grid.generate');
    Route::post('/grilla-contenido/{item}/programar', [AdminContentGridController::class, 'schedule'])->name('content_grid.schedule');
    Route::post('/grilla-contenido/ejecutar-cron', [AdminContentGridController::class, 'runCronNow'])->name('content_grid.run_cron');
    Route::post('/grilla-contenido/{item}/convertir', [AdminContentGridController::class, 'convertToBulletin'])->name('content_grid.convert');
    Route::delete('/grilla-contenido/{item}', [AdminContentGridController::class, 'destroy'])->name('content_grid.destroy');

    // Settings & API Keys
    Route::get('/configuracion', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::post('/configuracion', [AdminSettingController::class, 'update'])->name('settings.update');
});
