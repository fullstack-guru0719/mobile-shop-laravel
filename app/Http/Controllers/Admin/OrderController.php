<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BulkCompleteRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Admin\OrderRepositoryEloquent as Order;
use App\Repositories\Admin\OrderItemRepositoryEloquent as OrderItem;
use App\Repositories\Admin\ConfigRepositoryEloquent as Config;
use App\Repositories\Admin\ProductRepositoryEloquent as Product;
use App\Repositories\Admin\NetworkRepositoryEloquent as Network;

use EasyPost\Parcel;
use EasyPost\Address;
use EasyPost\Tracker;
use EasyPost\EasyPost;
use EasyPost\Shipment;
use App\Models\TableList as Tablelist;

class OrderController extends Controller
{
    protected $orderRepo;
    protected $orderItemRepo;
    protected $configRepo;
    protected $productRepo;
    protected $tablelist;
    protected $networkRepo;


    function __construct(
        Order $orderRepo,
        OrderItem $orderItemRepo,
        Config $configRepo,
        Product $productRepo,
        Tablelist $tablelist,
        Network $networkRepo
    ) {
        $this->orderRepo = $orderRepo;
        $this->orderItemRepo = $orderItemRepo;
        $this->configRepo = $configRepo;
        $this->productRepo = $productRepo;
        $this->tablelist = $tablelist;
        $this->networkRepo = $networkRepo;
    }

    public function index()
    {
        $data['paypal'] = $this->tablelist->paypal_account;
        $data['module'] = 'order';
        $config = $this->configRepo->find(1);
        $data['is_dark_mode'] = ($config['is_dark_mode'] == 1) ? true : false;
        return view('admin.orders.index', $data);
    }


    public function edit($hashedId)
    {

        $data['module'] = 'order';
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
        $data['config'] = $this->configRepo->find(1);

        $data['order'] = $this->orderRepo
            ->rawByWithField(
                [
                    'customer',
                    'customer.bill',
                    'order_item',
                    'order_item.product',
                    'order_item.product.brand',
                    'order_item.network',
                    'order_item.product_storage'
                ],
                "id = ?",
                [$id]
            );
        // $data['customer'] = $this->customerTransactionRepo->rawByWithField(['bill', 'sells', 'sells.product', 'sells.network', 'sells.product_storage'], "id = ?", [$id]);
        $data['hashedId'] = $hashedId;

        $config = $this->configRepo->find(1);
        $data['products'] = $this->productRepo->rawWith(['brand', 'photo', 'networks.network', 'storages'], "status = ?", ['Active']);
        $data['is_dark_mode'] = ($config['is_dark_mode'] == 1) ? true : false;
        return view('admin.orders.edit', $data);
    }

    public function delete($hashedId)
    {

        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
        $data = $this->orderRepo
            ->rawByWithField(
                [
                    'order_item.product',
                ],
                "id = ?",
                [$id]
            );


        if (!$data) {
            return response()->json([
                "status" => false,
                "message" => "No order found",
            ]);
        }

        foreach ($data['order_item'] as $item) {
            $this->orderItemRepo->delete($item['id']);
        }
        $this->orderRepo->delete($id);

        return response()->json([
            "status" => 200,
            "message" => "Successfully deleted",
        ]);
    }


    public function deleteMany(Request $request)
    {

        foreach ($request["ids"] as $id) {

            $data = $this->orderRepo
                ->rawByWithField(
                    [
                        'order_item.product',
                    ],
                    "id = ?",
                    [$id]
                );


            if (!$data) {
                return response()->json([
                    "status" => false,
                    "message" => "No order found",
                ]);
            }

            foreach ($data['order_item'] as $item) {
                $this->orderItemRepo->delete($item['id']);
            }
            $this->orderRepo->delete($id);
        }


        return response()->json([
            "status" => 200,
            "message" => "Successfully deleted",
        ]);
    }


    public function generatePDF($hashedId)
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
        $config = $this->configRepo->find(1);

        $overallSubTotal = 0;
        $counter = 1;

        $customer_transaction = $this->orderRepo->rawByWithField(
            [
                'customer',
                'customer.bill',
                'order_item',
                'order_item.product',
                'order_item.product.brand',
                'order_item.network',
                'order_item.product_storage'
            ],
            "id = ?",
            [$id]
        );

