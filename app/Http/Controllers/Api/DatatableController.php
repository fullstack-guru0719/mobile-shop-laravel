<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\ProductRequest;
use App\Http\Requests\Admin\ProductDupRequest;
use App\Repositories\Admin\SettingsBrandRepositoryEloquent as Brand;
use App\Repositories\Customer\CustomerRepositoryEloquent as Customer;
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
use App\Repositories\Admin\SettingsCategoryEloquentRepository as SettingsCategory;
use App\Repositories\Admin\UserRepositoryEloquent as User;
use App\Repositories\Admin\PageMetaTagRepositoryEloquent as PageMetaTag;
use App\Repositories\Admin\TemplateEmailEloquentRepository as EmailTemplate;
use App\Repositories\Admin\TemplateSmsEloquentRepository as SmsTemplate;

class DatatableController extends Controller
{
    protected $brandRepo;
    protected $customerRepo;
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
    protected $settingsCategoryRepo;
    protected $userRepo;
    protected $pageMetaTagRepo;
    protected $emailTemplateRepo;
    protected $smsTemplateRepo;

    function __construct(
        Brand $brandRepo,
        Customer $customerRepo,
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
        SettingsCategory $settingsCategoryRepo,
        User $userRepo,
        PageMetaTag $pageMetaTagRepo,
        EmailTemplate $emailTemplateRepo,
        SmsTemplate $smsTemplateRepo
    ) {
        $this->brandRepo = $brandRepo;
        $this->customerRepo = $customerRepo;
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
        $this->settingsCategoryRepo = $settingsCategoryRepo;
        $this->userRepo = $userRepo;
        $this->pageMetaTagRepo = $pageMetaTagRepo;
        $this->emailTemplateRepo = $emailTemplateRepo;
        $this->smsTemplateRepo = $smsTemplateRepo;
    }


    public function GetStatuses()
    {
        $status = $this->settingsStatusRepo->all();
        return Datatables::of($status)
            ->editColumn('name', function ($status) {
                return $status->name;
            })
            ->editColumn('module', function ($status) {
                return $status->module;
            })
            ->editColumn('email_sending', function ($status) {
                return $status->email_sending . 'd';
            })
            ->editColumn('default', function ($status) {
                return ($status->default == 1) ? '<span class="label label-info">Default</span>' : '';
            })
            ->editColumn('badge', function ($status) {
                return '<center><small class="badge ' . $status->badge . '"><div class="w50px h5px"></div></small></center>';
            })
            ->addColumn('action', function ($status) {
                $html_out  = '';
                $html_out .= '<div class="dropdown">';
                $html_out .= '<button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>';
                $html_out .= '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="action-btn">';
                $html_out .= '<a class="dropdown-item font14px" href="javascript:void(0)" onclick="editStatus(\'' . $status->hashedid . '\')"><i class="fa fa-pencil-alt fa-fw"></i> Edit</a>';
                $html_out .= '<a class="dropdown-item font14px" href="javascript:void(0)" onclick="deleteStatus(\'' . $status->hashedid . '\')"><i class="fa fa-trash-alt fa-fw"></i> Delete</a>';
                $html_out .= '</div>';
                $html_out .= '</div>';
                return $html_out;
            })
            ->rawColumns(['name', 'module', 'email_sending', 'default', 'badge', 'action'])
            ->make(true);
    }

