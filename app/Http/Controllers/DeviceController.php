<?php

namespace App\Http\Controllers;

use EasyPost\Parcel;
use EasyPost\Address;
use EasyPost\Tracker;
use EasyPost\EasyPost;
use EasyPost\Shipment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\SellRequest;
use App\Repositories\Admin\SettingsBrandRepositoryEloquent as Brand;
use App\Repositories\Admin\ConfigRepositoryEloquent as Config;
use App\Repositories\Customer\StateRepositoryEloquent as State;
use App\Repositories\Admin\ProductRepositoryEloquent as Product;
use App\Repositories\Admin\ProductStorageEloquentRepository as ProductStorage;
use App\Repositories\Customer\DeviceRepositoryEloquent as Device;
use App\Repositories\Customer\CustomerRepositoryEloquent as Customer;
use App\Repositories\Customer\CustomerAddressRepositoryEloquent as CustomerAddress;
use App\Repositories\Customer\CustomerOrdersRepositoryEloquent as CustomerOrder;
use App\Repositories\Customer\CustomerSellRepositoryEloquent as CustomerSell;
use App\Repositories\Admin\OrderRepositoryEloquent as Order;
use App\Repositories\Admin\OrderItemRepositoryEloquent as OrderItem;
use App\Repositories\Customer\CustomerTransactionRepositoryEloquent as CustomerTransaction;
use App\Repositories\Admin\NetworkRepositoryEloquent as Network;
use App\Models\Admin\Product as ModelProduct;
use App\Models\Admin\ProductStorage as StorageProduct;
use App\Models\Admin\TemplateSms;
use App\Models\TableList as Tablelist;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PDF, DB;

class DeviceController extends Controller
{
    protected $brandRepo;
    protected $productRepo;
    protected $stateRepo;
    protected $customerRepo;
    protected $addressRepo;
    protected $deviceRepo;
    protected $configRepo;
    protected $productStorageRepo;
    protected $customerOrderRepo;
    protected $customerSellRepo;
    protected $customerTransactionRepo;
    protected $product;
    protected $orderRepo;
    protected $orderItemRepo;
    protected $tablelist;
    protected $network;
    protected $storageProduct;

    function __construct(
        Brand $brandRepo,
        Product $productRepo,
        State $stateRepo,
        Customer $customerRepo,
        CustomerAddress $addressRepo,
        Device $deviceRepo,
        Config $configRepo,
        ProductStorage $productStorageRepo,
        CustomerOrder $customerOrderRepo,
        CustomerSell $customerSellRepo,
        CustomerTransaction $customerTransactionRepo,
        ModelProduct $product,
        Order $orderRepo,
        OrderItem $orderItemRepo,
        TableList $tablelist,
        Network $network,
        StorageProduct $storageProduct
    ) {
        $this->brandRepo = $brandRepo;
        $this->productRepo = $productRepo;
        $this->stateRepo = $stateRepo;
        $this->customerRepo = $customerRepo;
        $this->addressRepo = $addressRepo;
        $this->deviceRepo = $deviceRepo;
        $this->configRepo = $configRepo;
        $this->productStorageRepo = $productStorageRepo;
        $this->customerOrderRepo = $customerOrderRepo;
        $this->customerSellRepo = $customerSellRepo;
        $this->customerTransactionRepo = $customerTransactionRepo;
        $this->product = $product;
        $this->orderRepo = $orderRepo;
        $this->orderItemRepo = $orderItemRepo;
        $this->tablelist = $tablelist;
        $this->network = $network;
        $this->storageProduct = $storageProduct;
    }


    public function checkout($brand)
    {
        $data['isValidAuthentication'] = (Auth::guard('customer')->check() != null) ? true : false;
        $data['brand'] = $brand;
        $data['stateList'] = $this->stateRepo->selectlist('name', 'abbr');
        $data['paymentList'] = $this->tablelist->payment_list;
        $brandDetails = $this->brandRepo->findByField('name', $brand);
        $data['chkproduct'] = $this->productRepo->rawCount("brand_id = ?", [$brandDetails->id]);

        $data['networks'] =  $this->productRepo->queryTable()->whereRaw("brand_id = ? AND status = 'active' AND device_type IN ('Buy', 'Both')", [$brandDetails->id])->groupBy('network')->get();
        $data['brandDetails'] = $brandDetails;
        // $allProducts = $this->productRepo->rawByWithFieldAll(['photo'], "brand_id = ?", [$brandDetails->id], 'model');
        $allProducts = ModelProduct::with(['photo'])
            ->where('brand_id', "=", $brandDetails->id)
            ->orderBy('priority', 'asc')
            ->get();
        $data['products'] = [];
        foreach ($allProducts as $key => $val) {
            $product = $this->product->where('status', 'active')->find($val['id']);
            if ($product) {
                if ($product->storagesForBuying()->count() >= 1) {
                    $data['products'][$key] = $val;
                    $data['products'][$key]['storages'] = $this->product->find($val['id'])->storagesForBuying()->get();
                }
            }
        }

        $data['meta'] = [
            '<meta name="title" content="' . $brand . ' - TronicsPay" />',
            '<meta name="description" content="TronicsPay.com - Sell your Smartphones for CASH. You\'re guaranteed the highest offers, free shipping, and SAME-DAY payment.  100% satisfaction is guaranteed, or we will return your phone at no cost." />',
            '<meta property="og:type" content="article" />',
            '<meta property="og:title" content="' . $brand . ' - TronicsPay" />',
            '<meta property="og:url" content="' . url('/products/category/' . $brand . '/') . '" />',
            '<meta property="og:description" content="TronicsPay.com - Sell your Smartphones for CASH. You\'re guaranteed the highest offers, free shipping, and SAME-DAY payment.  100% satisfaction is guaranteed, or we will return your phone at no cost." />',
            '<meta name="twitter:title" content="' . $brand . ' - TronicsPay" />',
            '<meta name="twitter:image" content="' . url('/' . $brandDetails->full_size) . '" />',
            '<meta name="twitter:url" content="' . url('/products/category/' . $brand . '/') . '" />',
            '<meta name="twitter:description" content="TronicsPay.com - Sell your Smartphones for CASH. You\'re guaranteed the highest offers, free shipping, and SAME-DAY payment.  100% satisfaction is guaranteed, or we will return your phone at no cost." />'
        ];

        return view('front.device.checkout', $data);
    }

