<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Spark\Spark;

class AddressBook extends Model {

    public $table = 'address_book';
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'mobile_number',
        'other_number',
        'address_1',
        'address_2',
        'address_3',
        'town',
        'country',
        'zip_code',
    ];
    public $timestamps = true;

    public function user() {
        return $this->belongsTo(Spark::userModel(), 'user_id');
    }

}
