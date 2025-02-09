<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Users\UserRepository;
use Illuminate\View\View;

final class UnapprovedUserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->middleware(['auth']);
        $this->userRepository = $userRepository;
    }

    public function index(): View
    {
        $users = $this->userRepository->getAllUnapprovedUsers();

        return view('users_list', ['users' => $users]);
    }
}