    public function checkoutsearch(Request $request)
    {

            $q = $request->query('q');
            $data['isValidAuthentication'] = (Auth::guard('customer')->check() != null) ? true : false;
            $data['brand'] = "";
            $data['stateList'] = $this->stateRepo->selectlist('name', 'abbr');
            $data['paymentList'] = $this->tablelist->payment_list;
            // $brandDetails = $this->brandRepo->findByField('name', $brand);
            $data['networks'] =  $this->productRepo->queryTable()->whereRaw("status = 'active' AND device_type IN ('Buy', 'Both')")->groupBy('network')->get();
            // $data['brandDetails'] = $brandDetails;
            $allProducts = ModelProduct::with(['photo'])
            ->where('model', "like", "%".$q."%")
            ->orderBy('priority', 'asc')
            ->get();
            $data['products'] = [];


            foreach ($allProducts as $key => $val) {
                $product = $this->product->where('status', 'active')->find($val['id']);
                if ($product) {
                    if ($product->storagesForBuying()->count() >= 1) {
                        $data['products'][$key] = $val;
                        $data['products'][$key]['storages'] = $this->product->find($val['id'])->storagesForBuying()->get();
                    }
                }
            }
            $data['chkproduct'] = count($allProducts);
            // return $data['chkproduct'];
            $data['meta'] = [
                '<meta name="title" content="Results - TronicsPay" />',
                '<meta name="description" content="TronicsPay.com - Sell your Smartphones for CASH. You\'re guaranteed the highest offers, free shipping, and SAME-DAY payment.  100% satisfaction is guaranteed, or we will return your phone at no cost." />',
                '<meta property="og:type" content="article" />',
                '<meta property="og:title" content="Results - TronicsPay" />',
                '<meta property="og:url" content="' . url('/products/search/') . '" />',
                '<meta property="og:description" content="TronicsPay.com - Sell your Smartphones for CASH. You\'re guaranteed the highest offers, free shipping, and SAME-DAY payment.  100% satisfaction is guaranteed, or we will return your phone at no cost." />',
            ];

            // return "s";


        try {

        return view('front.device.checkout-search', $data);

        } catch (\Exception $th) {
            return print_r($th,true);
        }
        // return q;
    }

    public function network(Request $request)
    {
        $brand = $this->brandRepo->findByField('name', $request['brand']);
        $products = $this->productRepo->rawWithGroup(['photo'], "brand_id = ? and network = ? and device_type IN ('Both', 'Buy')", [$brand->id, $request['network']], 'model');
        $content = '';
        foreach ($products as $product) {
            $content .= '<div class="col-md-3">';
            $content .= '<div class="card tronics">';
            $content .= '<div class="card-body tronics-wrap">';
            $content .= '<div class="text-center">';
            if (!empty($product->photo)) {
                $content .= '<img src="' . url($product->photo->photo) . '" class="img-fluid product-photo">';
            }
            $content .= '<h3 class="product-name">' . $product->model . '</h3>';
            $content .= '<div class="tronics-links">';
            $content .= '<a href="javascript:void(0)" onclick="getoffer(' . $product->id . ')" class="btn btn-warning btn-sm">Get an Offer</a>';
            $content .= '</div>';
            $content .= '</div>';
            $content .= '</div>';
            $content .= '</div>';
            $content .= '</div>';
        }
        $data['content'] = $content;
        return response()->json($data);
    }

    public function filterByStorageCondition(Request $request)
    {
        $data = [];
        // return $request->all();
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($request['id']);
        // $network = $request['network'];
        $device_type = $request['device_type'];
        $result = $this->productRepo->findWith($id, ['photo', 'networks.network']);
        $storagelist = '';
        // $data['productStorage'] = $this->productStorageRepo->rawByFieldAll("product_id = ? and excellent_offer != ''", [$id]);
        if (isset($request['storage']) && $request['storage'] != null) {
            $getProductStorage = $this->productStorageRepo->rawByField("product_id = ? and title = ?", [$id, $request['storage']]);
        } else {
            $getProductStorage = $data['productStorage'][0];
        }
        // $product = $this->productRepo->rawByField("brand_id = ? and network = ? and storage = ? and model = ?", [$brand->id, $request['network'], $request['storage'], $request['model']]);
        // return $result;
        $data['selectedProduct'] = $result;
        // foreach ($data['productStorage'] as $psKey => $psVal) {
        //     $active = ($psKey == 0) ? ' active' : '';
        //     $checked = ($psKey == 0) ? ' checked' : '';
        //     $storagelist .= '<label class="btn btn-outline-warning radio-btn'.$active.'" style="margin-right: 4px;">';
        //     $storagelist .= '<input type="radio" class="device-storage" name="storage" value="'.$psVal->title.'" onchange="storage(\''.$psVal->title.'\')" autocomplete="off"'.$checked.'> '.$psVal->title;
        //     $storagelist .= '</label>';
        // }
        $data['storagelist'] = $storagelist;
        $condition = '';
        $amount = '';
        if ($device_type == 1) {
            $amount = number_format($getProductStorage['excellent_offer'], 2, '.', ',');
            $condition .= '<div class="card-body" style="font-size: 14px;">';
            $condition .= 'If ALL of the following are true:';
            $condition .= '<ul>';
            $condition .= '<li>Fully functional</li>';
            $condition .= '<li>Appears to be brand new</li>';
            $condition .= '<li>No scratches, scuffs or marks</li>';
            $condition .= '<li>Phone has a good ESN /IMEI</li>';
            $condition .= '</ul>';
            $condition .= '</div>';
        }
        if ($device_type == 2) {
            $amount = number_format($getProductStorage['good_offer'], 2, '.', ',');
            $condition .= '<div class="card-body" style="font-size: 14px;">';
            $condition .= 'If ALL of the following are true:';
            $condition .= '<ul>';
            $condition .= '<li>Fully functional</li>';
            $condition .= '<li>No major scratches, scuffs or nicks</li>';
            $condition .= '<li>No cracks or broken hardware</li>';
            $condition .= '<li>Phone has a good ESN / IMEI</li>';
            $condition .= '</ul>';
            $condition .= '</div>';
        }
        if ($device_type == 3) {
            $amount = number_format($getProductStorage['fair_offer'], 2, '.', ',');
            $condition .= '<div class="card-body" style="font-size: 14px;">';
            $condition .= 'If ANY of the following are true:';
            $condition .= '<ul>';
            $condition .= '<li>Cracked back</li>';
            $condition .= '<li>Defective buttons</li>';
            $condition .= '<li>Significant wear and tear</li>';
            $condition .= '<li>Housing damage</li>';
            $condition .= '</ul>';
            $condition .= '</div>';
        }
        if ($device_type == 4) {
            $amount = number_format($getProductStorage['poor_offer'], 2, '.', ',');
            $condition .= '<div class="card-body" style="font-size: 14px;">';
            $condition .= 'If ANY of the following are true:';
            $condition .= '<ul>';
            $condition .= '<li>Does NOT power on</li>';
            $condition .= '<li>Damaged LCD</li>';
            $condition .= '<li>Missing parts or bent frame</li>';
            $condition .= '<li>Any Password lock</li>';
            $condition .= '</ul>';
            $condition .= '</div>';
        }
        $data['condition'] = $condition;
        $data['amount'] = $amount;
        return $data;
        return $request->all();
    }

