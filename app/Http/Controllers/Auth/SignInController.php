<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use MarioDevv\Uptime\Monitoring\Application\Login\Login;
use MarioDevv\Uptime\Monitoring\Application\Login\LoginRequest;
use MarioDevv\Uptime\Monitoring\Domain\DomainException;
use Throwable;

class SignInController extends Controller
{

    private Login $loginService;

    public function __construct(Login $loginService)
    {
        $this->loginService = $loginService;
    }


    public function __invoke(Request $request)
    {

        // If user logged in return to dashboard
        if ($request->user()) {
            dd($request->user());
        }

        try {

            $this->validate($request, [
                'email'    => 'required|string',
                'password' => 'required|string',
            ]);

            ($this->loginService)
            (new LoginRequest(
                $request->input('email'),
                $request->input('password')
            ));

            $request->session()->regenerate();

            return redirect()->route('home');

        } catch (ValidationException|DomainException $e) {
            return back()->with('error', $e->getMessage());

        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return back()->with('error', 'Something went wrong');
        }


    }

}
