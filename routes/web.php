<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/any-route', function () {
    Artisan::call('storage:link');
  });

// Route::view('/', 'welcome');

Route::view('/dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');
Route::view('/profile', 'profile')->middleware(['auth'])->name('profile');

require __DIR__.'/auth.php';

Route::get('/', App\Livewire\Pages\Public\Home\Index::class)->name('home');
Route::get('/about-us', App\Livewire\Pages\Public\About\Index::class)->name('about');
Route::get('/calendar-of-events', App\Livewire\Pages\Public\CalendarOfEvents\Index::class)->name('calendar-of-events');
Route::get('/frequently-asked-questions', App\Livewire\Pages\Public\FrequentlyAskedQuestions\Index::class)->name('frequently-asked-questions');

Route::prefix('event')->group(function () {
    Route::get('/{id}/{slug}', App\Livewire\Pages\Public\Events\Detail::class);
    Route::get('/spotlight', App\Livewire\Pages\Public\Events\Spotlight::class);
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', App\Livewire\Pages\Admin\Home\Index::class)->name('admin.home');

    Route::prefix('event')->group(function () {
        Route::get('/', App\Livewire\Pages\Admin\Event\Index::class)->name('event');
        Route::get('/create', App\Livewire\Pages\Admin\Event\Create::class)->name('create-event');
        Route::get('/edit/{id}', App\Livewire\Pages\Admin\Event\Edit::class)->name('edit-event');
        Route::get('/spotlight', App\Livewire\Pages\Admin\Event\Spotlight::class)->name('event-spotlight');
    });

    Route::get('/user', App\Livewire\Pages\Admin\User\Index::class)->name('admin.user');
    Route::get('/gallery', App\Livewire\Pages\Admin\Gallery\Index::class)->name('admin.gallery');
    Route::get('/frequently-asked-question', App\Livewire\Pages\Admin\FrequentlyAskedQuestion\Index::class)->name('admin.frequently-asked-question');
    Route::get('/profile', App\Livewire\Pages\Admin\Profile\Index::class)->name('admin.profile');
});
