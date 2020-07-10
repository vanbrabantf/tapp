<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use App\Users\UserRepository;
use Illuminate\Http\RedirectResponse;
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

    public function approve(User $user): RedirectResponse
    {
        $user->approve();

        return redirect()->route('admin');
    }

    public function unApprove(User $user): RedirectResponse
    {
        $user->unApprove();

        return redirect()->route('admin');
    }
}
