<?php

use Illuminate\Support\Facades\Route;
use Laravelia\Autoposter\Http\Controllers\AutopostController;

Route::get('autopost/share',[AutopostController::class,'share']);