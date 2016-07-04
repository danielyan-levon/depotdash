<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Laravel\Spark\User;
use App\Models\Admin;
use App\Http\Requests\Admin\CreateOrUpdateAdminRequest as Request;

class AdminController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //$this->middleware('auth');
    }

    /**
     * Update the user's profile details.
     *
     * @return Response
     */
    public function index() {
        $viewData = [];
    }

    public function create() {
        return View('admin.pages.admin_create');
    }

    public function store(Request $request) {
        $request->merge(['password' => \Hash::make($request->password)]);

        $user = Admin::create($request->all());

        return redirect()->back();
    }

}
