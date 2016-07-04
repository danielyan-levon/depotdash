<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class CreateOrUpdateAdminRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => 'required|max:255|min:4',
            'email' => 'required|email|max:255|unique:admins,email,',
            'password' => 'required|min:6|max:14|confirmed',
            'password_confirmation' => 'required|min:6|max:14',
        ];
    }

}
