<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\Users;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AuthController extends \Illuminate\Routing\Controller {

  /**
   * Handle authentication of any user
   */
  public function login(Request $request) {
    $request->validate([
      'login' => ['required', 'email', 'string'],
      'password' => ['required', 'string'],
    ]);

    $credentials = [
      'email' => $request->input('login'),
      'password' => $request->input('password'),
    ];

    if (Auth::guard('web')->attempt($credentials)) {
      /** @var User $user */
      $user = Auth::guard('web')->user();
      // Zablokuj zwykłych użytkowników
      if ($user->type === \Ulp\Core\Enums\UsersType::User->value) {
        Auth::guard('web')->logout();
        return redirect()->back()->with([
          'error' => 'Zaloguj sie jak zwykly urzytkownik'
        ]);
      }
      return redirect()->route('dashboard');
    }
    return redirect()->back()->with([
      'error' => 'Nieprawidłowe dane logowania'
    ]);


  }

  /**
   * 
   */
  public function showLoginForm() {
    return view('core::auth.login');
  }

  /**
  * Log the user out of the application.
  */
  public function logout(Request $request): RedirectResponse {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
  }

}