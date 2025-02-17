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
Route::get('/monitor/{id}', MonitorShowController::class)->name('monitor.show');

Route::post('monitor', MonitorNewController::class)->name('monitor.store');
Route::post('monitor/ping/{id}', [MonitorShowController::class, 'ping'])->name('monitor.ping');

Route::patch('monitor/{id}/stop', [MonitorShowController::class, 'stop'])->name('monitor.stop');
Route::patch('monitor/{id}/resume', [MonitorShowController::class, 'resume'])->name('monitor.resume');


Route::delete('/monitor/{id}', [MonitorIndexController::class, 'delete'])->name('monitor.delete');