    public function getOrders(Request $request)
    {
        $orders = $this->orderRepo->rawWith(
            [
                'customer',
                'order_item',
                'status_details',
                'order_item.customer',
                'order_item.product',
                'order_item.product.brand',
                'order_item.product.photo',
                'order_item.network',
                'order_note',
            ],
            "1 = ?",
            [1],
            'id',
            'desc'
        );
        return Datatables::of($orders)
            ->editColumn('tracking_code', function ($orders) {
                $html  = $orders['tracking_code'];
                return $html;
            })
            ->editColumn('seller_name', function ($orders) {
                $html  = $orders['customer']['fullname'];
                return $html;
            })
            ->editColumn('order_no', function ($orders) {
                $html  = $orders['order_no'];
                return $html;
            })
            ->editColumn('status', function ($orders) {
                return '<center><small class="badge ' . $orders['status_details']['badge'] . '">' . strtoupper(str_replace("_", " ", $orders['status_details']['name'])) . '</small></center>';
            })
            ->editColumn('transaction_date', function ($orders) {
                $html  = '<center>' . $orders['display_transaction_date'] . '</center>';
                return $html;
            })
            ->editColumn('delivery_due', function ($orders) {
                $html  = $orders['display_delivery_due'];
                return $html;
            })
            ->editColumn('order_notes', function ($orders) {

                return (count($orders['order_note']) > 0)
                    ? '<center>
                            <a 
                                href="javascript:void(0);" 
                                onClick="OpenOrderNotes(\'' . $orders['hashedid'] . '\')" 
                                data-toggle="popover" 
                                data-placement="top" 
                                data-html="true" 
                                data-content="There are <b class=\'text-blue\'>' . count($orders['order_note']) . '</b> note(s) recorded" 
                                data-trigger="hover"
                            >
                                <i class="fas fa-file"></i>
                            </a>
                        </center>
                        <script>$(function () {   $(\'[data-toggle="popover"]\').popover(); $(\'[data-toggle="tooltip"]\').tooltip();});</script>'
                    : '';
                // $html  = $orders['display_delivery_due'];
                // return $html;
            })
            ->addColumn('action', function ($orders) {
                $html_out  = '';
                $html_out .= '<div class="dropdown">';
                $html_out .= '<button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>';
                $html_out .= '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="action-btn">';


                if ($orders['shipping_label'] != '') {
                    $html_out .= '<a class="dropdown-item font14px" href="' . $orders['shipping_label'] . '" target="_blank"><i class="fa fa-id-card fa-fw"></i> Shipping Label</a>';
                }
                if ($orders['status_id'] != 1) {
                    if ($orders['shipping_tracker'] != '') {
                        $html_out .= '<a class="dropdown-item font14px" href="' . $orders['shipping_tracker'] . '" target="_blank"><i class="fa fa-truck fa-fw"></i> Track Order</a>';
                    }
                } else {
                    $payment_url = '';
                    if ($orders['customer']['payment_method'] == "Paypal") {
                        $payment_url = 'https://www.paypal.com/myaccount/transfer/homepage?from=SUM-QuickLink';
                    } else if ($orders['customer']['payment_method'] == "Bank Transfer") {
                        $payment_url = 'https://stripe.com/';
                    } else if ($orders['customer']['payment_method'] == "Venmo") {
                        $payment_url = 'https://venmo.com/';
                    } else if ($orders['customer']['payment_method'] == "Apple Pay") {
                        $payment_url = 'https://support.apple.com/en-us/HT207875';
                    } else if ($orders['customer']['payment_method'] == "Google Pay") {
                        $payment_url = 'https://pay.google.com/gp/w/u/0/home/sendrequestmoney';
                    } else {
                        $payment_url = 'https://stripe.com/';
                    }
                    $html_out .= '<a class="dropdown-item font14px" href="' . $payment_url . '" target="_blank"><i class="fa fa-credit-card fa-fw"></i> Send Payment</a>';

                    // $html_out .= '<a class="dropdown-item font14px approve-order" onClick="ApproveOrder(\''.$orders['hashedid'].'\')" data-attr-id="'.$orders['hashedid'].'" href="javascript:void(0);" ><i class="fa fa-thumbs-up fa-fw"></i> Approve & Pay Order</a>';                    
                }
                $html_out .= '<a class="dropdown-item font14px approve-order" onClick="UpdateOrderStatus(\'' . $orders['hashedid'] . '\', ' . $orders['status_id'] . ')" data-attr-id="' . $orders['hashedid'] . '" href="javascript:void(0);" ><i class="fa fa-pencil-alt fa-fw"></i> Update Status</a>';
                $html_out .= '<a class="dropdown-item font14px" href="' . url('admin/orders/' . $orders['hashedid']) . '/edit"><i class="fa fa-edit fa-fw"></i> Review Order</a>';
                $html_out .= '<a class="dropdown-item font14px" href="javascript:void(0);" onClick="AddOrderNotes(\'' . $orders['hashedid'] . '\')"><i class="fa fa-file fa-fw"></i> Add Notes</a>';
                $html_out .= '<a class="dropdown-item font14px" href="javascript:void(0)" onclick="deleteOrder(\'' . $orders['hashedid'] . '\')"><i class="fa fa-trash-alt fa-fw"></i> Delete</a>';
                $html_out .= '</div>';
                $html_out .= '</div>';
                return $html_out;
            })
            // ->rawColumns(['photo', 'action', 'model','brand','amount'])
            ->rawColumns(['tracking_code', 'order_no', 'seller_name', 'status', 'transaction_date', 'delivery_due', 'order_notes', 'action'])
            ->make(true);
    }


    public function GetCategories()
    {
        $category = $this->settingsCategoryRepo->all();
        return Datatables::of($category)
            ->editColumn('name', function ($category) {
                return $category->name;
            })
            ->addColumn('action', function ($category) {
                $html_out  = '';
                $html_out .= '<div class="dropdown">';
                $html_out .= '<button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>';
                $html_out .= '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="action-btn">';
                $html_out .= '<a class="dropdown-item font14px" href="javascript:void(0)" onclick="editCategory(\'' . $category->hashedid . '\')"><i class="fa fa-pencil-alt fa-fw"></i> Edit</a>';
                $html_out .= '<a class="dropdown-item font14px" href="javascript:void(0)" onclick="deleteCategory(\'' . $category->hashedid . '\')"><i class="fa fa-trash-alt fa-fw"></i> Delete</a>';
                $html_out .= '</div>';
                $html_out .= '</div>';
                return $html_out;
            })
            ->rawColumns(['name', 'action'])
            ->make(true);
    }



    public function GetCustomers()
    {
        $customers = $this->customerRepo->rawWith(['bill'], "1 = ?", [1]);
        return Datatables::of($customers)
            ->editColumn('fullname', function ($customers) {
                return $customers->fname . ' ' . $customers->lname;
            })
            ->editColumn('phone', function ($customers) {
                return $customers->bill->phone;
            })
            ->editColumn('address', function ($customers) {
                if (!empty($customers->bill)) {
                    return $customers->bill->street . ' ' . $customers->bill->city . ' ' . $customers->bill->state;
                }
                return '';
            })
            ->addColumn('action', function ($customers) {
                $html_out  = '';
                $html_out .= '<div class="dropdown">';
                $html_out .= '<button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>';
                $html_out .= '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="action-btn">';
                $html_out .= '<a href="javascript:void(0);" class="dropdown-item font14px customer-change-password" data-attr-id="' . $customers->hashedid . '" onclick="changepasswordcustomer(\'' . $customers->hashedid . '\')"><i class="fa fa-lock fa-fw"></i> Change Password</a>';
                $html_out .= '<a class="dropdown-item font14px" href="javascript:void(0)" onclick="openCustomerModal(\'' . $customers->hashedid . '\')"><i class="fa fa-edit fa-fw"></i> Edit</a>';
                $html_out .= '<a class="dropdown-item font14px" href="javascript:void(0)" onclick="deleteCustomers([' . $customers->id . '])"><i class="fa fa-trash-alt fa-fw"></i> Delete</a>';
                $html_out .= '</div>';
                $html_out .= '</div>';
                return $html_out;
            })
            ->rawColumns(['photo', 'action'])
            ->make(true);
    }


    public function GetUsers()
    {
        $users = $this->userRepo->rawAll("status = ?", ['Active']);
        return Datatables::of($users)
            ->addColumn('action', function ($users) {
                $html_out  = '';
                $html_out .= '<div class="dropdown">';
                $html_out .= '<button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>';
                $html_out .= '<div class="dropdown-menu" aria-labelledby="action-btn">';
                $html_out .= '<a class="dropdown-item font14px" href="' . url('admin/settings/users', $users->hashedid) . '/edit" onclick="updatecustomer(\'' . $users->hashedid . '\')"><i class="fa fa-pencil-alt fa-fw"></i> Edit</a>';
                $html_out .= '<a class="dropdown-item font14px" href="javascript:void(0)" onclick="deleteuser(\'' . $users->hashedid . '\')"><i class="fa fa-trash-alt fa-fw"></i> Delete</a>';
                $html_out .= '</div>';
                $html_out .= '</div>';
                return $html_out;
            })->make(true);
    }



    public function GetProduct()
    {
        $products = $this->productRepo->rawWith(['brand', 'photo', 'storages.network'], "status = ?", ['Active']);
        $products;
        return Datatables::of($products)
            ->editColumn('photo', function ($products) {
                if (!empty($products->photo)) {
                    return '<img src="' . url($products->photo->photo) . '" style="width: auto; height: 80px">';
                }
                return '';
            })
            ->editColumn('model', function ($products) {
                $config = $this->configRepo->find(1);
                if ($config['notify_device_by_last_updated_date'] == 0) {
                    $mark_as_not_updated = '';
                } else {
                    if ($products->updated_at < date("Y-m-d h:i:s", strtotime("- " . $config['notify_device_by_last_updated_date'] . " days"))) {
                        $timestamp = date("Y-m-d h:i:s", strtotime("- " . $config['notify_device_by_last_updated_date'] . " days"));
                        $mark_as_not_updated = '<a href="javascript:void(0);" class="text-red" data-toggle="popover" data-placement="top" data-html="true" data-content="It has been more than <b class=\'text-red\'>' . $config['notify_device_by_last_updated_date'] . ' days (' . $timestamp . ')</b> since this device\'s price has been updated." data-trigger="hover"><i class="fa fa-exclamation fa-fw"></i></a> ';
                        $mark_as_not_updated .= '<script>$(function () {   $(\'[data-toggle="popover"]\').popover(); $(\'[data-toggle="tooltip"]\').tooltip();});</script>';
                    } else {
                        $mark_as_not_updated = '';
                    }
                }

                $html = $mark_as_not_updated . ' ' . $products->model;
                return $html;
            })
            ->editColumn('brand', function ($products) {
                $html = '';
                if ($products->brand_id) {
                    $html .= (!empty($products->brand)) ? $products->brand->name . '<br>' : '';
                }

                if ($products->device_type == 'Buy' || $products->device_type == 'Both') {
                    $storages = '';
                }
                if ($products->sku) $html .= '<small><b>SKU:</b> ' . $products->sku . '</small>';
                return $html;
            })
            ->editColumn('color', function ($products) {
                return $products->color;
            })
            ->editColumn('otherInfo', function ($products) {
                $html = '<small><b>Dimensions:</b> ' . $products->height . ' in x ' . $products->width . ' in x ' . $products->length . ' in</small><br>';
                $html .= '<small><b>Weight:</b> ' . $products->weight . ' ounces</small><br>';
                if ($products->device_type == 'Buy' || $products->device_type == 'Both') {
                    $storages = '';
                    $networks = '';
                    $product_networks = [];
                    if ($products->storages != null) {
                        foreach ($products->storages as $storage) {
                            if($storage->network != null) {
                                $product_networks[$storage->network->id] = $storage->network->title;
                            }
                        }
                        asort($product_networks);
                        $networks = implode(", ", $product_networks);
                    }
                    $html .= '<small><b>Carrier:</b> ' . $networks . '</small>';
                }
                return $html;
            })
            ->editColumn('dateUpdated', function ($products) {
                return $products->display_updated_at;
            })
            ->addColumn('action', function ($products) {
                $html_out  = '';
                $html_out .= '<div class="dropdown">';
                $html_out .= '<button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>';
                $html_out .= '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="action-btn">';
                // $html_out .= '<a class="dropdown-item" href="javascript:void(0)" onclick="duplicate(\''.$products->hashedid.'\')"><i class="fa fa-clone fa-fw"></i> Create Duplicate</a>';
                $html_out .= '<a class="dropdown-item font14px" href="' . url('admin/products', $products->hashedid) . '/edit"><i class="fa fa-pencil-alt fa-fw"></i> Edit</a>';
                $html_out .= '<a class="dropdown-item font14px" href="javascript:void(0)" onclick="deleteproduct(\'' . $products->hashedid . '\')"><i class="fa fa-trash-alt fa-fw"></i> Delete</a>';
                $html_out .= '</div>';
                $html_out .= '</div>';
                return $html_out;
            })
            ->rawColumns(['photo', 'action', 'model', 'brand', 'color', 'otherInfo'])
            ->make(true);
    }


    public function GetBrands()
    {
        $brands = $this->brandRepo->all();
        return Datatables::of($brands)
            ->editColumn('photo', function ($brands) {
                if ($brands->photo) {
                    return '<img src="' . url($brands->photo) . '" style="width: 80px; height: auto">';
                }
                return '';
            })
            ->editColumn('updated_at', function ($brands) {
                return $brands->updated_at_display;
            })
            ->addColumn('action', function ($brands) {
                $html_out  = '';
                $html_out .= '<div class="dropdown">';
                $html_out .= '<button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>';
                $html_out .= '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="action-btn">';
                $html_out .= '<a class="dropdown-item font14px" href="javascript:void(0)" onclick="updatebrand(\'' . $brands->hashedid . '\')"><i class="fa fa-pencil-alt fa-fw"></i> Edit</a>';
                $html_out .= '<a class="dropdown-item font14px" href="javascript:void(0)" onclick="deletebrand(\'' . $brands->hashedid . '\')"><i class="fa fa-trash-alt fa-fw"></i> Delete</a>';
                $html_out .= '</div>';
                $html_out .= '</div>';
                return $html_out;
            })
            ->rawColumns(['photo', 'action'])
            ->make(true);
    }


    public function GetMetaTags($hashedId)
    {
        $page_id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
        $pageMetaTags = $this->pageMetaTagRepo->rawWith(['page'], 'page_id = ?', [$page_id], 'page_id', 'asc');
        return Datatables::of($pageMetaTags)
            ->editColumn('name', function ($pageMetaTags) {
                return $pageMetaTags->name;
            })
            ->editColumn('page', function ($pageMetaTags) {
                return $pageMetaTags->page->title;
            })
            ->editColumn('content', function ($pageMetaTags) {
                if ($pageMetaTags->name == 'og:image' || $pageMetaTags->name == 'twitter:image') {
                    return '<img src="' . $pageMetaTags->content . '" style="width: 80px; height: auto">';
                } else if ($pageMetaTags->name == 'og:url' || $pageMetaTags->name == 'twitter:url') {
                    return '<a href="' . $pageMetaTags->content . '" target="_blank" class="fontWhite"><u>' . $pageMetaTags->content . ' <i class="fas fa-external-link-square-alt"></i></u></a>';
                } else {
                    return strlen($pageMetaTags->content) >= 101 ? substr($pageMetaTags->content, 0, 100) . "..." : $pageMetaTags->content;
                }
            })
            ->addColumn('action', function ($pageMetaTags) {
                $html_out  = '';
                $html_out .= '<div class="dropdown">';
                $html_out .= '<button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>';
                $html_out .= '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="action-btn">';
                $html_out .= '<a class="dropdown-item font14px" href="javascript:void(0)" onclick="updatemetatag(\'' . $pageMetaTags->hashedid . '\')"><i class="fa fa-pencil-alt fa-fw"></i> Edit</a>';
                $html_out .= '<a class="dropdown-item font14px" href="javascript:void(0)" onclick="deletemetatag(\'' . $pageMetaTags->hashedid . '\')"><i class="fa fa-trash-alt fa-fw"></i> Delete</a>';
                $html_out .= '</div>';
                $html_out .= '</div>';
                return $html_out;
            })
            ->rawColumns(['name', 'page', 'content', 'action'])
            ->make(true);
    }



    public function GetEmailTemplates()
    {
        $email_template = $this->emailTemplateRepo->all();
        return Datatables::of($email_template)
            ->editColumn('name', function ($email_template) {
                return $email_template->name;
            })
            ->editColumn('description', function ($email_template) {
                $description = $email_template->description;
                if (strlen($email_template->description) > 30) {
                    $description = explode("\n", wordwrap($email_template->description, 30));
                    $description = $description[0] . '...';
                }
                return $description;
            })
            ->editColumn('model', function ($email_template) {
                return '<center>' . $email_template->model . '</center>';
            })
            ->editColumn('status', function ($email_template) {
                return '<center><span class="label label-info">' . $email_template['status'] . '</span></center>';
            })
            ->editColumn('scheduled_days', function ($email_template) {
                return '<center>' . $email_template->scheduled_days . '</center>';
            })
            ->addColumn('action', function ($email_template) {
                $html_out  = '';
                $html_out .= '<div class="dropdown">';
                $html_out .= '<button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>';
                $html_out .= '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="action-btn">';
                $html_out .= '<a class="dropdown-item font14px" href="javascript:void(0)" onclick="editEmailTemplate(\'' . $email_template->hashedid . '\')"><i class="fa fa-pencil-alt fa-fw"></i> Edit</a>';
                $html_out .= '<a class="dropdown-item font14px" href="javascript:void(0)" onclick="deleteEmailTemplate(\'' . $email_template->hashedid . '\')"><i class="fa fa-trash-alt fa-fw"></i> Delete</a>';
                $html_out .= '</div>';
                $html_out .= '</div>';
                return $html_out;
            })
            ->rawColumns(['name', 'description', 'model', 'status', 'scheduled_days', 'action'])
            ->make(true);
    }

    public function GetSmsTemplates()
    {
        $model = $this->smsTemplateRepo->all();
        return Datatables::of($model)
            ->editColumn('name', function ($model) {
                return $model->name;
            })
            ->editColumn('receiver', function ($model) {
                return '<center>' . $model->receiver . '</center>';
            })
            ->editColumn('status', function ($model) {
                $badge_class = ($model->status == "Active") ? 'badge-success' : 'badge-danger';
                return  '<center><span class="badge ' . $badge_class . '">' . $model->status . '</span></center>';
            })
            ->editColumn('model', function ($model) {
                return '<center>' . $model->model . '</center>';
            })
            ->addColumn('action', function ($model) {
                $html_out  = '';
                $html_out .= '<div class="dropdown">';
                $html_out .= '<button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>';
                $html_out .= '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="action-btn">';
                $html_out .= '<a class="dropdown-item font14px" href="javascript:void(0)" onclick="editSmsTemplate(\'' . $model->hashedid . '\')"><i class="fa fa-pencil-alt fa-fw"></i> Edit</a>';
                $html_out .= '<a class="dropdown-item font14px" href="javascript:void(0)" onclick="deleteSmsTemplate(\'' . $model->hashedid . '\')"><i class="fa fa-trash-alt fa-fw"></i> Delete</a>';
                $html_out .= '</div>';
                $html_out .= '</div>';
                return $html_out;
            })
            ->rawColumns(['name', 'receiver', 'status', 'model', 'action'])
            ->make(true);
    }
}
