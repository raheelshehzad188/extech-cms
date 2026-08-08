<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact', [FrontendController::class, 'contactSubmit'])->name('contact.submit');
Route::get('/services', [FrontendController::class, 'services'])->name('services.index');
Route::get('/services/{service:slug}', [FrontendController::class, 'serviceShow'])->name('services.show');
Route::get('/team', [FrontendController::class, 'team'])->name('team.index');
Route::get('/team/{member:slug}', [FrontendController::class, 'teamShow'])->name('team.show');
Route::get('/projects', [FrontendController::class, 'projects'])->name('projects.index');
Route::get('/projects/{project:slug}', [FrontendController::class, 'projectShow'])->name('projects.show');
Route::get('/blog', [FrontendController::class, 'blog'])->name('blog.index');
Route::get('/blog/{post:slug}', [FrontendController::class, 'blogShow'])->name('blog.show');
Route::get('/faq', [FrontendController::class, 'faq'])->name('faq');
Route::get('/page/{page:slug}', [FrontendController::class, 'page'])->name('pages.show');
