<?php

use App\Http\Monitor\Client\MonitorViewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/monitors', MonitorViewController::class)->name('monitors.index');
