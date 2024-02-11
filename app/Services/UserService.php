<?php

namespace App\Services;

use App\Models\User;

/**
 * Class UserService.
 */
class UserService
{
    public function create(array $userData) {
        return User::create($userData);
    }
}
