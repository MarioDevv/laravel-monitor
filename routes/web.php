<?php

use App\Http\Monitor\Client\MonitorsViewController;
use App\Http\Monitor\Client\MonitorViewController;
use App\Http\Monitor\MonitorPostController;
use App\Http\Monitor\MonitorPostPingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/monitors', MonitorsViewController::class)->name('monitors.index');

Route::get('/monitor/new', function () {
    return view('monitors.new', ['monitor' => null]);
})->name('monitors.new');



Route::post('monitor/ping/{id}', MonitorPostPingController::class)->name('monitors.ping');
Route::get('/monitor/{id}', MonitorViewController::class)->name('monitors.show');
Route::post('monitor', MonitorPostController::class)->name('monitors.store');
