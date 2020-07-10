<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Users\UserRepository;
use Illuminate\View\View;

final class AdminController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->middleware(['auth', 'admin']);
        $this->userRepository = $userRepository;
    }

    public function index(): View
    {
        $users = $this->userRepository->getAllUsers();

        return view('admin', ['users' => $users]);
    }
}
