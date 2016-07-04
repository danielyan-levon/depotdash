<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;

class AuthController extends Controller {

    use AuthenticatesAndRegistersUsers,
        ThrottlesLogins;

    protected $redirectTo = '/admin/dashboard';
    protected $guard = 'admin';

    public function showLoginForm() {
        return view('admin.pages.auth.login');
    }

}
