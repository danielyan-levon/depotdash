<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;

class DashboardController extends Controller {

    public $auth;

    public function __construct(Guard $auth) {
        $this->auth = Auth::guard('admin');
    }

    public function index() {
        $viewData = array();
        $viewData['users'] = User::all();        
        return View('admin.pages.home', $viewData);
    }

}
