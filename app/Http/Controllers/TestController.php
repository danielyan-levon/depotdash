<?php

namespace App\Http\Controllers;

use App\Helpers\MailProviders\MailProviders;

use App\Http\Requests;

class TestController extends Controller
{

    public function index()
    {

        $service = MailProviders::service('UKMail');

        $cons = $service->AddDomesticConsignment();

//        $cancel = $service->CancelConsignment([
//            'ConsignmentNumber' => '41080580000002',
//        ]);

        dd($cons);
    }
}
