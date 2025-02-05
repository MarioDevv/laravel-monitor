<?php

namespace App\Http\Monitor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MonitorPostController extends Controller
{

    public function __invoke(Request $request)
    {
        Log::info('Hola');
        dd($request->all());
    }

}
