<?php

use App\Http\Controllers\Monitor\Web\MonitorIndexController;
use App\Http\Controllers\Monitor\Web\MonitorNewController;
use App\Http\Controllers\Monitor\Web\MonitorShowController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('web.home');
})->name('home');


Route::get('/monitor/new', function () {
    return view('web.admin.monitors.new', ['monitor' => null]);
})->name('monitors.new');


Route::get('/monitors', MonitorIndexController::class)->name('monitors.index');
Route::post('monitor', MonitorNewController::class)->name('monitor.store');
Route::get('/monitor/{id}', MonitorShowController::class)->name('monitor.show');
Route::delete('/monitor/{id}', [MonitorIndexController::class, 'delete'])->name('monitor.delete');
Route::post('monitor/ping/{id}', [MonitorShowController::class, 'ping'])->name('monitors.ping');



