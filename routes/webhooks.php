<?php

use App\Models\Admin\Order;
use App\Models\Admin\OrderNote;
use App\Models\Customer\CustomerAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/webhooks/twilio', function (Request $request) {

    if ($request->AccountSid != config('services.twilio.sid'))
        abort(404);

    if (empty(CustomerAddress::where('phone', $request->From)->first()))
        abort(404);

    $segments = explode(' ', trim($request->Body));
    $command = strtolower($segments[0]);

    switch ($command) {
        case '#support':

            if (count($segments) > 1) {

                $order_no = strtoupper($segments[1]);
                $order = Order::with('customer.bill')->where('order_no', $order_no)->first();

                if ($order && $order->customer->bill->phone == $request->From) {

                    OrderNote::create([
                        'order_id' => $order->id,
                        'customer_id' => $order->customer->id,
                        'notes' => trim(str_replace([$segments[0], $segments[1]], '', $request->Body))
                    ]);
                } else {
                    $orders = Order::whereHas('customer.bill', function ($query) use ($request) {
                        $query->where('phone', $request->From);
                    })->where('status_id', '!=', '5')->where('status_id', '!=', '9')->get();

                    if (count($orders) == 1) {
                        $order = $orders->first();

                        OrderNote::create([
                            'order_id' => $order->id,
                            'customer_id' => $order->customer->id,
                            'notes' => trim(str_replace($segments[0], '', $request->Body))
                        ]);
                    } else {

                        $order_numbers = "";

                        foreach ($orders as $order) {
                            $order_numbers .= $order->order_no . PHP_EOL;
                        }

                        app('App\Http\Controllers\GlobalFunctionController')->doSmsSending(
                            $request->From,
                            'You have multiple orders. You need to specify which order by typing "#support order_no `Your message`".' . PHP_EOL .
                                'Your order numbers:' . PHP_EOL . $order_numbers
                        );
                    }
                }
            }
            break;
        case '#tracking':

            if (count($segments) == 1) {

                $orders = Order::whereHas('customer.bill', function ($query) use ($request) {
                    $query->where('phone', $request->From);
                })->where('status_id', '!=', '5')->where('status_id', '!=', '9')->get();

                if (count($orders) == 1) {
                    $order = $orders->first();

                    app('App\Http\Controllers\GlobalFunctionController')->doSmsSending(
                        $request->From,
                        'Tracking information for order ' . $order->order_no . ':' . PHP_EOL . PHP_EOL .
                            'Tracking number: ' . $order->tracking_code . PHP_EOL .
                            'Tracking link: ' . $order->shipping_tracker
                    );
                } else {

                    $order_numbers = "";

                    foreach ($orders as $order) {
                        $order_numbers .= $order->order_no . PHP_EOL;
                    }

                    app('App\Http\Controllers\GlobalFunctionController')->doSmsSending(
                        $request->From,
                        'You have multiple orders. You need to specify which order by typing "#tracking order_no".' . PHP_EOL .
                            'Your order numbers:' . PHP_EOL . $order_numbers
                    );
                }
            }

            if (count($segments) == 2) {

                $order_no = strtoupper($segments[1]);
                $order = Order::with('customer.bill')->where('order_no', $order_no)->first();

                if ($order && $order->customer->bill->phone == $request->From) {

                    app('App\Http\Controllers\GlobalFunctionController')->doSmsSending(
                        $request->From,
                        'Tracking information for order ' . $order->order_no . ':' . PHP_EOL . PHP_EOL .
                            'Tracking number: ' . $order->tracking_code . PHP_EOL .
                            'Tracking link: ' . $order->shipping_tracker
                    );
                }
            }
            break;

        default:
            # code...
            break;
    }
});
