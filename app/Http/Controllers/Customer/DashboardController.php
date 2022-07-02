<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use EasyPost\Tracker;
use EasyPost\EasyPost;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Customer\CustomerRepositoryEloquent as Customer;
use App\Repositories\Admin\OrderRepositoryEloquent as Order;
use App\Repositories\Admin\OrderItemRepositoryEloquent as OrderItem;
use App\Repositories\Customer\DeviceRepositoryEloquent as Device;

class DashboardController extends Controller
{
    protected $customerRepo;
    protected $orderItemRepo;
    protected $deviceRepo;

    function __construct(Customer $customerRepo, Order $orderRepo, Device $deviceRepo, OrderItem $orderItemRepo)
    {
        $this->customerRepo = $customerRepo;
        $this->orderRepo = $orderRepo;
        $this->orderItemRepo = $orderItemRepo;
        $this->deviceRepo = $deviceRepo;
    }

    public function index()
    {
        $data['module'] = 'dashboard';
        $customer_id = Auth::guard('customer')->user()->id;

        // rawByField("id = ?", [$id])
        $order_items = $this->orderItemRepo->rawAll("customer_id = ?", [$customer_id]);
        $orders = $this->orderRepo->rawAll("customer_id = ?", [$customer_id]);

        $sum_completed_order_items = 0;

        foreach ($orders as $k => $v) {
            if ($v['status_id'] === 5) {
                $id = $v['id'];
                foreach ($order_items as $k => $v) {
                    if ($v['order_id'] === $id) {
                        $sum_completed_order_items = $sum_completed_order_items + $v['amount'];
                    }
                }
            }
        }

        $data['total_money_earned'] = $sum_completed_order_items;
        $data['total_orders'] = count($orders);

        // return "<pre>" . print_r($sum_completed_order_items, true) . "</pre>";
        return view('customer.dashboard', $data);
    }

    public function getdevices()
    {
        $customer_id = Auth::guard('customer')->user()->id;
        $devices = $this->deviceRepo->rawWith(['product'], "customer_id = ?", [$customer_id]);
        return Datatables::of($devices)
            ->editColumn('device', function ($devices) {
                return $devices->product->model;
            })
            ->editColumn('carrier', function ($devices) {
                return $devices->product->network;
            })
            ->editColumn('storage', function ($devices) {
                return $devices->product->storage;
            })
            ->editColumn('amount', function ($devices) {
                return number_format($devices->amount, 2) . ' USD';
            })
            ->editColumn('status', function ($devices) {
                return 'Pending';
            })
            ->make(true);
    }
}
