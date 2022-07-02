<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\ProductRequest;
use App\Http\Requests\Admin\ProductDupRequest;
use App\Repositories\Admin\SettingsBrandRepositoryEloquent as Brand;
use App\Repositories\Admin\ConfigRepositoryEloquent as Config;
use App\Repositories\Admin\ProductRepositoryEloquent as Product;
use App\Repositories\Admin\ProductPhotoRepositoryEloquent as ProductPhoto;
use App\Repositories\Admin\NetworkRepositoryEloquent as Network;
use App\Repositories\Admin\ProductNetworkEloquentRepository as ProductNetwork;
use App\Repositories\Admin\ProductStorageEloquentRepository as ProductStorage;
use App\Repositories\Customer\CustomerSellRepositoryEloquent as CustomerSell;
use App\Repositories\Admin\OrderRepositoryEloquent as Order;
use App\Repositories\Admin\OrderItemRepositoryEloquent as OrderItem;
use App\Repositories\Admin\SettingsStatusEloquentRepository as SettingsStatus;

class DatatableController extends Controller
{
    protected $brandRepo;
    protected $productRepo;
    protected $productPhotoRepo;
    protected $configRepo;
    protected $networkRepo;
    protected $productNetworkRepo;
    protected $productStorageRepo;
    protected $customerSellRepo;
    protected $orderRepo;
    protected $orderItemRepo;
    protected $settingsStatusRepo;

    function __construct(
        Brand $brandRepo,
        Product $productRepo,
        ProductPhoto $productPhotoRepo,
        Config $configRepo,
        Network $networkRepo,
        ProductNetwork $productNetworkRepo,
        ProductStorage $productStorageRepo,
        CustomerSell $customerSellRepo,
        Order $orderRepo,
        OrderItem $orderItemRepo,
        SettingsStatus $settingsStatusRepo
    ) {
        $this->brandRepo = $brandRepo;
        $this->productRepo = $productRepo;
        $this->productPhotoRepo = $productPhotoRepo;
        $this->configRepo = $configRepo;
        $this->networkRepo = $networkRepo;
        $this->productNetworkRepo = $productNetworkRepo;
        $this->productStorageRepo = $productStorageRepo;
        $this->customerSellRepo = $customerSellRepo;
        $this->orderRepo = $orderRepo;
        $this->orderItemRepo = $orderItemRepo;
        $this->settingsStatusRepo = $settingsStatusRepo;
    }




    public function DashboardMyDevices()
    {
        $customer_id = Auth::guard('customer')->user()->id;

        $array_ids = [];
        foreach ($this->orderRepo->findByFieldAll('customer_id', $customer_id) as $key => $val) {
            array_push($array_ids, $val['id']);
        }
        $ids = implode(",", $array_ids);

        $devices = $this->orderItemRepo->rawByWithFieldWhereIn(
            [
                'order',
                'order.status_details',
                'order.customer',
                'order.customer.bill',
                'product',
                'product.brand',
                'network',
                'product_storage'
            ],
            'order_id',
            $array_ids
        );

        return Datatables::of($devices)
            ->editColumn('device', function ($order_items) {
                return $order_items->product->model;
            })
            ->editColumn('storage', function ($order_items) {
                return $order_items->product_storage->title;
            })
            ->editColumn('quantity', function ($order_items) {
                return $order_items->quantity;
            })
            ->editColumn('status', function ($order_items) {
                return '<center><small class="badge ' . $order_items['order']['status_details']['badge'] . '">' . strtoupper($order_items['order']['status_details']['name']) . '</small></center>';
                // return '<center><small class="badge badge-warning">'.strtoupper(str_replace("_", " ", $order_items['order']['shipping_status'])).'</small></center>';
            })
            ->addColumn('action', function ($order_items) {
                $html_out  = '';
                $html_out .= '<div class="dropdown">';
                $html_out .= '<button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>';
                $html_out .= '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="action-btn">';
                $html_out .= '<a class="dropdown-item font14px" href="' . url('customer/my-devices/' . $order_items['hashedid']) . '"><i class="fa fa-pencil-alt fa-fw"></i> Review Device Details</a>';
                // $html_out .= '<a class="dropdown-item font14px" href="javascript:void(0)" onclick="cancelOrder(\'' . $order_items['hashedid'] . '\')"><i class="fa fa-trash-alt fa-fw"></i> Cancel</a>';
                $html_out .= '</div>';
                $html_out .= '</div>';
                return $html_out;
            })
            ->rawColumns(['device', 'storage', 'quantity', 'status', 'action'])
            ->make(true);
    }

