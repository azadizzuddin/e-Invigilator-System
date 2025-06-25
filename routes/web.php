<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvigilatorController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\NotificationController;

// Route for Landing Page
Route::get('/', [LandingPageController::class, 'index'])->name('invigilator.index');

// Routes for Documents functions
Route::get('/admin/documents', [DocumentController::class, 'adminIndex'])->name('admin.documents');
Route::post('/admin/documents/upload', [DocumentController::class, 'upload'])->name('admin.documents.upload');

// Invigilator routes
Route::get('/invigilator/documents', [DocumentController::class, 'invigilatorIndex'])->name('invigilator.documents');

// Download route (shared)
Route::get('/documents/download/{id}', [DocumentController::class, 'download'])->name('documents.download');

// Route for Invigilator Authentication Page
Route::get('invigilator/invigilatorAuthPage', [LandingPageController::class, 'viewInvigilatorAuthPage'])->name('invigilator.invigilatorAuthPage');

// Route for Invigilator Authentication & Validation Process
Route::post('/invigilator/invigilatorAuthPage', [InvigilatorController::class, 'authenticate'])->name('invigilator.login');

// Route for Redirection to Dashboard after Successful Login
Route::get('/invigilator/invigilatorDashboard', [InvigilatorController::class, 'dashboard'])->name('invigilator.dashboard');

// Route for Log Out Process 
Route::post('/invigilator/logout', [InvigilatorController::class, 'logout'])->name('invigilator.logout');       

// Route for Invigilator Profile Page
Route::get('/invigilator/profile', [InvigilatorController::class, 'profile'])->name('invigilator.profile');

// Route to handle profile update
Route::post('/invigilator/profile', [InvigilatorController::class, 'updateProfile'])->name('invigilator.profile.update');

// Route to handle password update
Route::post('/invigilator/password', [InvigilatorController::class, 'updatePassword'])->name('invigilator.password.update');

// Download Schedule
Route::get('/invigilator/schedule/print-pdf', [DocumentController::class, 'printSchedulePdf'])->name('invigilator.schedule.print-pdf');



//---------------------------------------------------------------------------- ADMINISTRATOR -----------------------------------------------------------------------------------------

// AUTHENTICATION --------------------------------------------------------------------------------------------------------------------------------------------------------------------
// ROUTE FOR ADMINISTRATOR AUTH PAGE
Route::get('admin/adminAuthPage', [LandingPageController::class, 'viewAdminAuthPage'])->name('admin.adminAuthPage');

// ROUTE TO SHOW LOGIN FORM
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.loginForm');
Route::post('/admin/login', [AdminController::class, 'authenticateAdmin'])->name('admin.authenticate');

// DASHBOARD REDIRECTION (AFTER SUCCESSFUL LOGIN)
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// ADD ADMIN WITH HASHED PASSWORD
Route::get('/admin/create', [AdminController::class, 'createAdminForm'])->name('admin.createForm');
Route::post('/admin/create', [AdminController::class, 'storeAdmin'])->name('admin.store');
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

// INVIGILATOR MANAGEMENT ------------------------------------------------------------------------------------------------------------------------------------------------------------
// ROUTE FOR ADMIN MANAGE INVIGILATOR PAGE
Route::get('admin/adminManageInvigilator', [AdminController::class, 'manageInvigilators'])->name('admin.adminManageInvigilator');

// FORM TO ADD NEW INVIGILATOR
Route::get('admin/adminAddInvigilator', [AdminController::class, 'addInvigilatorForm'])->name('admin.addInvigilatorForm');
Route::post('admin/adminAddInvigilator', [AdminController::class, 'storeInvigilator'])->name('admin.storeInvigilator');

// IMPORT INVIGILATOR
Route::post('/admin/invigilator/import', [AdminController::class, 'importInvigilators'])->name('admin.invigilators.import');

// FORM TO EDIT INVIGILATOR
Route::get('admin/invigilators/edit/{id}', [AdminController::class, 'editInvigilatorForm'])->name('admin.editInvigilatorForm');
Route::put('admin/invigilators/update/{id}', [AdminController::class, 'updateInvigilator'])->name('admin.updateInvigilator');

// DELETE INVIGILATOR
Route::delete('admin/invigilators/delete/{id}', [AdminController::class, 'deleteInvigilator'])->name('admin.deleteInvigilator');
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

// SCHEDULE MANAGEMENT ---------------------------------------------------------------------------------------------------------------------------------------------------------------
// List & paginate
Route::get('admin/adminManageSchedule', [AdminController::class,'manageSchedule'])->name('admin.adminManageSchedule');

// Add
Route::get('admin/adminAddSchedule', [AdminController::class,'addScheduleForm'])->name('admin.addScheduleForm');
Route::post('admin/adminAddSchedule', [AdminController::class,'storeSchedule'])->name('admin.storeSchedule');
Route::post('admin/importSchedule', [AdminController::class, 'importSchedule'])->name('admin.importSchedule');

// Edit/Update
Route::get('admin/adminEditSchedule/{id}', [AdminController::class,'editScheduleForm'])->name('admin.editScheduleForm');
Route::put('admin/adminEditSchedule/{id}', [AdminController::class,'updateSchedule'])->name('admin.updateSchedule');

// Delete
Route::delete('admin/adminDeleteSchedule/{id}',[AdminController::class,'deleteSchedule'])->name('admin.deleteSchedule');

// NOTIFICATION MANAGEMENT ---------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('admin/notifications', [NotificationController::class, 'index'])->name('admin.notifications');
Route::get('admin/notifications/manual', [NotificationController::class, 'showManualForm'])->name('admin.notifications.manual');
Route::post('admin/notifications/manual', [NotificationController::class, 'sendManual'])->name('admin.notifications.send-manual');
Route::get('admin/notifications/bulk', [NotificationController::class, 'showBulkForm'])->name('admin.notifications.bulk');
Route::post('admin/notifications/bulk', [NotificationController::class, 'sendBulk'])->name('admin.notifications.send-bulk');
Route::post('admin/notifications/test-connection', [NotificationController::class, 'testConnection'])->name('admin.notifications.test-connection');
Route::delete('admin/notifications/{id}', [NotificationController::class, 'destroy'])->name('admin.notifications.delete');

// Route for the admin to view all invigilator Telegram chat IDs
Route::get('/admin/invigilator-chat-ids', [AdminController::class, 'showInvigilatorChatIds'])->name('admin.invigilatorChatIds');

