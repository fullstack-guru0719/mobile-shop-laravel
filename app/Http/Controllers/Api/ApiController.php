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
use App\Repositories\Admin\ConfigRepositoryEloquent as Config;
use App\Repositories\Admin\ProductRepositoryEloquent as Product;
use App\Repositories\Admin\ProductPhotoRepositoryEloquent as ProductPhoto;
use App\Repositories\Admin\NetworkRepositoryEloquent as Network;
use App\Repositories\Admin\ProductNetworkEloquentRepository as ProductNetwork;
use App\Repositories\Admin\ProductStorageEloquentRepository as ProductStorage;
use App\Repositories\Customer\CustomerSellRepositoryEloquent as CustomerSell;
use App\Repositories\Admin\OrderRepositoryEloquent as Order;
use App\Repositories\Admin\OrderItemRepositoryEloquent as OrderItem;
use App\Repositories\Admin\OrderNoteRepositoryEloquent as OrderNote;
use App\Repositories\Admin\SettingsStatusEloquentRepository as Status;
use App\Repositories\Admin\SettingsCategoryEloquentRepository as SettingsCategory;
use App\Repositories\Admin\ProductCategoryEloquentRepository as ProductCategory;
use App\Repositories\Admin\UserRepositoryEloquent as User;
use App\Repositories\Admin\PageBuilderRepositoryEloquent as PageBuilder;
use App\Repositories\Admin\PageMetaTagRepositoryEloquent as PageMetaTag;
use App\Repositories\Admin\TemplateEmailEloquentRepository as EmailTemplate;
use App\Repositories\Admin\TemplateSmsEloquentRepository as SmsTemplate;
use App\Repositories\Customer\CustomerRepositoryEloquent as Customer;

