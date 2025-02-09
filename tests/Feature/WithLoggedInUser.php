<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait WithLoggedInUser
{
    protected function createLoggedInUser(): User
    {
        $user = factory(User::class)->create([
            'name' => 'Ariana Grande',
            'approved_at' => Carbon::now(),
        ]);

        Auth::login($user);

        return $user;
    }

    protected function createUnApprovedLoggedInUser(): User
    {
        $user = factory(User::class)->create([
            'name' => 'Katy Perry',
            'approved_at' => null,
        ]);

        Auth::login($user);

        return $user;
    }

    protected function createLoggedInAdmin(): User
    {
        $user = factory(User::class)->create([
            'name' => 'Billie Eilish',
            'approved_at' => Carbon::now(),
            'is_admin' => true,
        ]);

        Auth::login($user);

        return $user;
    }
}
