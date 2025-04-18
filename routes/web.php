<?php

use App\Http\Controllers\ClasseController;
use App\Http\Controllers\EmploiDuTempsController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\NiveauScolaireController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\AccountantController;


Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/teachers', [StudentController::class, 'index'])->name('teachers.index');
    Route::get('/parents', [ParentController::class, 'index'])->name('parents.index');
    Route::get('/classes', [ClassController::class, 'index'])->name('classes.index');
    Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects.index');
    Route::get('/absences', [AbsenceController::class, 'index'])->name('absences.index');
    Route::get('/grades', [GradeController::class, 'index'])->name('grades.index');
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');

    Route::get('/admin', function () {
        return 'Welcome, Administrator!';
    })->middleware('role:admin')->name('admin');

    Route::get('/teacher', function () {
        return 'Welcome, Teacher!';
    })->middleware('role:teacher')->name('teacher');

    Route::get('/accountant', function () {
        return 'Welcome, Accountant!';
    })->middleware('role:accountant')->name('accountant');

    Route::get('/parent', function () {
        return 'Welcome, Parent!';
    })->middleware('role:parent')->name('parent');

    Route::get('/student', function () {
        return 'Welcome, Student!';
    })->middleware('role:student')->name('student');
});

Route::middleware(['auth'])->group(
    function () {
        Route::resource('students', StudentController::class);
        Route::resource('parents', ParentController::class);
        Route::resource('classes', ClassController::class);
        Route::resource('subjects', SubjectController::class);
        Route::resource('absences', AbsenceController::class);
        Route::resource('grades', GradeController::class);
        Route::resource('payments', PaymentController::class);
        Route::resource('transport', TransportController::class);
        Route::resource('timetable', TimetableController::class);
        Route::resource('teachers', TeacherController::class);
        Route::resource('niveaux_scolaires', NiveauScolaireController::class);
        Route::resource('teachers', TeacherController::class);
        Route::resource('classes', ClasseController::class);
        Route::resource('emplois_du_temps', EmploiDuTempsController::class);
        Route::resource('matieres', MatiereController::class);
    }
)->middleware('role:admin');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
