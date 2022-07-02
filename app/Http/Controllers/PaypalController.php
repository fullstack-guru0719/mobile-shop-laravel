<?php

namespace App\Http\Controllers;

use EasyPost\Parcel;
use EasyPost\Address;
use EasyPost\EasyPost;
use EasyPost\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Saperemarketing\SCart\Facades\Cart;
use App\Repositories\Admin\ConfigRepositoryEloquent as Config;
use App\Repositories\Admin\ProductRepositoryEloquent as Product;
use App\Repositories\Customer\CustomerRepositoryEloquent as Customer;
use App\Repositories\Admin\OrderRepositoryEloquent as Order;
use App\Repositories\Admin\ShipmentRepositoryEloquent as ShipmentModel;

class PaypalController extends Controller
{
    protected $productRepo;
    protected $customerRepo;
    protected $stateRepo;
    protected $configRepo;
    protected $orderRepo;
    protected $shipmentRepo;

    function __construct(Product $productRepo, Customer $customerRepo, Config $configRepo, Order $orderRepo, ShipmentModel $shipmentRepo)
    {
        $this->productRepo = $productRepo;
        $this->customerRepo = $customerRepo;
        $this->configRepo = $configRepo;
        $this->orderRepo = $orderRepo;
        $this->shipmentRepo = $shipmentRepo;
    }

    public function success()
    {
        $carts = Cart::content();
        $tax = Cart::tax();
        $customer_id = Auth::guard('customer')->user()->id;
        $data['customer'] = $this->customerRepo->findWith($customer_id, ['bill']);
        $parcel = $this->parcel($carts);
        $shipment = $this->shipping($customer_id, $parcel);
        $shipment->buy($shipment->lowest_rate());
        $shiparr = $shipment->insure(array('amount' => 1));
        $cartTotal = str_replace(',','',Cart::total());
        $makeRequest = [
            'order_number' => uniqid(),
            'customer_id' => $customer_id,
            'tax' => $tax,
            'sub_total' => str_replace(',','',Cart::subtotal()),
            'shipping_fee' => $shiparr->rates[0]->retail_rate,
            'total_cost' => $cartTotal + $shiparr->rates[0]->retail_rate,
            'status' => 'Pending'
        ];
        $order = $this->orderRepo->create($makeRequest);
        $this->storeShipment($shiparr, $order->id);
        Cart::destroy();
        return view('front.checkoutsuccess');
    }

    private function shipping($id, $parcel)
    {
        EasyPost::setApiKey(config('account.easypost_apikey'));
        $customer = $this->customerRepo->findWith($id, ['bill']);
        $config = $this->configRepo->find(1);
        $to_address = Address::create([
            'name'    => $customer->fname.' '.$customer->lname,
            'street1' => (!empty($customer->bill)) ? $customer->bill->street : '',
            'city'    => (!empty($customer->bill)) ? $customer->bill->city : '',
            'state'   => (!empty($customer->bill)) ? $customer->bill->state : '',
            'zip'     => (!empty($customer->bill)) ? $customer->bill->zip : '',
            'phone'   => (!empty($customer->bill)) ? $customer->bill->phone : ''
        ]);

        $from_address = Address::create([
            'company' => $config->company_name,
            'street1' => '1214 S Noland Rd',
            'street2' => '',
            'city'    => 'Independence',
            'state'   => 'MO',
            'zip'     => '64055',
            'phone'   => '415-456-7890'
        ]);

        $shipment = Shipment::create([
            'to_address'   => $to_address,
            'from_address' => $from_address,
            'parcel'       => $parcel
        ]);
        
        return $shipment;
    }

    private function parcel($carts)
    {
        EasyPost::setApiKey(config('account.easypost_apikey'));
        $weight = 0;
        $height = 0;
        $width  = 0;
        $length = 0;
        foreach ($carts as $cart) {
            $height += $cart->options->height;
            $weight += $cart->options->weight;
            $width  += $cart->options->width;
            $length += $cart->options->length;
        }

        return Parcel::create([
            'predefined_package' => $this->package($height, $width),
            'height' => $height,
            'weight' => $weight,
            'width'  => $width,
            'length' => $length,
        ]);
    }

    private function package($height, $width)
    {
        if($height <= 8 && $width <= 5){
            return 'SmallFlatRateBox';
        } elseif(($height > 8 && $width > 5) && ($height <= 11 && $width <= 8)){
            return 'MediumFlatRateBox';
        } else {
            return 'LargeFlatRateBox';
        }
    }

    private function storeShipment($array, $orderId)
    {
        $makeRequest = [
            'order_id' => $orderId,
            'tracking_number' => $array->tracking_code,
            'carrier' => $array->rates[0]->carrier,
            'carrier_id' => $array->rates[0]->carrier_account_id,
            'shipping_fee' => (session('session_rate')) ? session('session_rate') : $array->rates[0]->retail_rate,
            'delivery_days' => $array->rates[0]->delivery_days,
            'shipment_id' => $array->rates[0]->shipment_id,
            'label_url' => $array->postage_label->label_url,
            'est_delivery_date' => $array->rates[0]->delivery_date,
            'status' => $array->status,
        ];
        
        $this->shipmentRepo->create($makeRequest);
    }
}
