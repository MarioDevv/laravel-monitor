<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

abstract class Controller
{
    /** @throws ValidationException */
    protected function validate(Request $request, array $rules, array $messages = [], array $customAttributes = []): void
    {
        $request->validate($rules, $messages, $customAttributes);
    }
}
