<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

//GUSET MIDDLEWARE
route::middleware(['guest'])->group(function(){
    route::prefix('account')->controller(LoginController::class)->group(function(){
        route::get('login', 'showloginpage')->name('login');
        route::post('authenticate', 'authenticate')->name('auth.login');
        route::get('register', 'register')->name('register');
        route::post('register', 'proccesRegister');
    });
});

route::prefix('account')->middleware(['auth'])->group(function(){
    route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