use App\Models\TableList;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Http\Requests\Admin\SettingsBrandRequest as BrandRequest;
use App\Models\Admin\SettingsStatus;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;

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
    protected $orderNoteRepo;
    protected $statusRepo;
    protected $tablelist;
    protected $settingsCategoryRepo;
    protected $productCategoryRepo;
    protected $userRepo;
    protected $pageBuilderRepo;
    protected $pageMetaTagRepo;
    protected $emailTemplateRepo;
    protected $smsTemplateRepo;
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
        OrderNote $orderNoteRepo,
        Status $statusRepo,
        TableList $tablelist,
        SettingsCategory $settingsCategoryRepo,
        ProductCategory $productCategoryRepo,
        User $userRepo,
        PageBuilder $pageBuilderRepo,
        PageMetaTag $pageMetaTagRepo,
        EmailTemplate $emailTemplateRepo,
        SmsTemplate $smsTemplateRepo,
        Customer $customerRepo
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
        $this->orderNoteRepo = $orderNoteRepo;
        $this->statusRepo = $statusRepo;
        $this->tablelist = $tablelist;
        $this->settingsCategoryRepo = $settingsCategoryRepo;
        $this->productCategoryRepo = $productCategoryRepo;
        $this->userRepo = $userRepo;
        $this->pageBuilderRepo = $pageBuilderRepo;
        $this->pageMetaTagRepo = $pageMetaTagRepo;
        $this->emailTemplateRepo = $emailTemplateRepo;
        $this->smsTemplateRepo = $smsTemplateRepo;
        $this->customerRepo = $customerRepo;
    }

    public function GetProduct($id)
    {
        $product = $this->productRepo->with(['networks.network'])->find($id);
        $product['storages'] = $product->storagesForBuying()->get();
        return response()->json($product);
    }

    public function PatchProduct(Request $request, $hashedId)
    {
        if ($request['product_id'] == 0 || $request['product_id'] == '') {
            $response['status'] = 400;
            $response['message'] = "Product is required.";
        } else if ($request['product_storage_id'] == 0 || $request['product_storage_id'] == '') {
            $response['status'] = 400;
            $response['message'] = "Storage is required.";
        } else if ($request['quantity'] == 0 || $request['quantity'] == '') {
            $response['status'] = 400;
            $response['message'] = "Quantity is required.";
        } else if ($request['network_id'] == 0 || $request['network_id'] == '') {
            $response['status'] = 400;
            $response['message'] = "Carrier is required.";
        } else if ($request['device_type'] == '') {
            $response['status'] = 400;
            $response['message'] = "Device Condition is required.";
        } else {
            $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
            $model = $this->orderItemRepo->rawByField("id = ?", [$id]);
            $productStorage = $this->productStorageRepo->rawByField("id = ? and product_id = ?", [$request['product_storage_id'], $request['product_id']]);

            if ($request['device_type'] == 1) {
                $amount = $productStorage['excellent_offer'];
            } else if ($request['device_type'] == 2) {
                $amount = $productStorage['good_offer'];
            } else if ($request['device_type'] == 3) {
                $amount = $productStorage['fair_offer'];
            } else {
                $amount = $productStorage['poor_offer'];
            }
            $total = $amount * $request['quantity'];
            $makeRequest = [
                'product_id' => $request['product_id'],
                'quantity' => $request['quantity'],
                'network_id' => $request['network_id'],
                'product_storage_id' => $request['product_storage_id'],
                'amount' => $total,
                'device_type' => $request['device_type'],
            ];
            $this->orderItemRepo->update($makeRequest, $id);
            $response['status'] = 200;
            $response['message'] = "Details updated.";
        }
        return response()->json($response);
    }

    public function GetModules()
    {
        $response['status'] = 200;
        $response['model'] = $this->tablelist->modulesList;
        return response()->json($response);
    }

    public function GetNotificationModules()
    {
        $response['status'] = 200;
        $response['model'] = $this->tablelist->notificationModules;
        return response()->json($response);
    }

    public function GetEnableOptions()
    {
        $response['status'] = 200;
        $response['model'] = $this->tablelist->enableOption;
        return response()->json($response);
    }

    public function PatchStatus(Request $request)
    {
        if ($request['id']) {
            $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($request['id']);
            $checkDuplicate = $this->statusRepo->rawByField("name = ? and module = ? and id != ?", [$request['name'], $request['module'], $id]);
        } else {
            $checkDuplicate = $this->statusRepo->rawByField("name = ? and module = ?", [$request['name'], $request['module']]);
        }
        if ($checkDuplicate) {
            $response['status'] = 400;
            $response['error'] = $request['name'] . ' in ' . $request['module'] . ' already exists';
        } else {
            $response['status'] = 200;
            $response['message'] = 'Status has been successfully updated';
            if ($request['id']) {
                $makeRequest = [
                    'name' => $request['name'],
                    'module' => $request['module'],
                    'badge' => $request['badge'],
                    'email_sending' => ($request['email_sending']) ? $request['email_sending'] : 'Disable',
                    'template__sms_id' => $request['sms_template_id'],
                    'template' => ($request['template']) ? $request['template'] : ''
                ];
                $this->statusRepo->update($makeRequest, $id);
            } else {
                $response['status'] = 200;
                $response['message'] = 'Status has been successfully added';
                $makeRequest = [
                    'id' => $request['id'],
                    'name' => $request['name'],
                    'module' => $request['module'],
                    'default' => 0,
                    'email_sending' => ($request['email_sending']) ? $request['email_sending'] : 'Disable',
                    'template__sms_id' => $request['sms_template_id'],
                    'template' => ($request['template']) ? $request['template'] : ''
                ];
                $this->statusRepo->create($makeRequest);
            }
        }
        return response()->json($response);
    }
    public function CancelOrder($hashedId)
    {


        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);

        $status = SettingsStatus::with('sms_template')->find('2');

        if ($status->sms_template()->exists() && $status->sms_template->status == 'Active') {
            $this->doSmsSending($status->sms_template, $id);
        }

        $makeRequest = ['status_id' => '2'];

        $this->orderRepo->update($makeRequest, $id);

        $response['status'] = 200;
        $response['message'] = "Order has been successfully canceled";

        return response()->json($response);
        
    }

    public function GetStatusDetails($hashedId)
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
        $response['status'] = 200;
        $response['model'] = $this->statusRepo->rawByWithField(['sms_template'], "id = ?", [$id]);
        return response()->json($response);
    }

    public function GetStatusByModule($module)
    {
        $response['status'] = 200;
        $response['model'] = $this->statusRepo->rawByFieldAll("module = ?", [ucfirst($module)]);
        return response()->json($response);
        return $module;
    }

    public function DeleteStatus($hashedId)
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
        $checkInUsed = $this->orderRepo->rawByField("status_id = ?", [$id]);
        $status = $this->statusRepo->find($id);
        if ($checkInUsed) {
            $response['status'] = 1010;
            $response['error'] = "Selected record is currently in used. Cannot be deleted";
        } else if ($status->default == 1) {
            $response['status'] = 406;
            $response['error'] = "Selected record cannot be modify";
        } else {
            $this->statusRepo->delete($id);
            $response['status'] = 200;
            $response['message'] = "Record has been successfully deleted";
        }
        return response()->json($response);
    }

    public function UpdateOrderStatus($hashedId, Request $request)
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);

        $status = SettingsStatus::with('sms_template')->find($request['status_id']);

        if ($status->sms_template()->exists() && $status->sms_template->status == 'Active') {
            $this->doSmsSending($status->sms_template, $id);
        }

        $makeRequest = ['status_id' => $request['status_id']];

        $this->orderRepo->update($makeRequest, $id);

        $response['status'] = 200;
        $response['message'] = "Record has been successfully updated";

        return response()->json($response);
    }
    public function UpdateOrderReduction($hashedId, Request $request)
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);

        $makeRequest = ['reduction' => $request['reduction']];

        $this->orderRepo->update($makeRequest, $id);

        $response['status'] = 200;
        $response['message'] = "Record has been successfully updated";

        return response()->json($response);
    }

    public function DeleteOrder($hashedId)
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
        $this->orderRepo->delete($id);
        $response['status'] = 200;
        $response['message'] = "Record has been successfully deleted";
        return response()->json($response);
    }


    public function DeleteOrderItem($hashedId)
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
        $this->orderItemRepo->delete($id);
        $response['status'] = 200;
        $response['message'] = "Record has been successfully deleted";
        return response()->json($response);
    }



    public function PatchCategories(Request $request)
    {
        if ($request['id']) {
            $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($request['id']);
            $checkDuplicate = $this->settingsCategoryRepo->rawByField("name = ? and id != ?", [$request['name'], $id]);
        } else {
            $checkDuplicate = $this->settingsCategoryRepo->rawByField("name = ?", [$request['name']]);
        }
        if ($checkDuplicate) {
            $response['status'] = 400;
            $response['error'] = $request['name'] . ' already exists';
        } else {
            $response['status'] = 200;
            $response['message'] = 'Status has been successfully saved.';
            $makeRequest = ['name' => $request['name']];
            if ($request['id']) {
                $this->settingsCategoryRepo->update($makeRequest, $id);
            } else {
                $this->settingsCategoryRepo->create($makeRequest);
            }
        }
        return response()->json($response);
    }

    public function GetCategoryDetails($hashedId)
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
        $response['status'] = 200;
        $response['model'] = $this->settingsCategoryRepo->rawByField("id = ?", [$id]);
        return response()->json($response);
    }

    public function DeleteCategory($hashedId)
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
        $checkInUsed = $this->productCategoryRepo->rawByField("category_id = ?", [$id]);
        $category = $this->settingsCategoryRepo->find($id);
        if ($checkInUsed) {
            $response['status'] = 1010;
            $response['error'] = "Selected record is currently in used. Cannot be deleted";
        } else {
            $this->settingsCategoryRepo->delete($id);
            $response['status'] = 200;
            $response['message'] = "Record has been successfully deleted";
        }
        return response()->json($response);
    }

    public function GetPageBuilderList()
    {
        $response['status'] = 200;
        $response['model'] = $this->pageBuilderRepo->all();
        return response()->json($response);
    }

    public function GetMetaTagNameList()
    {
        $response['status'] = 200;
        $response['model'] = $this->tablelist->array_meta_tags;
        return response()->json($response);
    }

    public function GetMetaTagDetails($hashedPageId, $hashedTagId)
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedTagId);

        $response['model'] = $this->pageMetaTagRepo->rawByWithField(['page'], "id = ?", [$id]);
        // $response['model'] = $this->pageMetaTagRepo->find($id);
        $response['status'] = 200;
        return response()->json($response);
    }

    public function PatchMetaTags(Request $request)
    {
        if ($request['id']) {
            $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($request['id']);
            $checkDuplicate = $this->pageMetaTagRepo->rawByField("name = ? and page_id = ? and id != ?", [$request['name'], $request['page_id'], $id]);
        } else {
            $checkDuplicate = $this->pageMetaTagRepo->rawByField("name = ? and page_id = ?", [$request['name'], $request['page_id']]);
        }
        if ($checkDuplicate) {
            $response['status'] = 400;
            $response['error'] = $request['name'] . ' in page already exists';
        } else {
            $response['status'] = 200;
            $response['message'] = 'Status has been successfully saved.';
            $makeRequest = [
                'name' => $request['name'],
                'page_id' => $request['page_id'],
                'meta_type' => (substr($request['name'], 0, 2) == 'og') ? 'property' : 'name',
                'content' => $request['content']
            ];
            if ($request['id']) {
                $this->pageMetaTagRepo->update($makeRequest, $id);
            } else {
                $this->pageMetaTagRepo->create($makeRequest);
            }
        }
        return response()->json($response);
    }

    public function DeleteMetaTag($hashedPageId, $hashedTagId)
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedTagId);
        $this->pageMetaTagRepo->delete($id);
        $response['status'] = 200;
        $response['message'] = "Meta tag has been successfully deleted";
        return response()->json($response);
    }


    public function StoreBrands(BrandRequest $request)
    {
        $id = $request['id'];
        $user_id = Auth::user()->id;
        $path = 'uploads/brands';
        $field = $request->file('photo');
        $hasfile = $request->hasFile('photo');

        if ($id) {
            $brand = $this->brandRepo->find($id);
            $photo = resizeFileUpload($path, $field, $hasfile, 250, $brand->photo, $brand->full_size);
            $makeRequest = [
                'name' => $request['name'],
                'device_type' => $request['device_type'],
                'photo' => $photo['small'],
                'full_size' => $photo['full'],
                'feature' => $request['feature'],
                'user_create' => $user_id,
                'user_update' => $user_id
            ];
            $this->brandRepo->update($makeRequest, $id);
            $data['response'] = 1;
            return response()->json($data);
        }

        $photo = resizeFileUpload($path, $field, $hasfile, 250);
        $makeRequest = [
            'name' => $request['name'],
            'device_type' => $request['device_type'],
            'photo' => $photo['small'],
            'full_size' => $photo['full'],
            'feature' => $request['feature'],
            'user_create' => $user_id,
            'user_update' => $user_id
        ];
        $this->brandRepo->create($makeRequest);
        $data['response'] = 1;
        return response()->json($data);
    }

    public function GetBrandDetails($hashedId)
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
        $data['brand'] = $this->brandRepo->find($id);
        return response()->json($data);
    }

    public function DeleteBrand($hashedId)
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
        $this->brandRepo->delete($id);
        $response['status'] = 200;
        $response['message'] = "Record has been successfully deleted";
        return response()->json($response);
    }

    /**
     * Email Template
     */

    public function PatchEmailTemplate(Request $request)
    {
        if ($request['id']) {
            // return $request->all();
            $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($request['id']);
            $checkDuplicate = $this->emailTemplateRepo->rawByField("name = ? and id != ?", [$request['name'], $id]);
        } else {
            $checkDuplicate = $this->emailTemplateRepo->rawByField("name = ?", [$request['name']]);
        }
        if ($checkDuplicate) {
            $response['status'] = 400;
            $response['error'] = $request['name'] . ' already exists';
        } else {
            $response['status'] = 200;
            $response['message'] = 'Email Template has been successfully updated';
            if ($request['id']) {
                $makeRequest = [
                    'name' => $request->name,
                    'subject' => $request->subject,
                    'description' => $request->description,
                    'status' => $request->status,
                    'model' => $request->model,
                    'scheduled_days' => $request->scheduled_days,
                    'receiver' => $request->receiver,
                    'content' => $request->content,
                ];
                $this->emailTemplateRepo->update($makeRequest, $id);
            } else {
                $makeRequest = [
                    'name' => $request->name,
                    'subject' => $request->subject,
                    'description' => $request->description,
                    'status' => $request->status,
                    'model' => $request->model,
                    'scheduled_days' => $request->scheduled_days,
                    'receiver' => $request->receiver,
                    'content' => $request->content,
                ];
                $this->emailTemplateRepo->create($makeRequest);
                $response['status'] = 200;
                $response['message'] = "Email Template has been successfully saved";
            }
        }
        return response()->json($response);
    }

    public function GetEmailTemplate($hashedId)
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
        $data['status'] = 200;
        $data['emailtemplate'] = $this->emailTemplateRepo->find($id);
        return response()->json($data);
    }

    public function DeleteEmailTemplate($hashedId)
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
        $this->emailTemplateRepo->delete($id);
        $response['status'] = 200;
        $response['message'] = "Record has been successfully deleted";
        return response()->json($response);
    }

    /**
     * SMS Template
     */


    public function GetSmsTemplatesList()
    {
        $data['status'] = 200;
        $data['model'] = $this->smsTemplateRepo->rawByFieldAll('model = ? and status = ?', ['Orders', 'Active']);
        return response()->json($data);
    }

    public function PatchSmsTemplate(Request $request)
    {
        if ($request['id']) {
            $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($request['id']);
            $checkDuplicate = $this->smsTemplateRepo->rawByField("name = ? and id != ?", [$request['name'], $id]);
        } else {
            $checkDuplicate = $this->smsTemplateRepo->rawByField("name = ?", [$request['name']]);
        }
        if ($checkDuplicate) {
            $response['status'] = 400;
            $response['error'] = $request['name'] . ' already exists';
        } else {
            $response['status'] = 200;
            $response['message'] = 'SMS Template has been successfully updated';
            if ($request['id']) {
                $makeRequest = [
                    'name' => $request->name,
                    'content' => $request->content,
                    'status' => $request->status,
                    'model' => $request->model,
                    'receiver' => $request->receiver,
                ];
                $this->smsTemplateRepo->update($makeRequest, $id);
            } else {
                $makeRequest = [
                    'name' => $request->name,
                    'content' => $request->content,
                    'status' => $request->status,
                    'model' => $request->model,
                    'receiver' => $request->receiver,
                ];
                $this->smsTemplateRepo->create($makeRequest);
                $response['status'] = 200;
                $response['message'] = "SMS Template has been successfully saved";
            }
        }
        return response()->json($response);
    }

    public function GetSmsTemplate($hashedId)
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
        $data['status'] = 200;
        $data['smstemplate'] = $this->smsTemplateRepo->find($id);
        return response()->json($data);
    }

    public function DeleteSmsTemplate($hashedId)
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
        $this->smsTemplateRepo->delete($id);
        $response['status'] = 200;
        $response['message'] = "Record has been successfully deleted";
        return response()->json($response);
    }



    /**
     * CRON JOBS
     */



    public function NotifyDay7()
    {
        $subject = 'TronicsPay: Order Reminder';

        $data['config'] = $this->configRepo->find(1);

        $data['overallSubTotal'] = 0;
        $data['counter'] = 1;

        $dateMinusToday = date('Y-m-d', strtotime("-7 day"));

        $ordersStartedDays = $this->orderRepo->rawByWithField(
            [
                'customer',
                'customer.bill',
                'order_item',
                'order_item.product',
                'order_item.product.brand',
                'order_item.network',
                'order_item.product_storage'
            ],
            "transaction_date = ?",
            [$dateMinusToday]
        );

        foreach ($ordersStartedDays as $key => $value) {
            $email = $value['customer']['email'];
            $data['customer_transaction'] = $value;
            $data['shippingFee'] = $value['shipping_fee'];
            $content = view('mail.notifyday7', $data)->render();
            Mail::send([], [], function (Message $message) use ($email, $subject, $content) {
                $message->to($email)
                    ->subject($subject)
                    ->setBody($content, 'text/html');
            });
        }

        return true;
    }

    public function NotifyDay29()
    {
        $subject = 'TronicsPay: Order Cancelled';

        $data['config'] = $this->configRepo->find(1);

        $data['overallSubTotal'] = 0;
        $data['counter'] = 1;

        $dateMinusToday = date('Y-m-d', strtotime("-29 day"));

        $ordersStartedDays = $this->orderRepo->rawByWithField(
            [
                'customer',
                'customer.bill',
                'order_item',
                'order_item.product',
                'order_item.product.brand',
                'order_item.network',
                'order_item.product_storage'
            ],
            "transaction_date = ? and status_id IN (4, 11, 12)",
            [$dateMinusToday]
        );

        foreach ($ordersStartedDays as $key => $value) {
            $email = $value['customer']['email'];
            $data['customer_transaction'] = $value;
            $data['shippingFee'] = $value['shipping_fee'];
            $content = view('mail.notifyday29', $data)->render();
            Mail::send([], [], function (Message $message) use ($email, $subject, $content) {
                $message->to($email)
                    ->subject($subject)
                    ->setBody($content, 'text/html');
            });
        }
        return true;
    }


    public function NotifyCustomerOrder()
    {
        $subject = 'TronicsPay:  - Order Reminder';

        $data['config'] = $this->configRepo->find(1);

        $dateMinusToday = date('Y-m-d', strtotime("-7 day"));

        $ordersStartedDays = $this->orderRepo->rawByWithField(
            [
                'customer',
                'customer.bill',
                'order_item',
                'order_item.product',
                'order_item.product.brand',
                'order_item.network',
                'order_item.product_storage'
            ],
            "transaction_date = ?",
            [$dateMinusToday]
        );

        foreach ($ordersStartedDays as $key => $value) {
            $email = $value['customer']['email'];
            $data['customer_transaction'] = $value;
            $content = view('mail.customerorder', $data)->render();
            Mail::send([], [], function (Message $message) use ($email, $subject, $content) {
                $message->to($email)
                    ->subject($subject)
                    ->setBody($content, 'text/html');
            });
            return $content;
        }

        return true;
    }


    public function StoreUser(UserRequest $request)
    {
        $makeRequest = [
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'status' => 'Active'
        ];
        $this->userRepo->create($makeRequest);
        return redirect()->to('admin/settings/users');
    }

    public function UpdateUser(UpdateUserRequest $request, $hashedId)
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
        if ($request['password']) {
            $makeRequest = [
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
                'status' => 'Active'
            ];
        } else {
            $makeRequest = [
                'name' => $request['name'],
                'email' => $request['email'],
                'status' => 'Active'
            ];
        }
        $this->userRepo->update($makeRequest, $id);
        return redirect()->to('admin/settings/users');
    }

    public function DestroyUser($hashedId)
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
        $this->userRepo->update(['status' => 'Inactive'], $id);
        $data['response'] = 1;
        $data['status'] = 200;
        $data['message'] = 'User has been successfully deleted';
        return response()->json($data);
    }

    public function GetOrder($hashedId)
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
        $data['status'] = 200;
        $data['order'] = $this->orderRepo->with(['order_item'])->find($id);

        if ($data['order']['payment_method'] == "Bank Transfer" || $data['order']['payment_method'] == "Paypal") {
            $data['payment'] = 'Paypal';
            $data['paypal_credentials'] = $this->tablelist->paypal_sandbox_account;
        } else if ($data['order']['payment_method'] == "Apple Pay") {
            $data['payment'] = 'Apple Pay';
            $data['payment_image'] = '<img src="' . url('/assets/images/payments/1.png') . '" alt="Apple Pay">';
        } else if ($data['order']['payment_method'] == "Google Pay") {
            $data['payment'] = 'Google Pay';
            $data['payment_image'] = '<img src="' . url('/assets/images/payments/2.png') . '" alt="Google Pay">';
        } else if ($data['order']['payment_method'] == "Venmo") {
            $data['payment'] = 'Venmo';
            $data['payment_image'] = '<img src="' . url('/assets/images/payments/3.png') . '" alt="Venmo">';
        } else if ($data['order']['payment_method'] == "Cash App") {
            $data['payment'] = 'Cash App';
            $data['payment_image'] = '<img src="' . url('/assets/images/payments/4.png') . '" alt="Cash App">';
        }
        return response()->json($data);
    }

    
    public function GetOrderItem($hashedId)
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
        $data['customerSell'] = $this->orderItemRepo->rawByWithField(['product_storage'], 'id = ?', [$id]);
        $data['productDetails'] = $this->productRepo->rawByWithField(['networks.network'], 'id = ?', [$data['customerSell']['product_id']]);
        $data['productDetails']['storages'] = $data['productDetails']->storagesForBuying()->get();
        // $networks = $data['productDetails']['networks']; 
        $curr_network_id = $data['customerSell']['network_id'];
        $prod_storages = $data['productDetails']['storages'];
        $all_networks = $this->networkRepo->all(null, null, ['id', 'title']);
        
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

    public function OrderPaymentSuccess($hashedId)
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
        $status = $this->statusRepo->rawByField("name = ?", ['Payment sent']);
        $data['order'] = $this->orderRepo->with(['customer'])->find($id);

        $email = $data['order']['customer']['email'];
        $subject = 'TronicsPay | Payment Order #' . $data['order']['order_no'];
        $content = view('mail.paymentOrder', $data)->render();

        Mail::send([], [], function (Message $message) use ($email, $subject, $content) {
            $message->to($email)
                ->subject($subject)
                ->setBody($content, 'text/html');
        });

        $response['status'] = 200;
        $response['message'] = 'Order # ' . $data['order']['order_no'] . ' has been successfully paid';

        $makeRequest = [
            'status_id' => $status['id']
        ];
        $this->orderRepo->update($makeRequest, $id);

        return response()->json($response);
    }

    public function GetOrderNotes($hashedId)
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);

        //$response['model'] = $this->orderNoteRepo->findByFieldAll('order_id', $id);
        $response['model'] = $this->orderNoteRepo->rawByWithFieldAll(['order.customer'], 'order_id = ?', [$id]);
        $response['status'] = 200;
        return response()->json($response);
        return $hashedId;
    }

    public function StoreOrderNotes(Request $request)
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($request['hashedid']);
        $order = $this->orderRepo->rawByWithField(['customer.bill', 'status_details'], "id = ?", [$id]);
        $makeRequest = [
            'order_id' => $id,
            'notes' => $request['notes']
        ];
        $this->orderNoteRepo->create($makeRequest);
        $phone = $order['customer']['bill']['phone'];
        $message = 'Order: ' . $order['order_no'] . ' has new notes made by TronicsPay.
        
