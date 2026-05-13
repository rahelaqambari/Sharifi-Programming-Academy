<?php

use App\Livewire\Student\ListStudents;
use App\Livewire\Teacher\ListTeachers;
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
    Route::get('manage-students',ListStudents::class)->name('students.index');
    Route::get('manage-teachers',ListTeachers::class)->name('teacher.index');
});

require __DIR__.'/auth.php';
