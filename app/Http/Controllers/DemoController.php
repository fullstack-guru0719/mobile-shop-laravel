<?php

namespace App\Http\Controllers;

use EasyPost\Parcel;
use EasyPost\Address;
use EasyPost\Tracker;
use EasyPost\EasyPost;
use EasyPost\Shipment;
use Illuminate\Http\Request;
use App\Repositories\Admin\OrderRepositoryEloquent as Order;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class DemoController extends Controller
{
    protected $orderRepo;
    
    function __construct(Order $orderRepo) 
    {
        $this->orderRepo = $orderRepo;
    }

    public function VerificationPage () 
    {
        
        // return $order = $this->orderRepo->rawByWithField(['customer.bill', 'status_details'], "id = ?", [1]);
        return view('demo.verification.index');
    }
    public function EmailTemplateIndex () 
    {
        
        // return $order = $this->orderRepo->rawByWithField(['customer.bill', 'status_details'], "id = ?", [1]);
        return view('demo.emailtemplate.index');
    }

    public function EmailTemplateCreate () 
    {
        return view('demo.emailtemplate.create');
    }

    public function EmailTemplateEdit () 
    {
        return view('demo.emailtemplate.edit');
    }

    public function EmailTester () 
    {
        $email = 'aen00100@gmail.com';
        $subject = 'email testing';
        
        $subject = "TronicsPay Email Confirmation";
        $content = view('mail.demo')->render();
        $test = Mail::send([], [], function (Message $message) use ($email, $subject, $content) {
            $message->to($email)
                ->subject($subject)
                ->setBody($content, 'text/html');
        });
        return $test;
    }

    public function CreateShipment () 
    {
        EasyPost::setApiKey(config('account.easypost_apikey'));
        // $config = $this->configRepo->find(1);
            
        $to_address = Address::create([
            // "company" => "", // $config->company_name,
            "name" => "Dr. Steve Brule", // $config->company_name, 
            "street1" => "179 N Harbor Dr", //$config->address1,
            // "street2" => $config->address2,
            "city"    => "Redondo Beach", // $config->city,
            "state"   => "CA", // $config->state,
            "zip"     => "90277",  // $config->zip_code,
            "phone"   => "310-808-5243", // $config->phone,
        ]);

        $from_address = Address::create([
            "company" => "EasyPost",
            "street1" => "118 2nd Street",
            "street2" => "4th Floor",
            "city"    => "San Francisco", 
            "state"   => "CA",
            "zip"     => "94105",
            "phone"   => "415-456-7890",
        ]);

        // EasyPost::setApiKey(config('account.easypost_apikey'));
        $parcel = Parcel::create([
            // 'predefined_package' => $this->package($product->height, $product->width),
            'predefinded_package' => '',
            'weight' => '1', // $product->height,
		'height' => '1',
		'width' => '1',
		'length' => '1',
        ]);
        
        $shipment = Shipment::create([
            'to_address'   => $to_address,
            'from_address' => $from_address,
            'parcel'       => $parcel
        ]);

        $shipment->buy($shipment->lowest_rate());
        $shipment->insure(array('amount' => 150));
        echo '<pre>';
        print_r($shipment);
        echo '</pre>';
    }

    public function CheckEasyPostShipment () 
    {
        // $test = EasyPost::setApiKey(config('account.easypost_apikey'));

        // $shipment = EasyPost::Shipment.retrieve('shp_42f2d6738b5b4daab7666856dae1691e');
        // $shipment.insure(array('amount' => 249.99));
        // // return $test;
        // print($shipment.insurance);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.easypost.com/v2/shipments/shp_42f2d6738b5b4daab7666856dae1691e/insure');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "amount=249.99");
        curl_setopt($ch, CURLOPT_USERPWD, 'EZTKe79ac23e1a734b99b4bbf7bcd51a029e0w9CV5oFxE7dlVRg3kOlEg' . ':' . '');

        $headers = array();
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        echo '<pre>';
        print_r($result);
        echo '</pre>';
        
    }
}
