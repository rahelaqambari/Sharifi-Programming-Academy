<?php

use App\Livewire\Finance\EditPayment;
use App\Livewire\Payment\ListPayments;
use App\Livewire\Sinf\CreateSinf;
use App\Livewire\Sinf\EditSinf;
use App\Livewire\Sinf\ListSinfs;
use App\Livewire\Student\CreateStudent;
use App\Livewire\Student\EditStudent;
use App\Livewire\Student\ListStudents;
use App\Livewire\Teacher\CreateTeacher;
use App\Livewire\Teacher\EditTeacher;
use App\Livewire\Teacher\ListTeachers;
use App\Livewire\User\CreateUser;
use App\Livewire\User\ListUsers;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::middleware(['auth'])->group(function () {
    Route::get('manage-users',ListUsers::class)->name('users.index');
    Route::get('user-create',CreateUser::class)->name('users.create');
    Route::get('manage-students',ListStudents::class)->name('students.index');
    Route::get('student-create',CreateStudent::class)->name('students.create');
    Route::get('manage-student/{record}',EditStudent::class)->name('student.update');
    Route::get('manage-teachers',ListTeachers::class)->name('teachers.index');
    // Route::get('teacher-create',CreateTeacher::class)->name('teachers.create');
    Route::get('manage-teachers/{record}',EditTeacher::class)->name('teacher.update');
    Route::get('manage-sinfs',ListSinfs::class)->name('sinf.index');
    Route::get('sinfs-create',CreateSinf::class)->name('sinf.create');
    Route::get('/manage-sinfs/{record}',EditSinf::class)->name('sinf.update');
    Route::get('/finance-payment',ListPayments::class)->name('payment.index');
    Route::get('/finance-payment/{record}',EditPayment::class)->name('payment.update');
});

require __DIR__.'/auth.php';