    public function MyStats()
    {
        $customer_id = Auth::guard('customer')->user()->id;

        $array_ids = [];
        foreach ($this->orderRepo->findByFieldAll('customer_id', $customer_id) as $key => $val) {
            array_push($array_ids, $val['id']);
        }

        $devices = $this->orderItemRepo->rawByWithFieldWhereIn(
            [
                'order',
                'order.status_details',
                'order.customer',
                'order.customer.bill',
                'product',
                'product.brand',
                'network',
                'product_storage'
            ],
            'order_id',
            $array_ids
        );

        return Datatables::of($devices)

            ->editColumn('quantity', function ($order_items) {
                return $order_items->quantity;
            })
            ->editColumn('status', function ($order_items) {
                return '<center><small class="badge ' . $order_items['order']['status_details']['badge'] . '">' . strtoupper($order_items['order']['status_details']['name']) . '</small></center>';
            })
            ->rawColumns(['quantity', 'status'])
            ->make(true);
    }

    public function MyDevices()
    {
        $customer_id = Auth::guard('customer')->user()->id;

        $array_ids = [];
        foreach ($this->orderRepo->findByFieldAll('customer_id', $customer_id) as $key => $val) {
            array_push($array_ids, $val['id']);
        }
        $ids = implode(",", $array_ids);

        $devices = $this->orderItemRepo->rawByWithFieldWhereIn(
            [
                'order',
                'order.status_details',
                'order.customer',
                'order.customer.bill',
                'product',
                'product.brand',
                'network',
                'product_storage'
            ],
            'order_id',
            $array_ids
        );

        return Datatables::of($devices)
            ->editColumn('device', function ($order_items) {
                return $order_items->product->model;
            })
            ->editColumn('carrier', function ($order_items) {
                return '<center>' . $order_items->network->title . '</center>';
            })
            ->editColumn('storage', function ($order_items) {
                return '<center>' . $order_items->product_storage->title . '</center>';
            })
            ->editColumn('quantity', function ($order_items) {
                return '<center>' . $order_items->quantity . '</center>';
            })
            ->editColumn('amount', function ($order_items) {
                return '<div class="pull-right">$' . number_format($order_items->amount, 2, '.', ',') . '</div>';
            })
            ->editColumn('status', function ($order_items) {
                return '<center><small class="badge ' . $order_items['order']['status_details']['badge'] . '">' . strtoupper($order_items['order']['status_details']['name']) . '</small></center>';
            })
            ->addColumn('action', function ($order_items) {
                $html_out  = '';
                $html_out .= '<div class="dropdown">';
                $html_out .= '<button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>';
                $html_out .= '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="action-btn">';
                $html_out .= '<a class="dropdown-item font14px" href="' . url('customer/my-devices/' . $order_items['hashedid']) . '"><i class="fa fa-pencil-alt fa-fw"></i> Edit</a>';
                $html_out .= '<a class="dropdown-item font14px" href="javascript:void(0)" onclick="deleteStatus(\'' . $order_items['hashedid'] . '\')"><i class="fa fa-trash-alt fa-fw"></i> Delete</a>';
                $html_out .= '</div>';
                $html_out .= '</div>';
                return $html_out;
            })
            ->rawColumns(['device', 'carrier', 'storage', 'quantity', 'amount', 'status', 'action'])
            ->make(true);
    }

