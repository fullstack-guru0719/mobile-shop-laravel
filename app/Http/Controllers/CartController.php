<?php

namespace App\Http\Controllers;

use EasyPost\Parcel;
use EasyPost\Address;
use EasyPost\Tracker;
use EasyPost\EasyPost;
use EasyPost\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Saperemarketing\SCart\Facades\Cart;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\Repositories\Admin\SettingsBrandRepositoryEloquent as Brand;
use App\Repositories\Admin\ConfigRepositoryEloquent as Config;
use App\Repositories\Customer\StateRepositoryEloquent as State;
use App\Repositories\Admin\ProductRepositoryEloquent as Product;
use App\Repositories\Customer\CustomerRepositoryEloquent as Customer;
use App\Models\TableList as Tablelist;

class CartController extends Controller
{
    protected $productRepo;
    protected $customerRepo;
    protected $stateRepo;
    protected $configRepo;
    protected $brandRepo;
    protected $tablelist;

    function __construct(Product $productRepo, Customer $customerRepo, State $stateRepo, Config $configRepo, Brand $brandRepo, TableList $tablelist)
    {
        $this->productRepo = $productRepo;
        $this->customerRepo = $customerRepo;
        $this->stateRepo = $stateRepo;
        $this->configRepo = $configRepo;
        $this->brandRepo = $brandRepo;
        $this->tablelist = $tablelist;
    }

    public function index()
    {
        // EasyPost::setApiKey(config('account.easypost_apikey'));
        // $track = Tracker::create([
        //     'tracking_code' => 'EZ4000000004',
        //     'carrier' => 'UPS'
        // ]);
        // echo "<pre>";
        // print_r($track);
        return Cart::count();
    }

    public function store(Request $request)
    {
        $id = $request['product_id'];
        $qty = $request['qty'];
        $product = $this->productRepo->find($id);
        $details = [
            'height' => $product->height,
            'weight' => $product->weight,
            'width' => $product->width,
            'length' => ($product->length) ? $product->length : 0,
            'sku' => $product->sku
        ];
        Cart::add($product->sku, $product->model, $qty, $product->sell_amount, $details);
        $data['cart'] = Cart::content();
        $data['cartcount'] = Cart::count();
        $data['response'] = 1;
        return response()->json($data);
    }

    public function destroy($id)
    {
        Cart::remove($id);
        $data['cartcount'] = Cart::count();
        $data['totalamount'] = Cart::total();
        $data['rowId'] = $id;
        return response()->json($data);
    }

    public function checkout()
    {
        $data['cartcount'] = $activeCart = Cart::count();
        if (!Auth::guard('customer')->check() && $activeCart) {
            return redirect()->to('customer/auth/login');
        }

        if ($activeCart) {
            $data['carts'] = $carts = Cart::content();
            $data['tax'] = Cart::tax();
            $data['totalamount'] = Cart::total();
            $data['stateList'] = $this->stateRepo->selectlist('name', 'abbr');
            if (Auth::guard('customer')->check()) {
                $customer_id = Auth::guard('customer')->user()->id;
                $data['customer'] = $this->customerRepo->findWith($customer_id, ['bill']);
                $parcel = $this->parcel($carts);
                $data['ship'] = $this->shipping($customer_id, $parcel);
            }
            return view('front.checkout', $data);
        }

        $data['brandList'] = $this->brandRepo->selectlist('name', 'id');
        $data['paymentList'] = $this->tablelist->payment_list;
        return view('front.seller.index', $data);
    }

    public function cartCheckout()
    {
        $is_auth = (Auth::guard('customer')->check() != null) ? true : false;
        if ($is_auth) {
            $customer_id = Auth::guard('customer')->user()->id;
            $customer_data = $this->customerRepo->rawByWithField(['addresses'], 'id = ?', [$customer_id]);
            $data['fname'] = $customer_data['fname'];
            $data['lname'] = $customer_data['lname'];
            $data['email'] = $customer_data['email'];

            $has_address = count($customer_data['addresses']) > 0;
            if ($has_address) {
                $address = $customer_data['addresses'][0];
                $data['address1'] = $address['address1'];
                $data['address2'] = $address['address2'];
                $data['city'] = $address['city'];
                $data['state'] = $address['state'];
                $data['zip'] = $address['zip'];
                $data['phone'] = $address['phone'];
            }
        }
        $data['user'] = $is_auth;
        $data['stateList'] = $this->stateRepo->selectlist('name', 'abbr');
        $data['brands'] = $this->brandRepo->all();
        $data['paymentList'] = $this->tablelist->payment_list;
        $config = $this->configRepo->find(1);
        $data['insurance_fee'] = $config->insurance_fee;
        return view("front.cart.checkout", $data);
    }

    public function storecheckout(Request $request)
    {
        session(['session_rate' => $request['rate']]);
        $cartItems = array_map(function ($item) {
            return [
                'name' => $item['name'],
                'price' => $item['price'],
                'qty' => $item['qty'],
            ];
        }, Cart::content()->toArray());
        $checkoutData = [
            'items' => $cartItems,
            'return_url' => route('paypal.success'),
            'cancel_url' => route('paypal.cancel'),
            'invoice_id' => uniqid(),
            'invoice_description' => "Order description",
            'total' => $request['total']
        ];

        $provider = new ExpressCheckout();
        $response = $provider->setExpressCheckout($checkoutData);
        return redirect()->to($response['paypal_link']);
    }

    private function shipping($id, $parcel)
    {
        EasyPost::setApiKey(config('account.easypost_apikey'));
        $customer = $this->customerRepo->findWith($id, ['bill']);
        $config = $this->configRepo->find(1);
        $to_address = Address::create([
            'name'    => $customer->fname . ' ' . $customer->lname,
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
        if ($height <= 8 && $width <= 5) {
            return 'SmallFlatRateBox';
        } elseif (($height > 8 && $width > 5) && ($height <= 11 && $width <= 8)) {
            return 'MediumFlatRateBox';
        } else {
            return 'LargeFlatRateBox';
        }
    }
}
