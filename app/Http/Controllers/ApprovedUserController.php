<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Users\UserRepository;
use Illuminate\View\View;

final class ApprovedUserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->middleware(['auth', 'approved']);
        $this->userRepository = $userRepository;
    }

    public function index(): View
    {
        $users = $this->userRepository->getAllApprovedUsers();

        return view('users_list', ['users' => $users]);
    }
}
