<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\Users;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AuthController extends \Ulp\Core\Http\Controllers\BaseController {

  // Handle authentication of any user base on their type
  public function login(Request $request) {
    $request->validate([
      'login' => ['required', 'email'],
      'password' => ['required'],
    ]);

    $credentials = [
      'email' => $request->login,
      'password' => $request->password,
    ];

    if (!Auth::attempt($credentials)) {
      return back()->with([
        'error' => 'Nieprawidłowe dane logowania'
      ]);
    }

    if (Auth::user()->type === \Ulp\Core\Enums\UsersType::User->value) {
      Auth::logout();
      return back()->with([
        'error' => 'Zaloguj się jako zwykły użytkownik'
      ]);
    }

    $request->session()->regenerate();
    return redirect()->intended(route('core.dashboard'));
  }

  // show login fomr for users
  public function showLoginForm() {
    return view('core::auth.login');
  }

  // Log the user out of the application.
  public function logout(Request $request): RedirectResponse {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
  }

}