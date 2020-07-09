<?php

declare(strict_types=1);

namespace App\Users;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

final class UserRepository
{
    public function getAllUsers(): Collection
    {
        return User::all()->sortBy('name');
    }

    public function getAllApprovedUsers(): Collection
    {
        return User::all()->whereNotNull('approved_at')->sortBy('name');
    }

    public function getAllUnapprovedUsers(): Collection
    {
        return User::all()->whereNull('approved_at')->sortBy('name');
    }
}
