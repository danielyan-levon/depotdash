<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Requests\Admin\CreateOrUpdateCustomerRequest as Request;
use App\Mailers\AppMailer;

class CustomerController extends Controller {

    public $auth;

    public function __construct(Guard $auth) {
        $this->auth = Auth::guard('admin');
    }

    public function index() {
        $viewData = array();
        $viewData['users'] = User::all();
        return View('admin.pages.customers', $viewData);
    }

    public function create() {
        return View('admin.pages.create_customer');
    }

    public function store(Request $request, AppMailer $mailer) {
        $customer = User::create($request->all());
        $mailer->sendEmailInvitationTo($customer);
        return redirect()->back();
    }

}
