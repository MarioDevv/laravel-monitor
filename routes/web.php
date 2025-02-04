<?php

use App\Http\Monitor\Client\MonitorsViewController;
use App\Http\Monitor\Client\MonitorViewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/monitors', MonitorsViewController::class)->name('monitors.index');

Route::get('/monitor/new', function () {
    return view('monitors.new');
})->name('monitors.new');


Route::get('/monitor/{id}', MonitorViewController::class)->name('monitors.show');