' . $request['notes'] . '

To reply, type:
#support ' . $order['order_no'] . ' followed by your message';

        app('App\Http\Controllers\GlobalFunctionController')->doSmsSending($phone, $message);
        $response['status'] = 200;
        $response['message'] = 'Note has been successfully posted';
        return response()->json($response);
    }

    public function UpdateOrderNote($hashedId, Request $request)
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($request['hashedid']);
        $makeRequest = [
            'notes' => $request['notes']
        ];
        $this->orderNoteRepo->update($makeRequest, $id);

        $response['status'] = 201;
        $response['message'] = 'Note has been successfully updated';
        return response()->json($response);
    }

    public function DeleteOrderNote($hashedId)
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
        $this->orderNoteRepo->delete($id);
        $response['status'] = 201;
        $response['message'] = "Record has been successfully deleted";
        return response()->json($response);
    }

    public function DeleteCustomers(Request $request)
    {
        $ids = $request['ids'];
        foreach ($ids as $id) {
            $order = $this->orderRepo->findByField("customer_id", $id);

            if ($order) {
                $response['message'] = 'Customer has orders and cannot be deleted.';
            } else {
                $this->customerRepo->delete($id);
            }
        }

        $response['status'] = 200;
        return response()->json($response);
    }

    public function GetSMSCredit()
    {
        $client = new Client(config('services.twilio.sid'), config('services.twilio.auth_token'));

        $output['status'] = 200;
        $output['model'] = $client->balance->fetch()->balance;

        return response()->json($output);
    }

    private function doSmsSending($sms_template, $order_id)
    {
        if (app('App\Http\Controllers\GlobalFunctionController')->checkSMSFeatureIfActive() == false) return false;

        $data['placeholder_customer_list'] = $this->tablelist->placeholder_customer_list;
        $data['placeholder_order_list'] = $this->tablelist->placeholder_order_list;

        $order = $this->orderRepo->rawByWithField(['customer', 'status_details'], "id = ?", [$order_id]);

        $message = replaceSMSPlaceHolder($sms_template->content, $order);

        return app('App\Http\Controllers\GlobalFunctionController')->doSmsSending($order['customer']['bill']['phone'], $message);
    }
}
