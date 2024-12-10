<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

route::get('welcome', [Controller::class, 'index']);

//GUEST AUTH
route::middleware(['admin_auth:admin|costumer'])->group(function(){
   route::controller(DashboardController::class)->group(function (){
      route::get('dashboard', 'index'); 
   });
});

   
include "login.php";