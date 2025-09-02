<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::post('/contact/store', [PageController::class, 'contactStore'])->name('contact.store');

Route::get('/faqs', [PageController::class, 'faqs'])->name('faqs');

Route::get('/services', [PageController::class, 'services'])->name('services');

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/user.php';
require_once __DIR__ . '/master.php';
require_once __DIR__ . '/admin.php';
