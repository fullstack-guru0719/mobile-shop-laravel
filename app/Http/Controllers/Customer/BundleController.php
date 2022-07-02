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

class BundleController extends Controller
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
    }

    public function Index () 
    {
        $data['module'] = 'mybundles';
        return view('customer.bundles.index', $data);
    }

    public function Edit ($hashedId) 
    {
        $data['module'] = 'mybundles';
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
        $data['config'] = $this->configRepo->find(1);
        
        $data['order'] = $this->orderRepo->rawByWithField(
                                            [
                                                'customer', 
                                                'customer.bill',
                                                'order_item',
                                                'order_item.product',
                                                'order_item.product.brand',
                                                'order_item.network',
                                                'order_item.product_storage'
                                            ], "id = ?", [$id]);
        $data['hashedId'] = $hashedId;
        $data['products'] = $this->productRepo->rawWith(['brand','photo','networks.network','storages'], "status = ?", ['Active']);
        return view('customer.bundles.edit', $data);
    }
}
