<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use EasyPost\EasyPost;

class CheckADDR extends Controller
{
    public function CheckADDR()
    {
        \EasyPost\EasyPost::setApiKey("EZAK939de41fb9914a1b9f4bf3c3dc9c0e8eZFxyemSCLvKndJIbUhLX5w");

        // this address will be verified
        $address_params = array(
            "verify"  => array("delivery"),
            "street1" => $_GET['street1'],
            "street2" => $_GET['street2'],
            "city"    => $_GET['city'],
            "state"   => $_GET['state'],
            "zip"     => $_GET['zip'],
            "country" => 'US'
            // "company" => "TronicsPay",
            // "phone"   => "415-123-4567"
        );

        $address = \EasyPost\Address::create($address_params);
        $response = json_decode($address->verifications);

        if($response->delivery->success == false) return 0;
        else return 1;
    }
}
