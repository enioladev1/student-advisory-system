<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student;
use App\Http\Controllers\Advisor;
use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return match(auth()->user()->role) {
            'admin'   => redirect()->route('admin.dashboard'),
            'advisor' => redirect()->route('advisor.dashboard'),
            default   => redirect()->route('student.dashboard'),
        };
    }
    return view('welcome');
});

// Student routes
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::get('/dashboard', [Student\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/courses', [Student\CourseController::class, 'index'])->name('courses.index');

    Route::get('/appointments', [Student\AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/create', [Student\AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [Student\AppointmentController::class, 'store'])->name('appointments.store');
    Route::delete('/appointments/{appointment}', [Student\AppointmentController::class, 'destroy'])->name('appointments.destroy');

    Route::get('/messages', [Student\MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/new', [Student\MessageController::class, 'create'])->name('messages.create');
    Route::post('/messages', [Student\MessageController::class, 'store'])->name('messages.store');
    Route::get('/messages/thread/{user}', [Student\MessageController::class, 'show'])->name('messages.thread');
});

// Advisor routes
Route::middleware(['auth', 'role:advisor'])->prefix('advisor')->name('advisor.')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::get('/dashboard', [Advisor\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/students', [Advisor\StudentController::class, 'index'])->name('students.index');
    Route::get('/students/{student}', [Advisor\StudentController::class, 'show'])->name('students.show');

    Route::get('/appointments', [Advisor\AppointmentController::class, 'index'])->name('appointments.index');
    Route::patch('/appointments/{appointment}', [Advisor\AppointmentController::class, 'update'])->name('appointments.update');

    Route::get('/messages', [Advisor\MessageController::class, 'index'])->name('messages.index');
    Route::post('/messages', [Advisor\MessageController::class, 'store'])->name('messages.store');
    Route::get('/messages/thread/{user}', [Advisor\MessageController::class, 'show'])->name('messages.thread');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/users', [Admin\UserController::class, 'index'])->name('users.index');
    Route::get('/users/create-advisor', [Admin\UserController::class, 'createAdvisor'])->name('users.create-advisor');
    Route::post('/users/create-advisor', [Admin\UserController::class, 'storeAdvisor'])->name('users.store-advisor');
    Route::patch('/users/{user}/toggle-status', [Admin\UserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::delete('/users/{user}', [Admin\UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/courses', [Admin\CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/create', [Admin\CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [Admin\CourseController::class, 'store'])->name('courses.store');
    Route::delete('/courses/{course}', [Admin\CourseController::class, 'destroy'])->name('courses.destroy');

    Route::get('/assignments', [Admin\AssignmentController::class, 'index'])->name('assignments.index');
    Route::post('/assignments/assign', [Admin\AssignmentController::class, 'assign'])->name('assignments.assign');
    Route::post('/assignments/unassign', [Admin\AssignmentController::class, 'unassign'])->name('assignments.unassign');

    Route::get('/students/{student}/progress', [Admin\StudentProgressController::class, 'show'])->name('students.progress');
    Route::post('/students/{student}/score', [Admin\StudentProgressController::class, 'updateScore'])->name('students.update-score');
});

require __DIR__.'/auth.php';