    public function brandModel($brand, $model)
    {
        $brand = $brand == "brand" ? $model : $brand;
        $brandData = $this->brandRepo->findByField('name', $brand);
        $result = $brandData ? $this->productRepo->rawByWithField(['photo', 'networks.network'], 'model = ? and brand_id = ? and status = "active"', [$model, $brandData->id]) : null;
        if ($result) {
            $id = $result['id'];
            $device_type = 1;
            $storagelist = '';
            $condition = '';
            $amount = '';
            $data['product'] = $result;
            $data['status'] = 200;
            $data['brand'] = $brand;
            $data['model'] = $model;
            $data['productStorage'] = $this->productStorageRepo->rawByFieldAll("product_id = ? and excellent_offer != ''", [$result->id]);
            $data['stateList'] = $this->stateRepo->selectlist('name', 'abbr');
            $data['paymentList'] = $this->tablelist->payment_list;
            // dd($data['product']->hashedid);
            $getProductStorage = $data['productStorage'][0];

            $network_ids = [];
            foreach ($data['productStorage'] as $storage) {
                array_push($network_ids, $storage->network_id);
            }

            $data['networks'] = $this->network->getWhereIn('id', $network_ids, null, null, ['id', 'title', 'image']);

            $data['specs'] = [];
            foreach ($network_ids as $network) {
                $fetched_data = $this->storageProduct->query()
                    ->where('network_id', $network)
                    ->where('product_id', $result->id)
                    ->where('amount', null)
                    ->get();
                $data['specs'][$network] = $fetched_data;
            }

            // foreach($data['specs'] as $key=>$spec){
            //     dump($spec[0]->title);
            // }
            // die();
            // dd($data['specs']);
            // foreach ($data['productStorage'] as $psKey => $psVal)
            // {
            //     $active = ($psKey == 0) ? ' active' : '';
            //     $checked = ($psKey == 0) ? ' checked' : '';
            //     $storagelist .= '<label class="btn btn-outline-warning radio-btn'.$active.'" style="margin-right: 4px;">';
            //     $storagelist .= '<input type="radio" class="device-storage" name="storage" value="'.$psVal->title.'" onchange="storage(\''.$psVal->title.'\')" autocomplete="off"'.$checked.'> '.$psVal->title;
            //     $storagelist .= '</label>';
            // }
            // $data['storagelist'] = $storagelist;
            // if($device_type == 1){
            //     $amount = number_format($getProductStorage['excellent_offer'], 2, '.', ',');
            //     $condition .= '<div class="card-body" style="font-size: 14px;">';
            //     $condition .= 'If ALL of the following are true:';
            //     $condition .= '<ul>';
            //     $condition .= '<li>Fully functional</li>';
            //     $condition .= '<li>Appears to be brand new</li>';
            //     $condition .= '<li>No scratches, scuffs or marks</li>';
            //     $condition .= '<li>Phone has a good ESN /IMEI</li>';
            //     $condition .= '</ul>';
            //     $condition .= '</div>';
            // }
            // if($device_type == 2){
            //     $amount = number_format($getProductStorage['good_offer'], 2, '.', ',');
            //     $condition .= '<div class="card-body" style="font-size: 14px;">';
            //     $condition .= 'If ALL of the following are true:';
            //     $condition .= '<ul>';
            //     $condition .= '<li>Fully functional</li>';
            //     $condition .= '<li>No major scratches, scuffs or nicks</li>';
            //     $condition .= '<li>No cracks or broken hardware</li>';
            //     $condition .= '<li>Phone has a good ESN / IMEI</li>';
            //     $condition .= '</ul>';
            //     $condition .= '</div>';
            // }
            // if($device_type == 3){
            //     $amount = number_format($getProductStorage['fair_offer'], 2, '.', ',');
            //     $condition .= '<div class="card-body" style="font-size: 14px;">';
            //     $condition .= 'If ANY of the following are true:';
            //     $condition .= '<ul>';
            //     $condition .= '<li>Cracked back</li>';
            //     $condition .= '<li>Defective buttons</li>';
            //     $condition .= '<li>Significant wear and tear</li>';
            //     $condition .= '<li>Housing damage</li>';
            //     $condition .= '</ul>';
            //     $condition .= '</div>';
            // }
            // if($device_type == 4){
            //     $amount = number_format($getProductStorage['poor_offer'], 2, '.', ',');
            //     $condition .= '<div class="card-body" style="font-size: 14px;">';
            //     $condition .= 'If ANY of the following are true:';
            //     $condition .= '<ul>';
            //     $condition .= '<li>Does NOT power on</li>';
            //     $condition .= '<li>Damaged LCD</li>';
            //     $condition .= '<li>Missing parts or bent frame</li>';
            //     $condition .= '<li>Any Password lock</li>';
            //     $condition .= '</ul>';
            //     $condition .= '</div>';
            // }
            // $data['condition'] = $condition;
            // $data['amount'] = $amount;



            $data['meta'] = [
                '<meta name="title" content="' . $brand . ' ' . $model . ' - TronicsPay" />',
                '<meta name="description" content="Need fast cash? Sell us your Apple iPhone XS Max. We pay better than anyone else on the Internet. We research our competitors prices." />',
                '<meta property="og:type" content="article" />',
                '<meta property="og:title" content="' . $brand . ' ' . $model . ' - TronicsPay" />',
                '<meta property="og:url" content="' . url('/products/' . $brand . '/' . $model) . '" />',
                '<meta property="og:description" content="Need fast cash? Sell us your Apple iPhone XS Max. We pay better than anyone else on the Internet. We research our competitors prices." />',
                '<meta name="twitter:title" content="' . $brand . ' ' . $model . ' - TronicsPay" />',
                '<meta name="twitter:image" content="' . url('/' . $result->photo->photo) . '" />',
                '<meta name="twitter:url" content="' . url('/products/' . $brand . '/' . $model) . '" />',
                '<meta name="twitter:description" content="Need fast cash? Sell us your Apple iPhone XS Max. We pay better than anyone else on the Internet. We research our competitors prices." />'
            ];
        } else {
            $data['status'] = 404;
            $data['error'] = $brand . ' - ' . $model . ' not found';
            $data['brand'] = $brand;
            $data['product'] = null;
            $data['model'] = $model;
        }

        return view('front.device.brandmodel', $data);

        // $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($request['id']);
        // $device_type = $request['device_type'];
        // $result = $this->productRepo->findWith($id, ['photo', 'networks.network']);
        // $storagelist = '';
        // $data['productStorage'] = $this->productStorageRepo->rawByFieldAll("product_id = ? and excellent_offer != ''", [$id]);

        // if (isset($request['storage']) && $request['storage'] != null) {
        //     $getProductStorage = $this->productStorageRepo->rawByField("product_id = ? and title = ?", [$id, $request['storage']]);
        // } else {
        //     $getProductStorage = $data['productStorage'][0];
        // }
        // $data['selectedProduct'] = $result;
        // foreach ($data['productStorage'] as $psKey => $psVal) {
        //     $active = ($psKey == 0) ? ' active' : '';
        //     $checked = ($psKey == 0) ? ' checked' : '';
        //     $storagelist .= '<label class="btn btn-outline-warning radio-btn'.$active.'" style="margin-right: 4px;">';
        //     $storagelist .= '<input type="radio" class="device-storage" name="storage" value="'.$psVal->title.'" onchange="storage(\''.$psVal->title.'\')" autocomplete="off"'.$checked.'> '.$psVal->title;
        //     $storagelist .= '</label>';
        // }
        // $data['storagelist'] = $storagelist;
        // $condition = '';
        // $amount = '';
        // if($device_type == 1){
        //     $amount = number_format($getProductStorage['excellent_offer'], 2, '.', ',');
        //     $condition .= '<div class="card-body" style="font-size: 14px;">';
        //     $condition .= 'If ALL of the following are true:';
        //     $condition .= '<ul>';
        //     $condition .= '<li>Fully functional</li>';
        //     $condition .= '<li>Appears to be brand new</li>';
        //     $condition .= '<li>No scratches, scuffs or marks</li>';
        //     $condition .= '<li>Phone has a good ESN /IMEI</li>';
        //     $condition .= '</ul>';
        //     $condition .= '</div>';
        // }
        // if($device_type == 2){
        //     $amount = number_format($getProductStorage['good_offer'], 2, '.', ',');
        //     $condition .= '<div class="card-body" style="font-size: 14px;">';
        //     $condition .= 'If ALL of the following are true:';
        //     $condition .= '<ul>';
        //     $condition .= '<li>Fully functional</li>';
        //     $condition .= '<li>No major scratches, scuffs or nicks</li>';
        //     $condition .= '<li>No cracks or broken hardware</li>';
        //     $condition .= '<li>Phone has a good ESN / IMEI</li>';
        //     $condition .= '</ul>';
        //     $condition .= '</div>';
        // }
        // if($device_type == 3){
        //     $amount = number_format($getProductStorage['fair_offer'], 2, '.', ',');
        //     $condition .= '<div class="card-body" style="font-size: 14px;">';
        //     $condition .= 'If ANY of the following are true:';
        //     $condition .= '<ul>';
        //     $condition .= '<li>Cracked back</li>';
        //     $condition .= '<li>Defective buttons</li>';
        //     $condition .= '<li>Significant wear and tear</li>';
        //     $condition .= '<li>Housing damage</li>';
        //     $condition .= '</ul>';
        //     $condition .= '</div>';
        // }
        // if($device_type == 4){
        //     $amount = number_format($getProductStorage['poor_offer'], 2, '.', ',');
        //     $condition .= '<div class="card-body" style="font-size: 14px;">';
        //     $condition .= 'If ANY of the following are true:';
        //     $condition .= '<ul>';
        //     $condition .= '<li>Does NOT power on</li>';
        //     $condition .= '<li>Damaged LCD</li>';
        //     $condition .= '<li>Missing parts or bent frame</li>';
        //     $condition .= '<li>Any Password lock</li>';
        //     $condition .= '</ul>';
        //     $condition .= '</div>';
        // }
        // $data['condition'] = $condition;
        // $data['amount'] = $amount;


        // $data['isValidAuthentication'] = (Auth::guard('customer')->check() != null) ? true : false;
        // $data['brand'] = $brand;
        // $data['stateList'] = $this->stateRepo->selectlist('name', 'abbr');
        // $data['paymentList'] = [
        //     '' => '--',
        //     'Apple Pay' => 'Apple Pay',
        //     'Google Pay' => 'Google Pay',
        //     'Venmo' => 'Venmo',
        //     'Cash App' => 'Cash App',
        //     'Paypal' => 'Paypal',
        //     'Bank Transfer' => 'Bank Transfer'
        // ];
        // $brandDetails = $this->brandRepo->findByField('name', $brand);
        // $data['chkproduct'] = $this->productRepo->rawCount("brand_id = ?", [$brandDetails->id]);
        // $data['networks'] =  $this->productRepo->queryTable()->whereRaw("brand_id = ? and device_type IN ('Buy', 'Both')", [$brandDetails->id])->groupBy('network')->get();
        // $data['brandDetails'] = $brandDetails;
        // $allProducts = $this->productRepo->rawByWithFieldAll(['photo'], "brand_id = ?", [$brandDetails->id], 'model');
        // $data['products'] = [];
        // foreach ($allProducts as $key => $val)
        // {
        //     if ($this->product->find($val['id'])->storagesForBuying()->count() >= 1) {
        //         $data['products'][$key] = $val;
        //         $data['products'][$key]['storages'] = $this->product->find($val['id'])->storagesForBuying()->get();
        //     }
        // }
        return view('front.device.brandmodel', $data);

        // $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($request['id']);
        // $device_type = $request['device_type'];
        // $result = $this->productRepo->findWith($id, ['photo', 'networks.network']);
        // $storagelist = '';
        // $data['productStorage'] = $this->productStorageRepo->rawByFieldAll("product_id = ? and excellent_offer != ''", [$id]);

        // if (isset($request['storage']) && $request['storage'] != null) {
        //     $getProductStorage = $this->productStorageRepo->rawByField("product_id = ? and title = ?", [$id, $request['storage']]);
        // } else {
        //     $getProductStorage = $data['productStorage'][0];
        // }
        // $data['selectedProduct'] = $result;
        // foreach ($data['productStorage'] as $psKey => $psVal) {
        //     $active = ($psKey == 0) ? ' active' : '';
        //     $checked = ($psKey == 0) ? ' checked' : '';
        //     $storagelist .= '<label class="btn btn-outline-warning radio-btn'.$active.'" style="margin-right: 4px;">';
        //     $storagelist .= '<input type="radio" class="device-storage" name="storage" value="'.$psVal->title.'" onchange="storage(\''.$psVal->title.'\')" autocomplete="off"'.$checked.'> '.$psVal->title;
        //     $storagelist .= '</label>';
        // }
        // $data['storagelist'] = $storagelist;
        // $condition = '';
        // $amount = '';
        // if($device_type == 1){
        //     $amount = number_format($getProductStorage['excellent_offer'], 2, '.', ',');
        //     $condition .= '<div class="card-body" style="font-size: 14px;">';
        //     $condition .= 'If ALL of the following are true:';
        //     $condition .= '<ul>';
        //     $condition .= '<li>Fully functional</li>';
        //     $condition .= '<li>Appears to be brand new</li>';
        //     $condition .= '<li>No scratches, scuffs or marks</li>';
        //     $condition .= '<li>Phone has a good ESN /IMEI</li>';
        //     $condition .= '</ul>';
        //     $condition .= '</div>';
        // }
        // if($device_type == 2){
        //     $amount = number_format($getProductStorage['good_offer'], 2, '.', ',');
        //     $condition .= '<div class="card-body" style="font-size: 14px;">';
        //     $condition .= 'If ALL of the following are true:';
        //     $condition .= '<ul>';
        //     $condition .= '<li>Fully functional</li>';
        //     $condition .= '<li>No major scratches, scuffs or nicks</li>';
        //     $condition .= '<li>No cracks or broken hardware</li>';
        //     $condition .= '<li>Phone has a good ESN / IMEI</li>';
        //     $condition .= '</ul>';
        //     $condition .= '</div>';
        // }
        // if($device_type == 3){
        //     $amount = number_format($getProductStorage['fair_offer'], 2, '.', ',');
        //     $condition .= '<div class="card-body" style="font-size: 14px;">';
        //     $condition .= 'If ANY of the following are true:';
        //     $condition .= '<ul>';
        //     $condition .= '<li>Cracked back</li>';
        //     $condition .= '<li>Defective buttons</li>';
        //     $condition .= '<li>Significant wear and tear</li>';
        //     $condition .= '<li>Housing damage</li>';
        //     $condition .= '</ul>';
        //     $condition .= '</div>';
        // }
        // if($device_type == 4){
        //     $amount = number_format($getProductStorage['poor_offer'], 2, '.', ',');
        //     $condition .= '<div class="card-body" style="font-size: 14px;">';
        //     $condition .= 'If ANY of the following are true:';
        //     $condition .= '<ul>';
        //     $condition .= '<li>Does NOT power on</li>';
        //     $condition .= '<li>Damaged LCD</li>';
        //     $condition .= '<li>Missing parts or bent frame</li>';
        //     $condition .= '<li>Any Password lock</li>';
        //     $condition .= '</ul>';
        //     $condition .= '</div>';
        // }
        // $data['condition'] = $condition;
        // $data['amount'] = $amount;

        // return $data;
    }

