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
use App\Models\TableList as Tablelist;

class ApiController extends Controller
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
    protected $tablelist;

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
        Customer $customerRepo,
        TableList $tablelist
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
        $this->customerRepo = $customerRepo;
        $this->tablelist = $tablelist;
    }

    public function ChangePassword(Request $request)
    {
        if ($request['id'] == '') {
            $response['status'] = 400;
            $response['error'] = "Id missing";
        } else if ($request['password'] == '') {
            $response['status'] = 400;
            $response['error'] = "New Password is required";
        } else if (strlen($request['password']) <= 5) {
            $response['status'] = 400;
            $response['error'] = "New password must be atleast 6 characters";
        } else if ($request['retype-password'] == '') {
            $response['status'] = 400;
            $response['error'] = "Re-type Password is required";
        } else if ($request['password'] != $request['retype-password']) {
            $response['status'] = 400;
            $response['error'] = "New Password and Re-type Password not matched";
        } else {
            $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($request['id']);
            $customer = $this->customerRepo->find($id);
            $makeRequest = [
                'password' => bcrypt($request['password']),
                'authpw' => $request['password']
            ];
            $this->customerRepo->update($makeRequest, $id);

            $response['status'] = 200;
            $response['message'] = "Password has been successfully updated";
        }
        return response()->json($response);
    }


    public function GetCustomerInfo($hashedId)
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);

        $customer = $this->customerRepo->findWith($id, ['bill']);

        return response()->json($customer);
    }

    public function UpdateCustomerInfo(Request $request)
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($request['customer_id']);

        $this->customerRepo->update([
            "fname" => $request['fname'],
            "lname" => $request['lname'],
            "email" => $request['email']
        ], $id);

        $this->customerRepo->find($id)->bill->update([
            "phone" => $request['bill_phone'],
            "street" => $request['bill_street'],
            "city" => $request['bill_city'],
            "state" => $request['bill_state']
        ]);

        return response()->json(['status' => 'OK']);
    }

    public function DeleteCustomers(Request $request)
    {
        $ids = $request['ids'];
        foreach ($ids as $id) {
            $this->customerRepo->delete($id);
        }
        return response()->json(['status' => 'ok']);
    }


    // public function GetOrderItem($hashedId)
    // {
    //     $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
    //     $data['customerSell'] = $this->orderItemRepo->rawByWithField(['product_storage'], 'id = ?', [$id]);
    //     $data['productDetails'] = $this->productRepo->rawByWithField(['networks.network'], 'id = ?', [$data['customerSell']['product_id']]);
    //     $data['productDetails']['storages'] = $data['productDetails']->storagesForBuying()->get();
    //     return $data;
    // }


    
    public function GetOrderItem($hashedId)
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
        $data['customerSell'] = $this->orderItemRepo->rawByWithField(['product_storage'], 'id = ?', [$id]);
        $data['productDetails'] = $this->productRepo->rawByWithField(['storages.network'], 'id = ?', [$data['customerSell']['product_id']]);
        $data['productDetails']['storages'] = $data['productDetails']->storagesForBuying()->get();
        // $networks = $data['productDetails']['networks']; 
        $curr_network_id = $data['customerSell']['network_id'];
        $prod_storages = $data['productDetails']['storages'];
        $all_networks = $this->networkRepo->all(null, null, ['id', 'title']);
        
        foreach ($data['productDetails']['storages'] as $storage) {
            $data['networks'][$storage->network->id] = $storage->network->title;
        }

        foreach ($prod_storages as $k => $storage) {
            foreach ($all_networks as $network) {
                
                if ($network['id'] === $storage['network_id']) {
                    $data['productDetails']['storages'][$k]['network_title'] = $network['title'];
                }
            }
        }

        $config = $this->configRepo->find(1);
        return $data;
    }

    public function Verification(Request $request)
    {
        if ($request['input1'] == '' || $request['input2'] == '' || $request['input3'] == '' || $request['input4'] == '') {
            $response['status'] = 400;
            $response['message'] = "Please enter valid verification code";
            return response()->json($response);
        }

        $merge_code = $request['input1'] . '' . $request['input2'] . '' . $request['input3'] . '' . $request['input4'];
        // return Auth::guard('customer')->user()->verification_code .' - '. $merge_code;
        if (Auth::guard('customer')->user()->verification_code != $merge_code) {
            $response['status'] = 400;
            $response['message'] = "Verification code not matched";
            return response()->json($response);
        }

        $makeRequest = [
            'status' => 'Active',
            'is_verified' => 1
        ];
        $this->customerRepo->update($makeRequest, Auth::guard('customer')->user()->id);
        $response['status'] = 200;
        $response['message'] = "Account verified";
        return response()->json($response);
    }

    public function ResendVerification()
    {
        $id = Auth::guard('customer')->user()->id;
        $makeRequest = [
            'verification_code' => app('App\Http\Controllers\GlobalFunctionController')->verificationCode()
        ];
        $customer = $this->customerRepo->rawByWithField(['bill'], "id = ?", [$id]);
        $this->customerRepo->update($makeRequest, $id);
        $do_verification = $this->doSMSResendVerification($makeRequest, $customer['bill']['phone']);
        if ($do_verification == true) {
            $response['status'] = 200;
            $response['message'] = "Verifcation code sent";
        } else {
            $response['status'] = 400;
            $response['message'] = "Failed to send verifcation code";
        }
        return response()->json($response);
    }

    private function doSMSResendVerification($request, $phone)
    {
        if (app('App\Http\Controllers\GlobalFunctionController')->checkSMSFeatureIfActive() == false) return false;

        $message = 'Your new verification code is ' . $request['verification_code'];

        return app('App\Http\Controllers\GlobalFunctionController')->doSmsSending($phone, $message);
    }
}
