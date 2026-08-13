<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PlanSubscribeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact', [FrontendController::class, 'contactSubmit'])->name('contact.submit');
Route::get('/quote/{service:slug?}', [FrontendController::class, 'quote'])->name('quote');
Route::post('/quote', [FrontendController::class, 'quoteSubmit'])->name('quote.submit');
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/newsletter/unsubscribe/{token}', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');
Route::get('/plan/{plan}/subscribe', [PlanSubscribeController::class, 'show'])->name('plan.subscribe');
Route::post('/plan/{plan}/subscribe', [PlanSubscribeController::class, 'store'])->name('plan.subscribe.submit');
Route::get('/marketplace', [MarketplaceController::class, 'index'])->name('marketplace.index');
Route::get('/marketplace/{product:slug}', [MarketplaceController::class, 'show'])->name('marketplace.show');
Route::get('/services', [FrontendController::class, 'services'])->name('services.index');
Route::get('/services/{service:slug}', [FrontendController::class, 'serviceShow'])->name('services.show');
Route::get('/team', [FrontendController::class, 'team'])->name('team.index');
Route::get('/team/{member:slug}', [FrontendController::class, 'teamShow'])->name('team.show');
Route::get('/projects', [FrontendController::class, 'projects'])->name('projects.index');
Route::get('/projects/{project:slug}', [FrontendController::class, 'projectShow'])->name('projects.show');
Route::get('/blog', [FrontendController::class, 'blog'])->name('blog.index');
Route::get('/blog/{post:slug}', [FrontendController::class, 'blogShow'])->name('blog.show');
Route::get('/faq', [FrontendController::class, 'faq'])->name('faq');
Route::get('/page/{page:slug}', [FrontendController::class, 'page'])->name('pages.show.prefixed');
Route::get('/{page:slug}', [FrontendController::class, 'page'])
    ->where('page', '^(?!admin|livewire|storage|assets|build|vendor|filament|quote|contact|about|services|team|projects|blog|faq|newsletter|plan|marketplace).*$')
    ->name('pages.show');