    public function model(Request $request)
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($request['id']);
        $device_type = $request['device_type'];
        $result = $this->productRepo->findWith($id, ['photo', 'networks.network']);
        $storagelist = '';
        $data['productStorage'] = $this->productStorageRepo->rawByFieldAll("product_id = ? and excellent_offer != ''", [$id]);

        if (isset($request['storage']) && $request['storage'] != null) {
            $getProductStorage = $this->productStorageRepo->rawByField("product_id = ? and title = ?", [$id, $request['storage']]);
        } else {
            $getProductStorage = $data['productStorage'][0];
        }
        $data['selectedProduct'] = $result;
        foreach ($data['productStorage'] as $psKey => $psVal) {
            $active = ($psKey == 0) ? ' active' : '';
            $checked = ($psKey == 0) ? ' checked' : '';
            $storagelist .= '<label class="btn btn-outline-warning radio-btn' . $active . '" style="margin-right: 4px;">';
            $storagelist .= '<input type="radio" class="device-storage" name="storage" value="' . $psVal->title . '" onchange="storage(\'' . $psVal->title . '\')" autocomplete="off"' . $checked . '> ' . $psVal->title;
            $storagelist .= '</label>';
        }
        $data['storagelist'] = $storagelist;
        $condition = '';
        $amount = '';
        if ($device_type == 1) {
            $amount = number_format($getProductStorage['excellent_offer'], 2, '.', ',');
            $condition .= '<div class="card-body" style="font-size: 14px;">';
            $condition .= 'If ALL of the following are true:';
            $condition .= '<ul>';
            $condition .= '<li>Fully functional</li>';
            $condition .= '<li>Appears to be brand new</li>';
            $condition .= '<li>No scratches, scuffs or marks</li>';
            $condition .= '<li>Phone has a good ESN /IMEI</li>';
            $condition .= '</ul>';
            $condition .= '</div>';
        }
        if ($device_type == 2) {
            $amount = number_format($getProductStorage['good_offer'], 2, '.', ',');
            $condition .= '<div class="card-body" style="font-size: 14px;">';
            $condition .= 'If ALL of the following are true:';
            $condition .= '<ul>';
            $condition .= '<li>Fully functional</li>';
            $condition .= '<li>No major scratches, scuffs or nicks</li>';
            $condition .= '<li>No cracks or broken hardware</li>';
            $condition .= '<li>Phone has a good ESN / IMEI</li>';
            $condition .= '</ul>';
            $condition .= '</div>';
        }
        if ($device_type == 3) {
            $amount = number_format($getProductStorage['fair_offer'], 2, '.', ',');
            $condition .= '<div class="card-body" style="font-size: 14px;">';
            $condition .= 'If ANY of the following are true:';
            $condition .= '<ul>';
            $condition .= '<li>Cracked back</li>';
            $condition .= '<li>Defective buttons</li>';
            $condition .= '<li>Significant wear and tear</li>';
            $condition .= '<li>Housing damage</li>';
            $condition .= '</ul>';
            $condition .= '</div>';
        }
        if ($device_type == 4) {
            $amount = number_format($getProductStorage['poor_offer'], 2, '.', ',');
            $condition .= '<div class="card-body" style="font-size: 14px;">';
            $condition .= 'If ANY of the following are true:';
            $condition .= '<ul>';
            $condition .= '<li>Does NOT power on</li>';
            $condition .= '<li>Damaged LCD</li>';
            $condition .= '<li>Missing parts or bent frame</li>';
            $condition .= '<li>Any Password lock</li>';
            $condition .= '</ul>';
            $condition .= '</div>';
        }
        $data['condition'] = $condition;
        $data['amount'] = $amount;

