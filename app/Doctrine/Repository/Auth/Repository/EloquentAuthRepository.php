<?php

namespace App\Doctrine\Repository\Auth\Repository;

use Illuminate\Support\Facades\Auth;
use MarioDevv\Uptime\Monitoring\Domain\Model\Auth\AuthRepository;
use MarioDevv\Uptime\Monitoring\Domain\Model\Auth\UserData;
use MarioDevv\Uptime\Monitoring\Domain\Model\Auth\UserEmail;
use MarioDevv\Uptime\Monitoring\Domain\Model\Auth\UserPassword;

class EloquentAuthRepository implements AuthRepository
{

    public function byId(int $id): ?UserData
    {
        // TODO: Implement byId() method.
    }

    public function login(UserEmail $email, UserPassword $password): bool
    {

        $attempt = Auth::attempt([
            'email'    => $email->value(),
            'password' => $password->value(),
        ]);

        if (!$attempt) {
            return false;
        }

        return true;

    }

    public function logout(int $id): bool
    {
        // TODO: Implement logout() method.
    }


}
