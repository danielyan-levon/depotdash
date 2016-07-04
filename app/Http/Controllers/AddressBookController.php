<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AddressBook;

class AddressBookController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Update the user's profile details.
     *
     * @return Response
     */
    public function all(Request $request) {
        return $request->user()->addresses()
                        ->orderBy('created_at', 'desc')
                        ->get();
    }

    public function create(Request $request) {
        $request['user_id'] = $request->user()->id;
        AddressBook::create($request->all());
    }

    public function update(Request $request, $addressId) {
        $address = $request->user()->addresses()->where('id', $addressId)->firstOrFail();
        $address->update($request->all());
    }

    public function destroy(Request $request, $addressId) {
        $request->user()->addresses()->where('id', $addressId)->firstOrFail()->delete();
    }

}