        $shippingFee = $customer_transaction['shipping_fee'];
        $generateHtml = '<html>
                            <head>
                                <style>
                                    body, td {
                                        font-family: Arial, Helvetica, sans-serif;
                                        font-size: 12px;
                                    }
                                    .bordered {
                                        border: 1px solid #000;
                                    }
                                    .table:not(.table-dark) {
                                        color: inherit;
                                    }
                                    .table {
                                        width: 100%;
                                        margin-bottom: 1rem;
                                        color: #212529;
                                        background-color: transparent;
                                    }
                                    table {
                                        border-collapse: collapse;
                                    }
                                    table {
                                        // border-collapse: separate;
                                        text-indent: initial;
                                        border-spacing: 2px;
                                    }
                                    thead {
                                        display: table-header-group;
                                        vertical-align: middle;
                                        border-color: inherit;
                                    }
                                    .table th, .table td {
                                        padding: .75rem;
                                        vertical-align: top;
                                        border-top: 1px solid #dee2e6;
                                    }
                                    .valign-top {
                                        vertical-align: top;
                                    }
                                    .label {
                                        font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
                                        display: inline;
                                        padding: .2em .6em .3em;
                                        font-size: 75%;
                                        font-weight: 700;
                                        line-height: 1;
                                        color: #fff;
                                        text-align: center;
                                        white-space: nowrap;
                                        vertical-align: baseline;
                                        border-radius: .25em;
                                    }
                                    .label-default {
                                        background-color: #777;
                                    }
                                    .label-primary {
                                        background-color: #337ab7;
                                    }
                                    .label-success {
                                        background-color: #5cb85c;
                                    }
                                    .label-info {
                                        background-color: #5bc0de;
                                    }
                                    .label-warning {
                                        background-color: #f0ad4e;
                                    }
                                    .label-danger {
                                        background-color: #d9534f;
                                    }
                                    .pad10rem {
                                        padding: .10rem;
                                    }
                                    .lead {
                                        font-family: Arial, Helvetica, sans-serif;
                                        font-size: 1.25rem;
                                        font-weight: 300;
                                    }
                                    img { display:block }
                                </style>
                            </head>
                            <body>
                                <div class="borderedx">
                                    <table width="100%">
                                        <tr>
                                            <td><img src="http://tronicspay.com/assets/images/logo.png"></td>
                                            <td align=right>Date: ' . $customer_transaction['display_transaction_date'] . '</td>
                                        </tr>
                                    </table>
                                    <br />
                                    <table width="100%">
                                        <tr>
                                            <td width="34%" style="vertical-align: top;">
                                                <div class="pad10rem">From</div>
                                                <div>
                                                    <div class="pad10rem"><strong>' . $customer_transaction['customer']['fullname'] . '</strong><br></div>
                                                    <div class="pad10rem">' . $customer_transaction['customer']['bill']['address1'] . '<br></div>
                                                    <div class="pad10rem">Phone: ' . $customer_transaction['customer']['bill']['phone'] . '<br></div>
                                                    <div class="pad10rem">Email: ' . $customer_transaction['customer']['email'] . '</div>
                                                </div>
                                            </td>
                                            <td width="33%" style="vertical-align: top;">
                                                <div class="pad10rem">To</div>
                                                <div>
                                                    <div class="pad10rem"><strong>' . $config['company_name'] . '</strong><br></div>
                                                    <div class="pad10rem">' . $config['address1'] . '<br></div>
                                                    <div class="pad10rem">Phone: ' . $config['address1'] . '<br></div>
                                                    <div class="pad10rem">Email: ' . $config['company_email'] . '</div>
                                                </div>
                                            </td>
                                            <td width="33%" style="vertical-align: top;">
                                                <div class="pad10rem"><b>Transaction #' . $customer_transaction['order_no'] . '</b></div>
                                                <br />
                                                <div class="pad10rem"><b>Tracking Code:</b> ' . $customer_transaction['tracking_code'] . '<br /></div>
                                                <div class="pad10rem"><b>Status:</b> ' . strtoupper(str_replace("_", " ", $customer_transaction['shipping_status'])) . '<br /></div>
                                                <div class="pad10rem"><b>Delivery Due:</b> ' . $customer_transaction['display_delivery_due'] . '<br /></div>
                                            </td>
                                        </tr>
                                    </table>
                                    <br />
                                    <table class="table table-striped" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th width="7%"><center>#</center></th>
                                                <th width="23%" style="text-align: left;">Product</th>
                                                <th width="14%"><center>Storage</center></th>
                                                <th width="14%"><center>Qty</center></th>
                                                <th width="14%"><center>Condition</center></th>
                                                <th width="14%"><center>Carrier</center></th>
                                                <th width="14%" style="text-align: right;">Cash Offer</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
        foreach ($customer_transaction['order_item'] as $key => $value) {
            $subTotal = $value['quantity'] * $value['amount'];
            $overallSubTotal = $overallSubTotal + $subTotal;
            $displayCounter = $counter + $key;
            $generateHtml .= '<tr>
                                                    <td align="center">' . $displayCounter . '</td>
                                                    <td>' . $value['product']['brand']['name'] . ' ' . $value['product']['model'] . '</td>
                                                    <td align="center">' . $value['product_storage']['title'] . '</td>
                                                    <td align="center">' . $value['quantity'] . '</td>
                                                    <td align="center">';
            if ($value['device_type'] == 1) {
                $generateHtml .= '<label class="label label-success">Excellent</label>';
            } else if ($value['device_type'] == 2) {
                $generateHtml .= '<label class="label label-info">Good</label>';
            } else if ($value['device_type'] == 3) {
                $generateHtml .= '<label class="label label-warning">Fair</label>';
            } else if ($value['device_type'] == 0) {
                $generateHtml .= '<label class="label label-danger">Poor</label>';
            } else {
                $generateHtml .= '<label class="label label-danger">Unknown</label>';
            }
            $generateHtml .= '</td>
                                                    <td align="center">' . $value['network']['title'] . '</td>
                                                    <td align="right">$' . number_format($subTotal, 2, '.', ',') . '</td>
                                                </tr>';
        }
        $generateHtml .= '</tbody>
                                        </table>
                                        <table width="100%">
                                            <tr>
                                                <td width="50%" class="valign-top">
                                                    <table width="100%">
                                                        <tr>
                                                            <td class="lead">Payment Method:</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pad10rem">
                                                                <table width="100%">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="20%">';

