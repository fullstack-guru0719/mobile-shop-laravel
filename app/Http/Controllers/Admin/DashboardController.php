<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Order;
use App\Models\Admin\Product;
use App\Models\Admin\ProductStorage;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Repositories\Admin\ConfigRepositoryEloquent as Config;
use Carbon\Carbon;

class DashboardController extends Controller
{
    protected $configRepo;

    public function __construct(Config $configRepo)
    {
        $this->configRepo = $configRepo;
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['module'] = 'dashboard';
        $total_products_count = Product::count();
        $data['products_percentage'] = $total_products_count ? (Product::where('status','active')->count() / $total_products_count) * 100 : 0;
        $data['orders_count'] = Order::count();
        $data['customers_count'] = Customer::count();
        $data['selling_devices_count'] = ProductStorage::whereNotNull('amount')->count();
        $config = $this->configRepo->find(1);
        $data['is_dark_mode'] = ($config['is_dark_mode'] == 1) ? true : false;
        return view('admin.dashboard.index', $data);
    }

    public function trying_view()
    {
        $data['fname'] = "Rayamrt";
        $data['email'] = "Palermo";
        $data['password'] = "password";
        $data['company_email'] ="company_email@gmail.com";
        $data['model'] = "samung galaxy s5";
        $data['order'] = [
            "customer" => [
                "fullname" => "raymart palermo",
                "bill" => [
                    "address1" => "address 1",
                    "phone" => "bill phone",
                ],
                "email" => "customer@email.com",
            ],
            "status" => [
                "name" => "pending",
            ],
            "order_no" => "order no",
            "tracking_code" => "order tracking code",
            "display_delivery_due" => Carbon::now()->toDateTimeString(),
            "order_item" => [
                [
                    "quantity" => 12,
                    "amount" => 12,
                    "product" => [
                        "brand" => [
                            "name" => "samsung",
                        ],
                        "model" => "galaxy s5",
                    ],
                    "product_storage" => [
                        "title" => "product storage title"
                    ],
                    "device_type" => 1,
                    "network" => [
                        "title" => "network title"
                    ],
                ]
            ],
            "payment_method" => "google pay",
            "account_bank" => "account bank",
            "account_name" => "account_name",
            "account_number" => "account_number",
            "account_username" => "account_username",
            "hashedId" => "hashed_id"
        ];

        // $data['order'] = $this->orderRepo->findWith($order->id, [
        //     'customer', 
        //     'customer.bill',
        //     'order_item',
        //     'order_item.product',
        //     'order_item.product.brand',
        //     'order_item.network',
        //     'order_item.product_storage'
        //     ]);

        $data['config'] = $this->configRepo->find(1);

        $data['shippingFee'] = 10;
        $data['overallSubTotal'] = 0;
        $data['counter'] = 1;
        $data['isRegistered'] = true;
        $data['header'] = "TronicsPay Order Confirmation";

        return view('mail.customer', $data);
    }
}