    public function DashboardMyBundles()
    {
        $customer_id = Auth::guard('customer')->user()->id;

        $orders = $this->orderRepo->rawByWithFieldAll(['order_item'], 'customer_id = ?', [$customer_id]);

        return Datatables::of($orders)
            ->editColumn('order_no', function ($orders) {
                return $orders->order_no;
            })
            ->editColumn('shipping_status', function ($orders) {
                return '<center><small class="badge ' . $orders['status_details']['badge'] . '">' . strtoupper($orders['status_details']['name']) . '</small></center>';
            })
            ->addColumn('action', function ($orders) {
                $html_out  = '';
                $html_out .= '<div class="dropdown">';
                $html_out .= '<button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>';
                $html_out .= '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="action-btn">';
                if ($orders['shipping_label'] != '') {
                    $html_out .= '<a class="dropdown-item font14px" href="' . url('./order/' . $orders['hashedId'] . '/shippinglabel') . '" target="_blank"><i class="nav-icon fas fa-file fa-fw"></i> Shipping Label</a>';
                }
                if ($orders['shipping_tracker'] != '') {
                    $html_out .= '<a class="dropdown-item font14px" href="' . $orders['shipping_tracker'] . '" target="_blank"><i class="nav-icon fas fa-file-alt fa-fw"></i> Track Order</a>';
                }
                $html_out .= '<a class="dropdown-item font14px" href="' . url('customer/my-bundles/' . $orders['hashedid']) . '"><i class="fa fa-pencil-alt fa-fw"></i> Edit</a>';
                $html_out .= '<a class="dropdown-item font14px" href="javascript:void(0)" onclick="cancelOrder(\'' . $orders['hashedid'] . '\')"><i class="fa fa-trash-alt fa-fw"></i> Cancel Order</a>';
                $html_out .= '</div>';
                $html_out .= '</div>';
                return $html_out;
            })
            ->rawColumns(['order_no', 'shipping_status', 'action'])
            ->make(true);
    }

    public function MyBundles()
    {
        $customer_id = Auth::guard('customer')->user()->id;

        $orders = $this->orderRepo->rawByWithFieldAll(['order_item'], 'customer_id = ?', [$customer_id]);

        return Datatables::of($orders)
            ->editColumn('order_no', function ($orders) {
                return $orders->order_no;
            })
            ->editColumn('tracking_code', function ($orders) {
                $html_out  = '';
                $html_out .= '<center>' . $orders->tracking_code . '</center>';
                return $html_out;
            })
            ->editColumn('shipping_status', function ($orders) {
                return '<center><small class="badge ' . $orders['status_details']['badge'] . '">' . strtoupper($orders['status_details']['name']) . '</small></center>';
                // return '<center>'.strtoupper(str_replace("_", "", $orders->shipping_status)).'</center>';
            })
            ->editColumn('transaction_date', function ($orders) {
                return '<center>' . $orders->display_transaction_date . '</center>';
            })
            ->editColumn('delivery_due', function ($orders) {
                return '<center>' . $orders->display_delivery_due . '</center>';
            })
            ->addColumn('action', function ($orders) {
                $html_out  = '';
                $html_out .= '<div class="dropdown">';
                $html_out .= '<button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>';
                $html_out .= '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="action-btn">';

                if ($orders['shipping_label'] != '') {
                    $html_out .= '<a class="dropdown-item font14px" href="' . url('./order/' . $orders['hashedId'] . '/shippinglabel') . '" target="_blank"><i class="nav-icon fas fa-file fa-fw"></i> Shipping Label</a>';
                    // $html_out .= '<a class="dropdown-item font14px" href="'.$orders['shipping_label'].'" target="_blank"><i class="nav-icon fas fa-file fa-fw"></i> Shipping Label</a>';
                }

                if ($orders['shipping_tracker'] != '') {
                    $html_out .= '<a class="dropdown-item font14px" href="' . $orders['shipping_tracker'] . '" target="_blank"><i class="nav-icon fas fa-file-alt fa-fw"></i> Track Order</a>';
                }
                $html_out .= '<a class="dropdown-item font14px" href="' . url('customer/my-bundles/' . $orders['hashedid']) . '"><i class="fa fa-pencil-alt fa-fw"></i> Edit</a>';
                $html_out .= '<a class="dropdown-item font14px" href="javascript:void(0)" onclick="deleteStatus(\'' . $orders['hashedid'] . '\')"><i class="fa fa-trash-alt fa-fw"></i> Delete</a>';
                $html_out .= '</div>';
                $html_out .= '</div>';
                return $html_out;
            })
            ->rawColumns(['order_no', 'tracking_code', 'shipping_status', 'transaction_date', 'delivery_due', 'action'])
            ->make(true);
    }
}
