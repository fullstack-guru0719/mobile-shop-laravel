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
use App\Repositories\Customer\CustomerRepositoryEloquent as Customer;

class ProfileController extends Controller
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
    protected $customerRepo;

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
                        SettingsStatus $settingsStatusRepo, 
                        Customer $customerRepo
                        )
    {
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
        $this->customerRepo = $customerRepo;
    }
    
    public function index () 
    {
        $customer_id = Auth::guard('customer')->user()->id;
        $data['user'] = $this->customerRepo->rawByWithField(['addresses'], 'id = ?', [$customer_id]);
        $data['module'] = 'profile';
        return view('customer.profile.index', $data);
        return 'asd';
    }
    

    public function DashboardMyDevices()
    {
        $customer_id = Auth::guard('customer')->user()->id;
        
        $array_ids = [];
        foreach ($this->orderRepo->findByFieldAll('customer_id', $customer_id) as $key => $val) 
        {
            array_push($array_ids, $val['id']);
        }
        $ids = implode(",", $array_ids);
        
        $devices = $this->orderItemRepo->rawByWithFieldWhereIn(
                                    [
                                        'order',
                                        'order.customer',
                                        'order.customer.bill',
                                        'product',
                                        'product.brand',
                                        'network',
                                        'product_storage'
                                    ]
                                    , 'order_id', 
                                    $array_ids);
                                    
        return Datatables::of($devices)
        ->editColumn('device', function($order_items) {
            return $order_items->product->model;
        })
        ->editColumn('storage', function($order_items) {
            return $order_items->product_storage->title;
        })
        ->editColumn('quantity', function($order_items) {
            return $order_items->quantity;
        })
        ->editColumn('status', function ($order_items) {
            return '<center><small class="badge badge-warning">Pending</small></center>';
        })
        ->addColumn('action', function ($order_items) {
            $html_out  = '';
            $html_out .= '<center>';
            $html_out .= '<a href="'.url('customer/my-devices/'.$order_items['hashedid']).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-alt fa-fw"></i></a>';
            $html_out .= '<a href="javascript:void(0)" onclick="deleteStatus('.$order_items['hashedid'].')" class="btn btn-danger btn-xs btn-flat"><i class="fa fa-trash-alt fa-fw"></i></a>';
            $html_out .= '</center>';
            return $html_out;
        })
        ->rawColumns(['device', 'storage', 'quantity', 'status', 'action'])
        ->make(true);
    }

    public function MyDevices()
    {
        $customer_id = Auth::guard('customer')->user()->id;
        
        $array_ids = [];
        foreach ($this->orderRepo->findByFieldAll('customer_id', $customer_id) as $key => $val) 
        {
            array_push($array_ids, $val['id']);
        }
        $ids = implode(",", $array_ids);
        
        $devices = $this->orderItemRepo->rawByWithFieldWhereIn(
                                    [
                                        'order',
                                        'order.customer',
                                        'order.customer.bill',
                                        'product',
                                        'product.brand',
                                        'network',
                                        'product_storage'
                                    ]
                                    , 'order_id', 
                                    $array_ids);
                                    
        return Datatables::of($devices)
        ->editColumn('device', function($order_items) {
            return $order_items->product->model;
        })
        ->editColumn('carrier', function($order_items) {
            return '<center>'.$order_items->network->title.'</center>';
        })
        ->editColumn('storage', function($order_items) {
            return '<center>'.$order_items->product_storage->title.'</center>';
        })
        ->editColumn('quantity', function($order_items) {
            return '<center>'.$order_items->quantity.'</center>';
        })
        ->editColumn('amount', function ($order_items) {
            return '<div class="pull-right">$'.number_format($order_items->amount, 2, '.', ',').'</div>';
        })
        ->editColumn('status', function ($order_items) {
            return '<center><small class="badge badge-warning">Pending</small></center>';
        })
        ->addColumn('action', function ($order_items) {
            $html_out  = '';
            $html_out .= '<center>';
            $html_out .= '<a href="'.url('customer/my-devices/'.$order_items['hashedid']).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-alt fa-fw"></i></a>';
            $html_out .= '<a href="javascript:void(0)" onclick="deleteStatus('.$order_items['hashedid'].')" class="btn btn-danger btn-xs btn-flat"><i class="fa fa-trash-alt fa-fw"></i></a>';
            $html_out .= '</center>';
            return $html_out;
        })
        ->rawColumns(['device', 'carrier', 'storage', 'quantity', 'amount', 'status', 'action'])
        ->make(true);
    }

    public function verification () 
    {
        return view('customer.verification.index');
    }


    // public function GetBrands()
    // {
    //     $brands = $this->brandRepo->all();
    //     return Datatables::of($brands)
    //     ->editColumn('photo', function($brands) {
    //         if($brands->photo){
    //             return '<img src="'.url($brands->photo).'" style="width: 80px; height: auto">';
    //         }
    //         return '';
    //     })
    //     ->editColumn('updated_at', function($brands) {
    //         return $brands->updated_at_display;
    //     })
    //     ->addColumn('action', function ($brands) {
    //         $html_out  = '';
    //         $html_out .= '<a href="javascript:void(0)" onclick="updatebrand(\''.$brands->id.'\')" class="btn btn-success btn-xs btn-flat"><i class="fa fa-pencil-alt fa-fw"></i> &nbsp;Edit</a>&nbsp;&nbsp;';
    //         $html_out .= '<a href="javascript:void(0)" onclick="deletebrand(\''.$brands->id.'\')" class="btn btn-danger btn-xs btn-flat"><i class="fa fa-trash-alt fa-fw"></i> &nbsp;Delete</a>';
    //         return $html_out;
    //     })
    //     ->rawColumns(['photo', 'action'])
    //     ->make(true);
    // }

    // public function GetStatuses()
    // {
    //     $status = $this->settingsStatusRepo->all();
    //     return Datatables::of($status)
    //     ->editColumn('name', function($status) {
    //         return $status->name;
    //     })
    //     ->editColumn('module', function($status) {
    //         return $status->module;
    //     })
    //     ->editColumn('email_sending', function($status) {
    //         return $status->email_sending.'d';
    //     })
    //     ->editColumn('default', function($status) {
    //         return ($status->default == 1) ? '<span class="label label-info">Default</span>' : '';
    //     })
    //     ->addColumn('action', function ($status) {
    //         $html_out  = '';
    //         $html_out .= '<a href="javascript:void(0)" onclick="editStatus(\''.$status->hashedid.'\')" class="btn btn-primary btn-xs btn-flat"><i class="fa fa-pencil-alt fa-fw"></i> &nbsp;Edit</a>&nbsp;&nbsp;';
    //         $html_out .= '<a href="javascript:void(0)" onclick="deleteStatus(\''.$status->hashedid.'\')" class="btn btn-danger btn-xs btn-flat"><i class="fa fa-trash-alt fa-fw"></i> &nbsp;Delete</a>';
    //         return $html_out;
    //     })
    //     ->rawColumns(['name', 'module', 'email_sending', 'default', 'action'])
    //     ->make(true);
    // }

    // public function getOrders (Request $request) 
    // {
    //     $orders = $this->orderRepo->rawWith([
    //                                                         'customer',
    //                                                         'order_item', 
    //                                                         'order_item.customer',
    //                                                         'order_item.product', 
    //                                                         'order_item.product.brand', 
    //                                                         'order_item.product.photo', 
    //                                                         'order_item.network', 
    //                                                     ], 
    //                                                     "1 = ?", 
    //                                                     [1]);
                                                        
    //     return Datatables::of($orders)
    //     ->editColumn('seller_name', function($orders) {
    //         $html  = $orders['customer']['fullname'];
    //         return $html;
    //     })
    //     ->editColumn('order_no', function($orders) {
    //         $html  = $orders['order_no'];
    //         return $html;
    //     })
    //     ->editColumn('status', function($orders) {
    //         $html  = $orders['status']['name'];
    //         return $html;
    //     })
    //     ->editColumn('transaction_date', function($orders) {
    //         $html  = $orders['display_transaction_date'];
    //         return $html;
    //     })
    //     ->editColumn('delivery_due', function($orders) {
    //         $html  = $orders['display_delivery_due'];
    //         return $html;
    //     })
    //     ->addColumn('action', function ($orders) {
    //         $html_out  = '';
    //         $html_out .= '<div class="dropdown">';
    //             $html_out .= '<button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>';
    //             $html_out .= '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="action-btn">';
    //                 $html_out .= '<a class="dropdown-item" href="'.url('admin/orders/'.$orders['hashedid']).'/edit">Edit</a>';
    //                 $html_out .= '<a class="dropdown-item" href="javascript:void(0)" onclick="deleteproduct(\''.$orders['hashedid'].'\')">Delete</a>';
    //             $html_out .= '</div>';
    //         $html_out .= '</div>';
    //         return $html_out;
    //     })
    //     // ->rawColumns(['photo', 'action', 'model','brand','amount'])
    //     ->rawColumns(['order_no', 'seller_name', 'status', 'transaction_date', 'delivery_due', 'action'])
    //     ->make(true);
    // }
    
    
    
}
