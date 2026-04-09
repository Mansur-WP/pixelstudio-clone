<?php
use App\Http\Controllers\Staff\StaffDashboardController;
use App\Http\Controllers\Staff\ClientController;
use App\Http\Controllers\Staff\PhotoController;
use App\Http\Controllers\Staff\InvoiceController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Platform\PlatformDashboardController;
use App\Http\Controllers\Platform\PlatformStudioController;
use App\Http\Controllers\Platform\UpgradeRequestController;
use App\Http\Controllers\Platform\PlatformAnalyticsController;
use App\Http\Controllers\Platform\PlatformActivityController;
// Staff routes
Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/staff', [StaffDashboardController::class, 'index'])->name('staff.dashboard');
    Route::get('/staff/clients', [ClientController::class, 'index'])->name('staff.clients');
    Route::get('/staff/clients/new', [ClientController::class, 'create'])->name('staff.clients.create');
    Route::post('/staff/clients', [ClientController::class, 'store'])->name('staff.clients.store');
    Route::get('/staff/clients/{id}', [ClientController::class, 'show'])->name('staff.clients.show');
    Route::get('/staff/clients/{id}/upload', [PhotoController::class, 'create'])->name('staff.photos.create');
    Route::post('/staff/clients/{id}/photos', [PhotoController::class, 'store'])->name('staff.photos.store');
    Route::get('/staff/clients/{id}/invoice', [InvoiceController::class, 'create'])->name('staff.invoice.create');
    Route::post('/staff/clients/{id}/invoices', [InvoiceController::class, 'store'])->name('staff.invoice.store');
    Route::post('/staff/clients/{id}/order-status', [ClientController::class, 'updateOrderStatus'])->name('staff.clients.order-status');
    Route::post('/staff/clients/{id}/deposit', [ClientController::class, 'updateDeposit'])->name('staff.clients.deposit');
    Route::get('/staff/clients/{id}/invoice/{invoiceId}', [InvoiceController::class, 'show'])->name('staff.invoice.show');
    Route::post('/staff/clients/{id}/invoice/{invoiceId}/status', [InvoiceController::class, 'toggleStatus'])->name('staff.invoice.toggle-status');
    Route::post('/staff/clients/{id}/gallery/generate', [ClientController::class, 'generateGallery'])->name('staff.gallery.generate');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/staff', [StaffController::class, 'index'])->name('admin.staff');
    Route::post('/admin/staff', [StaffController::class, 'store'])->name('admin.staff.store');
    Route::put('/admin/staff/{id}', [StaffController::class, 'update'])->name('admin.staff.update');
    Route::delete('/admin/staff/{id}', [StaffController::class, 'destroy'])->name('admin.staff.destroy');
    Route::put('/admin/staff/{id}/status', [StaffController::class, 'toggleStatus'])->name('admin.staff.status');
    Route::get('/admin/payments', [PaymentController::class, 'index'])->name('admin.payments');
    Route::post('/admin/invoices/{id}/mark-paid', [PaymentController::class, 'markPaid'])->name('admin.invoices.mark-paid');
    Route::get('/admin/activity', [ActivityController::class, 'index'])->name('admin.activity');
    Route::get('/admin/settings', [SettingsController::class, 'index'])->name('admin.settings');
    Route::post('/admin/settings', [SettingsController::class, 'update'])->name('admin.settings.update');
});

// Platform routes
Route::middleware(['platform'])->group(function () {
    Route::get('/platform', [PlatformDashboardController::class, 'index'])->name('platform.dashboard');
    Route::get('/platform/studios', [PlatformStudioController::class, 'index'])->name('platform.studios');
    Route::get('/platform/studios/create', [PlatformStudioController::class, 'create'])->name('platform.studios.create');
    Route::get('/platform/studios/{id}', [PlatformStudioController::class, 'show'])->name('platform.studios.show');
    Route::post('/platform/studios', [PlatformStudioController::class, 'store'])->name('platform.studios.store');
    Route::put('/platform/studios/{id}', [PlatformStudioController::class, 'update'])->name('platform.studios.update');
    Route::delete('/platform/studios/{id}', [PlatformStudioController::class, 'destroy'])->name('platform.studios.destroy');
    Route::get('/platform/upgrade-requests', [UpgradeRequestController::class, 'index'])->name('platform.upgrades');
    Route::post('/platform/upgrade-requests/{id}/confirm', [UpgradeRequestController::class, 'confirm'])->name('platform.upgrades.confirm');
    Route::post('/platform/upgrade-requests/{id}/reject', [UpgradeRequestController::class, 'reject'])->name('platform.upgrades.reject');
    Route::get('/platform/analytics', [PlatformAnalyticsController::class, 'index'])->name('platform.analytics');
    Route::get('/platform/activity', [PlatformActivityController::class, 'index'])->name('platform.activity');
    Route::post('/platform/studios/{id}/toggle-status', [PlatformStudioController::class, 'toggleStatus'])->name('platform.studios.toggle');
    Route::post('/platform/studios/{id}/toggle-plan', [PlatformStudioController::class, 'togglePlan'])->name('platform.studios.toggle-plan');
    Route::get('/platform/settings', [\App\Http\Controllers\Platform\PlatformSettingsController::class, 'index'])->name('platform.settings');
    Route::post('/platform/settings', [\App\Http\Controllers\Platform\PlatformSettingsController::class, 'update'])->name('platform.settings.update');
});


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\Public\GalleryController as PublicGalleryController;
use App\Http\Controllers\Public\StudioPageController;

// Public routes
Route::get('/gallery/{token}', [GalleryController::class, 'show'])->name('public.gallery');
Route::get('/s/{slug}', [StudioPageController::class, 'show'])->name('studio.page');
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Auth\PasswordController;

Route::get('/', function () {
    return view('welcome');
});

// Auth routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// OTP/Password reset routes
Route::get('/forgot-password', [OtpController::class, 'showForgotPassword'])->name('forgot.password');
Route::get('/verify-otp', [OtpController::class, 'showVerifyOtp'])->name('verify.otp');
Route::get('/reset-password', [OtpController::class, 'showResetPassword'])->name('reset.password');
Route::post('/auth/request-otp', [OtpController::class, 'requestOtp']);
Route::post('/auth/verify-otp', [OtpController::class, 'verifyOtp']);
Route::post('/auth/reset-password', [OtpController::class, 'resetPassword']);

// Password change (for logged in users)
Route::post('/auth/change-password', [PasswordController::class, 'changePassword'])->middleware('auth');