        return response()->json($data);
    }


    public function store(Request $request)
    {
        $response['status'] = 200;

        if (Auth::guard('customer')->check() != null) {
            $customer = Auth::guard('customer')->user();
            $request['fname'] = $customer['fname'];
            $request['lname'] = $customer['lname'];
            //$request['address1'] = $customer['address1'];
            $request['email'] = $customer['email'];
        } else {
            if ($request['fname'] == null) {
                $response['status'] = 400;
                $response['message'] = "First name field is required";
            } else if ($request['lname'] == null) {
                $response['status'] = 400;
                $response['message'] = "Last name field is required";
            } else if ($request['address1'] == null) {
                $response['status'] = 400;
                $response['message'] = "Address field is required";
            } else if ($request['state_id'] == null) {
                $response['status'] = 400;
                $response['message'] = "State field is required";
            } else if ($request['phone'] == null) {
                $response['status'] = 400;
                $response['message'] = "Phone field is required";
            } else if ($request['payment_method'] == null) {
                $response['status'] = 400;
                $response['message'] = "Payment method field is required";
            } else if (!filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
                $response['status'] = 400;
                $response['message'] = "Invalid Email Address Format";
            } else if ($request['account_username'] != null && !filter_var($request['account_username'], FILTER_VALIDATE_EMAIL)) {
                $response['status'] = 400;
                $response['message'] = "Invalid Payment Email Address format";
            }
        }

        if ($request['payment_method'] == null) {
            $response['status'] = 400;
            $response['message'] = "Payment method field is required";
        }

        if ($request['account_username'] != null && !filter_var($request['account_username'], FILTER_VALIDATE_EMAIL)) {
            $response['status'] = 400;
            $response['message'] = "Invalid Payment Email Address format";
        }

        if ($request['payment_method'] == "Bank Transfer") {
            if (!$request['bank']) {
                $response['status'] = 400;
                $response['message'] = "Bank is required";
            } else if (!$request['account_name']) {
                $response['status'] = 400;
                $response['message'] = "Account name is required";
            } else if (!$request['account_number']) {
                $response['status'] = 400;
                $response['message'] = "Account number is required";
            }
        }

        try {
            phone($request['phone'], 'US')->formatE164();
        } catch (\Exception $e) {
            return response()->json([
                "status"    => 400,
                "message"   => "Invalid phone number"
            ]);
        }

        // $phone_number = "";
        // if ($request->get('phone') != null) {
        //     $phone_number = easypost_phone_format($request->get('phone'));
        //     if (strlen($phone_number) != 10) {
        //         return response()->json([
        //             "status"    => 400,
        //             "message"   => "phone number input should containt a 10 digit number"
        //         ]);
        //     }
        // }

        $mobiles = 0;
        $others = 0;
        $gaming = 0;
        foreach ($request['cart'] as $key => $value) {
            $brand = $this->brandRepo->findByField('name', $value['brand']);

            if ($brand['device_type'] === 'Mobile') {
                $mobiles = $mobiles + $value['quantity'];
            } else if ($brand['device_type'] === 'Other') {
                $others = $others + $value['quantity'];
            } else if ($brand['device_type'] === 'Gaming') {
                $gaming = $gaming + $value['quantity'];
            }
        }

        // die("<pre>" . print_r($brand->device_type, true) . "</pre>");
        if ($mobiles > 10 || $others > 10 || $gaming > 3) {
            return response()->json([
                "status"    => 400,
                "message"   => "Please remove some devices from your cart."
            ]);
        }


        $chkcustomer = $this->customerRepo->findByField('email', $request['email']);
        if ($response['status'] == 200) {
            // return $request->all();
            EasyPost::setApiKey(config('account.easypost_apikey'));
            $config = $this->configRepo->find(1);

            $to_address = Address::create([
                "company" => "TronicsPay", // $config->company_name,
                "street1" => $config->address1, //"179 N Harbor Dr", //$config->address1,
                "street2" => $config->address2,
                "city"    => $config->city, // "Redondo Beach", // $config->city,
                "state"   => $config->state, // "CA", // $config->state,
                "zip"     => $config->zip_code, // "90277",  // $config->zip_code,
                // "zip"     => "90277",
                "phone"   => $config->phone, // "310-808-5243", // $config->phone,
            ]);


            $from_address = null;
            try {
                $from_address = Address::create([
                    // $from_address = Address::create_and_verify([
                    "company" => null,
                    "name" => $request['fname'] . " " . $request['lname'],
                    "street1" => $request['address1'],
                    "street2" => $request['address2'],
                    "city"    => $request['city'],
                    "state"   => $request['state_id'],
                    "zip"     => $request['zip_code'],
                    "phone"   => phone($request['phone'], 'US')->formatE164(),
                ]);
            } catch (\Exception $e) {
                // return response()->json([
                //     "status"    => 400,
                //     "message"   => "Invalid address."
                // ]);
            }



            // die("<pre>" . var_dump($from_address) . "</pre>");


            $parcel_height = 0;
            $parcel_width = 0;
            $parcel_length = 0;
            $total_weight = 0;

            if ($request['cart'] != null) {
                $max_width = 0;
                $max_height = 0;
                $max_length = 0;
                $total_products = 0;
                foreach ($request['cart'] as $key => $value) {
                    $brand = $this->brandRepo->findByField('name', $value['brand']);
                    $product = $this->productRepo->rawByField("brand_id = ? and model = ?", [$brand->id, $value['model']]);

					$dimensions = array($product->height, $product->width, $product->length);
					rsort($dimensions);
					
                    if ($dimensions[0] > $max_height) {
                        $max_height = $dimensions[0];
                    }
                    if ($dimensions[1] > $max_width) {
                        $max_width = $dimensions[1];
                    }
                    $max_length = $max_length + $dimensions[2];
                    $total_weight = $total_weight + $product->weight * $value['quantity'];
                    $total_products = $total_products + $value['quantity'];
					if ($total_weight == 0) { 
						$total_weight = 10;
					}
                }
                $parcel_height = $max_height + 1;
                $parcel_width = $max_width + 1;
                $parcel_length = $max_length + 1;
                $total_weight = ceil($total_weight);
            }




            $parcel = Parcel::create([
                // 'predefined_package' => $this->package($product->height, $product->width),
                // 'predefined_package' => 'LargeFlatRateBox',
                'length' => $parcel_length,
                'width' =>  $parcel_width,
                'height' => $parcel_height,
                'weight' => $total_weight,
                // 'length' => 10,
                // 'width' =>  10,
                // 'height' => 10,
                // 'weight' => 10,
            ]);

            $shipment = Shipment::create([
                'to_address'   => $to_address,
                'from_address' => $from_address,
                'parcel'       => $parcel
            ]);

            if (count($shipment->rates) == 0) {
                $response['status'] = 400;
                $response['message'] = "No rates found on your location";
                return $response;
            }


            if (!$chkcustomer) {
                $password = Str::random(10);
                $customerRequest = [
                    'fname' => $request['fname'],
                    'lname' => $request['lname'],
                    'email' => $request['email'],
                    'password' => bcrypt($password),
                    'payment_method' => $request['payment_method'],
                    'account_username' => $request['account_username'],
                    'bank' => $request['bank'],
                    'account_name' => $request['account_name'],
                    'account_number' => $request['account_number'],
                    'authpw' => $password,
                    'verification_code' => app('App\Http\Controllers\GlobalFunctionController')->verificationCode(),
                    'status' => 'In-Active'
                ];
                $customer = $this->customerRepo->create($customerRequest);
                $addressRequest = [
                    'customer_id' => $customer->id,
                    'address1' => $request['address1'],
                    'address2' => $request['address2'],
                    'city' => $request['city'],
                    'state' => $request['state_id'],
                    'zip' => $request['zip_code'],
                    'phone' => $request['phone']
                ];
                $address = $this->addressRepo->create($addressRequest);
                $this->doSMSRegistration($customerRequest, $request['phone']);
            } else {
                $password = '';
                $address = $this->addressRepo->findByField('customer_id', $chkcustomer['id']);
            }

            if ($request['cart'] != null) {


                $max_width = 0;
                $max_height = 0;
                $max_length = 0;
                $total_weight = 0;
                $total_value = 0;
                foreach ($request['cart'] as $key => $value) {
                    $brand = $this->brandRepo->findByField('name', $value['brand']);
                    $product = $this->productRepo->rawByField("brand_id = ? and model = ?", [$brand->id, $value['model']]);

                    if ($product->width > $max_width) {
                        $max_width = $product->width;
                    }
                    if ($product->height > $max_height) {
                        $max_height = $product->height;
                    }
                    if ($product->length > $max_length) {
                        $max_length = $product->length;
                    }

                    $total_weight = $total_weight + $product->weight * $value['quantity'];
                }


                // die(")))" . $max_width . "_" . $max_height . "_" . $max_length . "_" . $total_weight);


                $rate = $shipment->lowest_rate();
                $shipment->buy($rate);
                // die("<pre>" . ($rate['carrier']) . "</pre>");

                $insurance_cost = 0;
                if ($request['insurance_optin']) {
                    $config = $this->configRepo->find(1);
                    $easy_post_fee = $config->insurance_fee / 100;
                    $merchant_fee = (20 / 100) * $easy_post_fee;
                    $total_fee = $easy_post_fee + $merchant_fee;
                    $subTotal = 0;
                    foreach ($request['cart'] as $key => $value) {
                        $itemSubTotal = $value['amount'] * $value['quantity'];
                        $subTotal = $subTotal + $itemSubTotal;
                    }
                    $insurance_cost = $total_fee * $subTotal;
                    $shipment->insure(array('amount' => $subTotal));
                }


                $makeOrderRequest = [
                    'customer_id' => isset($chkcustomer->id) ? $chkcustomer->id : $customer->id,
                    'order_no' => strtoupper(app('App\Http\Controllers\GlobalFunctionController')->generateUUID()),
                    'status_id' => 1,
                    'transaction_date' => date("Y-m-d h:i:s"),
                    'delivery_due' => $shipment->tracker->est_delivery_date, // date("Y-m-d", strtotime("+30 day")),
                    'payment_method' => $request['payment_method'],
                    'account_username' => $request['account_username'],
                    'account_name' => $request['account_name'],
                    'account_number' => $request['account_number'],
                    'account_bank' => $request['bank'],
                    'shipping_label' => $shipment->postage_label->label_url,
                    'shipping_status' => $shipment->tracker->status,
                    'shipping_fee' => $rate['rate'],
                    'tracking_code' => $shipment->tracking_code,
                    'shipping_id' => $shipment->id,
                    'carrier' => $rate['carrier'],
                    'delivery_days' => $rate['delivery_days'],
                    'shipping_tracker' => $shipment->tracker->public_url,
                    'insurance_cost' => $insurance_cost

                ];

                $order = $this->orderRepo->create($makeOrderRequest);


                foreach ($request['cart'] as $key => $value) {
                    $brand = $this->brandRepo->findByField('name', $value['brand']);
                    $product = $this->productRepo->rawByField("brand_id = ? and model = ?", [$brand->id, $value['model']]);

                    $productStorage = $this->productStorageRepo->rawByField("product_id = ? and title = ?", [$product->id, $value['storage']]);

                    switch ($value['device_type']) {
                        case 'excellent_offer':
                            $device_type = 1;
                            break;
                        case 'good_offer':
                            $device_type = 2;
                            break;
                        case 'fair_offer':
                            $device_type = 3;
                            break;
                        case 'poor_offer':
                            $device_type = 0;
                            break;

                        default:
                            $device_type = 0;
                            break;
                    }

                    $makeRequest = [
                        'customer_id' => isset($chkcustomer->id) ? $chkcustomer->id : $customer->id,
                        'product_id' => $product->id,
                        'network_id' => $value['network'],
                        'order_id' => $order->id,
                        'product_storage_id' => $productStorage['id'],
                        // 'amount' => $value['amount'],
                        'amount' => $productStorage[$value['device_type']],
                        'quantity' => $value['quantity'],
                        'device_type' => $device_type
                    ];

                    $this->orderItemRepo->create($makeRequest);

                    $total_value += ( $productStorage[$value['device_type']] * $value['quantity'] );
                }
            }
            $email = $request['email'];
            $data['fname'] = $request['fname'];
            $data['lname'] = $request['lname'];
            $data['email'] = $request['email'];
            $data['password'] = $password;
            $data['company_email'] = $config->company_email;
            $data['model'] = $product->model;
            $result = [
                'model' => $product->model,
                'fname' => $request['fname']
            ];


            $data['order'] = $this->orderRepo->findWith($order->id, [
                'customer',
                'customer.bill',
                'status_details',
                'order_item',
                'order_item.product',
                'order_item.product.brand',
                'order_item.network',
                'order_item.product_storage'
            ]);

            $data['config'] = $this->configRepo->find(1);

            $data['shippingFee'] = 10;
            $data['overallSubTotal'] = 0;
            $data['counter'] = 1;

            $credentials_HTML = "";

            if ($chkcustomer != null) {
                $data['isRegistered'] = true;
                $subject = "TronicsPay Order Confirmation";
                $data['header'] = "TronicsPay Order Confirmation";

                $content = view('mail.customer', $data)->render();
                // $content = view('mail.customerAddBundle', $data)->render();

                // $response['status'] = 301;
                // $response['message'] = 'Cart has been added to your offers';
                // $response['redirectTo'] = 'customer/my-bundles';

                $credentials_HTML = "<p><a href='../customer/auth/login'>Login here</a></p>";
            } else {
                $data['isRegistered'] = false;
                $subject = "TronicsPay Email Confirmation";
                $data['header'] = "TronicsPay Email Confirmation";
                $content = view('mail.customer', $data)->render();

                $credentials_HTML = "<p><a href='../customer/auth/login'>Login</a> with Username: " . $data['email'] . ", password: " . $data['password'] . "</p>";
            }
            $response['status'] = 200;
            //
            $shipping_label_url = url('order/' . $order["hashedId"] . '/shippinglabel');
            $htmlResult = '<div class="container">
                                <div class="row">
                                    <div class="form-group col-md-12" align="center">
                                        <img src="' . url("./assets/images/logo.png") . '" class="img-fluid">
                                    </div>
                                </div>
                                <br />
                                <br />
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="text-center">
                                        <h3>Thank you ' . $result['fname'] . ' for selling ' . $result['model'] . '!</h3>
                                        <p>
                                        We are currently reviewing the device, we will send a confirmation email.<br>
                                        Please check your email and login at <a href="../customer/auth/login">Member Login</a>.
                                        </p>
                                        <p>
                                        Print <a href="' . $shipping_label_url . '" target="_blank">your shipping label</a>
                                        </p>' . $credentials_HTML . '
                                    </div>
                                    </div>
                                </div>
                                <iframe src="https://scdcb.com/p.ashx?a=42&e=83&t=' . $order->order_no . '&p=' . $total_value . '" height="1" width="1" frameborder="0"></iframe>
                            </div>';

            $response['message'] = $htmlResult;

            if (app('App\Http\Controllers\GlobalFunctionController')->checkSMSFeatureIfActive()) {

                $template = TemplateSms::where('name', 'Order Confirmation')->first();
                if ($template && $template->status == 'Active') {

                    $message = replaceSMSPlaceHolder($template->content, $data['order']);
                    app('App\Http\Controllers\GlobalFunctionController')->doSmsSending($order->customer->bill->phone, $message);
                }
            }

            Mail::send([], [], function (Message $message) use ($email, $subject, $content) {
                $message->to($email)
                    ->subject($subject)
                    ->setBody($content, 'text/html');
            });
        }
        return $response;


        /**
         * star: Old Codes
         */
        // return redirect()->to('device')->with('result', json_encode($result));
        // return $request->cart;


    }


    public function shippingLabelPDF($hashedId)
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
        $data['order'] = $this->orderRepo->find($id);

        return redirect($data['order']["shipping_label"]);
        // $pdf = PDF::loadHTML('<img src="' . $data['order']["shipping_label"] . '" style="width: 96%;">');
        // $pdf = PDF::loadView('partial.documents.shippinglabel.index', $data);

        return $pdf->download('Tronicspay_Shipping_Label.pdf');
    }

    private function shipping($address, $parcel)
    {
        EasyPost::setApiKey(config('account.easypost_apikey'));
        $config = $this->configRepo->find(1);

        $to_address = Address::create([
            'company' => $config->company_name,
            'street1' => $config->address1,
            'street2' => $config->address2,
            'city'    => $config->city,
            'state'   => $config->state,
            'zip'     => $config->zip_code,
            'phone'   => $config->phone,
        ]);

        $from_address = Address::create([
            'company' => '',
            'street1' => $address->address1,
            'street2' => $address->address2,
            'city'    => $address->city,
            'state'   => $address->state,
            'zip'     => $address->zip,
            'phone'   => $address->phone
        ]);

        $shipment = Shipment::create([
            'to_address'   => $to_address,
            'from_address' => $from_address,
            'parcel'       => $parcel
        ]);

        return $shipment;
    }

    private function parcel($product)
    {
        EasyPost::setApiKey(config('account.easypost_apikey'));
        return Parcel::create([
            // 'predefined_package' => $this->package($product->height, $product->width),
            'predefined_package' => $this->package('1', '1'),
            'height' => '1', // $product->height,
            'weight' => '1', // $product->weight,
            'width'  => '1', // $product->width,
            'length' => '1', // $product->length,
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


    public function doSMSRegistration($request, $phone)
    {
        if (app('App\Http\Controllers\GlobalFunctionController')->checkSMSFeatureIfActive() == false) return false;

        $template = TemplateSms::where('name', 'New User Registers')->first();

        if ($template && $template->status == 'Active') {

            $content = str_replace(
                [
                    '{email}',
                    '{password}',
                    '{verification_code}',
                ],
                [
                    $request['email'],
                    $request['authpw'],
                    $request['verification_code']
                ],
                $template->content
            );

            return app('App\Http\Controllers\GlobalFunctionController')->doSmsSending($phone, $content);
        }
    }


    public function storages_api($product_id)
    {
        $id = (app('App\Http\Controllers\GlobalFunctionController'))->decodeHashid($product_id);
        $product = $this->productRepo->findWith($id, ['storagesForBuying']);

        $network_ids = [];
        foreach ($product->storagesForBuying as $storage) {
            array_push($network_ids, $storage->network_id);
        }

        $data['specs'] = [];
        foreach ($network_ids as $network) {
            $fetched_data = $this->storageProduct->query()
                ->where('network_id', $network)
                ->where('product_id', $product->id)
                ->where('amount', null)
                ->get(['id', 'title', 'excellent_offer', 'good_offer', "fair_offer", "poor_offer"]);
            $data['specs'][$network] = $fetched_data;
        }

        $data['status'] = true;
        return response()->json($data);
    }

    /**
     * Search api for products
     *
     * @param Illuminate\Http\Request
     *
     * @return response
     */
    public function search(Request $request)
    {

        $search = $request->get('search');
        $data['status'] = true;
        $query = 'SELECT products.id,products.model,photo.photo,settings_brands.name FROM products INNER JOIN settings_brands ON products.brand_id = settings_brands.id INNER JOIN product_photos as photo ON products.id = photo.product_id WHERE products.model LIKE ? OR settings_brands.name LIKE ?';
        $products = DB::select($query, ["%{$search}%", "%{$search}%"]);

        foreach ($products as  $product) {
            $product->link = url("products/{$product->name}/{$product->model}");
            unset($product->name);
        }
        $data['products'] = $products;

        return response()->json($data);
    }
}