        if (isset($customer_transaction) && $customer_transaction['payment_method'] != '') {
            if ($customer_transaction['payment_method'] == "Bank Transfer") {
                $generateHtml .= '<img src="http://tronicspay.com/assets/images/payments/6.png" alt="Bank Transfer" style="width: 60px;">';
            } else if ($customer_transaction['payment_method'] == "Apple Pay") {
                $generateHtml .= '<img src="http://tronicspay.com/assets/images/payments/1.png" alt="Apple Pay" style="width: 60px;">';
            } else if ($customer_transaction['payment_method'] == "Google Pay") {
                $generateHtml .= '<img src="http://tronicspay.com/assets/images/payments/2.png" alt="Google Pay" style="width: 60px;">';
            } else if ($customer_transaction['payment_method'] == "Venmo") {
                $generateHtml .= '<img src="http://tronicspay.com/assets/images/payments/3.png" alt="Venmo" style="width: 60px;">';
            } else if ($customer_transaction['payment_method'] == "Cash App") {
                $generateHtml .= '<img src="http://tronicspay.com/assets/images/payments/4.png" alt="Cash App" style="width: 60px; height: 30px;">';
            } else if ($customer_transaction['payment_method'] == "Paypal") {
                $generateHtml .= '<img src="http://tronicspay.com/assets/images/payments/5.png" alt="Paypal" style="width: 60px;">';
            }
        }

        $generateHtml .= '</td>
                                                                            <td width="80%">' . $customer_transaction['payment_method'] . '</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>';
        if ($customer_transaction['payment_method'] == "Bank Transfer") {
            $generateHtml .= '<tr>
                                                            <td class="pad10rem"><b>Bank Name: </b>' . $customer_transaction['account_bank'] . '</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pad10rem"><b>Account Name: </b>' . $customer_transaction['account_name'] . '</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pad10rem"><b>Account Number: </b>' . $customer_transaction['account_number'] . '</td>
                                                        </tr>';
        } else {
            $generateHtml .= '<tr>
                                                            <td class="pad10rem"><b>Account Username: </b>' . $customer_transaction['account_username'] . '</td>
                                                        </tr>';
        }
        $generateHtml .= '</table>
                                        </td>
                                        <td width="50%" class="valign-top">
                                            <table class="table" width="100%">
                                                <tbody>
                                                    <tr>
                                                        <th style="width:50%">Cash Offer:</th>
                                                        <td>$' . number_format($overallSubTotal, 2, '.', ',') . '</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Shipping:</th>
                                                        <td>$' . number_format($shippingFee, 2, '.', ',') . '</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total:</th>
                                                        <td>$' . number_format($overallSubTotal + $shippingFee, 2, '.', ',') . '</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                </div>';
        $generateHtml .= '</body>
                        </html>';

        $pdf = \App::make('dompdf.wrapper');
        $pdf->setOptions(['isRemoteEnabled' => true])->loadHTML($generateHtml);
        return $pdf->download('Customer_Device_' . $customer_transaction['customer']['fullname'] . '.pdf');
        return $pdf->stream();
    }

    public function getOrderItem($hashedId)
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
        $data['customerSell'] = $this->orderItemRepo->rawByWithField(['product_storage'], 'id = ?', [$id]);
        $data['productDetails'] = $this->productRepo->rawByWithField(['storages.network'], 'id = ?', [$data['customerSell']['product_id']]);

        foreach ($data['productDetails']['storages'] as $storage) {
            $data['networks'][$storage->network->id] = $storage->network->title;
        }

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


    /**
     * Bulk change status to complete
     *
     * @param Illuminate\Http\Request
     *
     * @return view
     */
    public function bulk_update(BulkCompleteRequest $request)
    {
        $status_id = $request->get('status-id');

        if (!$status_id) {
            session()->flash("notification-status", "error");
            session()->flash("notification-message", "Something went wrong!");
            return redirect()->route('orders.index');
        }

        foreach ($request->get('form_ids') as $id) {
            $order = $this->orderRepo->find($id);
            if ($order) {
                $order->update([
                    "status_id" => $status_id
                ]);
            }
        }

        return redirect()->route('orders.index');
    }


    public function get_shipping_status($id)
    {
        EasyPost::setApiKey(config('account.easypost_apikey'));

        $shipment = Shipment::retrieve($id);


        // die(print_r($shipment, true));
        return response()->json([
            "status" => 200,
            "result" => ["status" => $shipment->status, "due" => $shipment->tracker->est_delivery_date],
        ]);
    }
}
