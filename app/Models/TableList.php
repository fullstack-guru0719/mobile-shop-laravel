<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tablelist extends Model
{

    public $credentials_easypost = [
        'easypost_apikey' => 'EZAKcbb80e8d2b574b219ce3c2e1b8e7fff8JK7InBsXweHd3J84ZFYJUg'
    ];

    public $credentials_easypost_test = [
        'easypost_apikey' => 'EZTKe79ac23e1a734b99b4bbf7bcd51a029e0w9CV5oFxE7dlVRg3kOlEg'
    ];

    public $credentials_trust_pilot = [
        'username' => 'info@tronicspay.com',
        'password' => 'Soccer01?'
    ];

    public $recaptcha_test_local = [
        'site_key' => '6LdL88gaAAAAADz37QBeHlxzoqGdDKaVaBkVOiBO',
        'secret_key' => '6LdL88gaAAAAAPEuyF5k8qLRzu4XH9pA7g9nQI2D'
    ];
    public $recaptcha_live_server = [
        'site_key' => '6Lfvv8caAAAAANVRvZfd0HSbj1dC3ZWS3qYj4JSK',
        'secret_key' => '6Lfvv8caAAAAAF7BL1Cd6SEjn1KpYXb0gxN1T7HQ'
    ];
    public $recaptcha_test_server = [
        'site_key' => '6Le2wMcaAAAAAIo15PAwm4B3zvNn4pCdXxyffSdV',
        'secret_key' => '6Le2wMcaAAAAAGHUtmMuYKJGlplS9iShGypgKJmQ'
    ];


    public $plivo_credentials = [
        'url' => 'https://console.plivo.com/dashboard/',
        'auth_id' => 'MAMTDJN2Q2Y2Q3NJY5MJ',
        'auth_token' => 'ZGM5YzUzNTZlODJmNjkyNDIxNDRjYjQ1NDAwMjhk',
        'username' => 'glenn@saperemarketing.com',
        'password' => 'P@utangnaman123'
    ];

    public $plivo_client_credentials = [
        'username' => 'plivo@tronicspay.com',
        'password' => 'Soccer01?!',
        'auth_id' => 'MAZGNINDJJNMQYMTK2NG',
        'auth_token' => 'NzUzYWUyZWNkM2NjYmU2NGMwZmMyZmRhZWNiMTJm',
        'sender' => '+17077230437'
    ];

    public $twilio_sms_credential = [
        'link' => 'https://www.twilio.com/console/gate',
        'console' => 'https://console.twilio.com/',

        // Live Credentials
        'account_sid' => 'ACa5ed127d286333774ba46e6978b0f80c',
        'auth_token' => '6db62097c6989d42443f3ab69cc06dd4',
        // Test Credentials
        // 'account_sid' => 'AC18d4ce298105e3dab731421c1dbac077',
        // 'auth_token' => '6114c3371c24a5431ad0fba7aca1ca72', 

        'twilio_phone_number' => '(334) 721-0661',
        'phone_number' => '13347210661',
        'username' => 'aen00100@gmail.com',
        'password' => 'P@utangnaman123'
    ];

    public $messagebird_sandbox_credential = [
        'signing_key' => '1o1IAEmdpWievkvgAwbul3T06MELy9xA',
        'api_token_key' => 'HfIDBYwzbzKvk8obYtMkkKoWo',
        'workspace_id' => '8849752'
    ];


    public $placeholder_customer_list = [
        [
            'name' => 'Customer Name',
            'style' => 'background: none; border: 0; width: 121px;',
            'id' => 'clipboard_customer_name',
            'value' => '{customer_name}',
        ],
        [
            'name' => 'Email Address',
            'style' => 'background: none; border: 0; width: 132px;',
            'id' => 'clipboard_customer_email',
            'value' => '{customer_email}'
        ],
        [
            'name' => 'Password',
            'style' => 'background: none; border: 0; width: 158px;',
            'id' => 'clipboard_customer_password',
            'value' => '{customer_password}'
        ],
    ];

    public $placeholder_order_list = [
        [
            'name' => 'Shipping Label',
            'style' => 'background: none; border: 0;',
            'id' => 'clipboard_order_shipping_label',
            'value' => '{order_shipping_label}',
        ],
        [
            'name' => 'Tracking #',
            'style' => 'background: none; border: 0; width: 183px;',
            'id' => 'clipboard_order_tracking_number',
            'value' => '{order_tracking_number}'
        ],
        [
            'name' => 'Transaction ID',
            'style' => 'background: none; border: 0; width: 158px;',
            'id' => 'clipboard_order_transaction_id',
            'value' => '{order_transaction_id}'
        ],
        [
            'name' => 'Status',
            'style' => 'background: none; border: 0; width: 205px;',
            'id' => 'clipboard_order_status',
            'value' => '{order_status}'
        ],
    ];


    public $paypal_admin = [
        'sandbox_account' => 'sb-jcj7x5459425@business.example.com',
        'client_id' => 'ATchzVJN5IS1NvWOCkOwXTIj58wFXPqCT1GVHh1yRmE1NSrKREdIO4UcBMWzCSGav-Hmry9e-twxcE6q',
        'secret' => 'EO6wqntzqUb5aajIv1l4xNWmJ0p5ZLbLrJJB9E3clGjfbJUEL485ks9f_g2vQjk4VYInnO5e7sJSMfQJ'
    ];

    // Sandbox credentials
    public $paypal_account = [
        'paypal_account_client_id' => 'ATchzVJN5IS1NvWOCkOwXTIj58wFXPqCT1GVHh1yRmE1NSrKREdIO4UcBMWzCSGav-Hmry9e-twxcE6q',
        'paypal_account_username' => 'sb-g47lww5767188@personal.example.com',
        'paypal_account_password' => 'qF_7uZ0#'
    ];

    public $aws_account = [
        'Account ID' => '144507505489',
        'URL' => 'https://144507505489.signin.aws.amazon.com/console',
        'User name' => 'glennabalos',
        'Password' => '_Mjm=&AyrK&N,NWP,*SP'
    ];

    public $badge = [
        'label-sucess', 'label-info', 'label-primary', 'label-warning', 'label-danger'
    ];

    public $device_type = [
        1 => 'Excellent', 2 => 'Good', 3 => 'Fair', 4 => 'Broken'
    ];

    public $array_meta_tags = [
        'title',
        'description',
        'keywords',
        'og:type',
        'og:url',
        'og:title',
        'og:description',
        'og:image',
        'twitter:url',
        'twitter:title',
        'twitter:description',
        'twitter:image'
    ];

    public $email_support = ['email' => 'support@lawsheroes.com', 'password' => 'rpg46jWa@tL('];

    public $networkList = ['AT&T' => 'AT&T', 'Sprint' => 'Sprint', 'T-Mobile' => 'T-Mobile', 'Verizon' => 'Verizon', 'Unlocked' => 'Unlocked', 'Others' => 'Others'];

    public $storageList = ['' => '--', '32GB' => '32GB', '64GB' => '64GB', '128GB' => '128GB', '256GB' => '256GB', '512GB' => '512GB'];

    public $payment_list = [
        '' => '--',
        'Apple Pay' => 'Apple Pay',
        'Google Pay' => 'Google Pay',
        'Venmo' => 'Venmo',
        'Cash App' => 'Cash App',
        'Paypal' => 'Paypal',
        'Bank Transfer' => 'Bank Transfer'
    ];


    public $smtp = [
        'MAIL_MAILER' => 'smtp',
        'MAIL_HOST' => 'smtp.mailtrap.io',
        'MAIL_PORT' => '2525',
        'MAIL_USERNAME' => '399502d79e0d03',
        'MAIL_PASSWORD' => 'c228e80f9f498e',
        'MAIL_ENCRYPTION' => 'tls',
        'MAIL_FROM_ADDRESS' => 'aen00100@gmail.com',
        'MAIL_FROM_NAME' => 'TronicsPay',
    ];

    public $smtp_live = [
        'MAIL_MAILER' => 'smtp',
        'MAIL_HOST' => 'smtp.mailtrap.io',
        'MAIL_PORT' => '2525',
        'MAIL_USERNAME' => 'tronicspay@gmail.com',
        'MAIL_PASSWORD' => 'Soccer01??',
        'MAIL_ENCRYPTION' => 'tls',
        'MAIL_FROM_ADDRESS' => 'tronicspay@gmail.com',
        'MAIL_FROM_NAME' => 'TronicsPay',
    ];


    /**************************************************************/
    /** 		https://restfulapi.net/http-status-codes/		**/
    /**************************************************************/

    protected $api_response = [
        '200' => 'OK',
        '201' => 'Created',
        '202' => 'Accepted',
        '204' => 'No content',
        '301' => 'Moved Permanently',
        '302' => 'Found',
        '303' => 'See Others',
        '304' => 'Not Modified',
        '307' => 'Temporary Redirect',
        '400' => 'Bad Request',
        '401' => 'Unauthorized',
        '403' => 'Forbidden',
        '404' => 'Not Found',
        '405' => 'Method Not Allowed',
        '406' => 'Not Acceptable',
        '412' => 'Precondition Failed',
        '415' => 'Unsupported Media Type',
        '500' => 'Internal Server Error',
        '501' => 'Not Implemented'
    ];

    protected $custom_api_response = [
        '1001' => 'Email Exists',
        '1002' => 'Value too long',
        '1003' => 'Value too short',
        '1004' => 'string only',
        '1005' => 'Email not registered',
        '1006' => 'Password and password confirmation did not match',
        '1007' => 'Incorrect Password',
        '1008' => 'Incorrect file format',
        '1009' => 'Account suspended',
        '1010' => 'Record In-Used',
        '2001' => 'Email Address is required',
        '2002' => 'Mobile no. is required',
        '2003' => 'Password is required',
        '3001' => 'Successfully registered',
        '3001' => 'Successfully registered',
        '3100' => 'Profile has been successfully updated',
        '3101' => 'Profile avatar changed',
        '3102' => 'Profile password changed',
        '4000' => 'Added',
        '4001' => 'Updated',
        '4002' => 'Deleted',
        '5000' => 'Payment Success',
        '5001' => 'Payment Canceled',
        '5002' => 'Payment Rejected'
    ];

    public $valid_file_extensions = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png'];

    public $store_details = ['store_id' => '20018', 'auth_key' => 'TXpKG#6zkdB~2zTK'];


    public $inquiry_status = [
        0 => 'Open',
        1 => 'Assigned',
        2 => 'Assigned to others',
        3 => 'Unpaid',
        4 => 'Paid',
    ];

    public $fcm_api_accesskey = 'AAAAUKR6L4M:APA91bGwwSuo_8hsrdfAT5Zatg95fpLevgFZrJQvJoqTZSFfs6dFP6m7uljuG283h5B-2UWYH2d94PbiLuLdb0P8KabJP17IuIZ38SqkF1Pm8pHzvWZ30WEYRjMmGnLZSWZBOGpOiE2U';

    public $modulesList = [
        "Brand", "Config", "Customer", "Dashboard", "Email Template", "Menu", "Order", "Page", "Product", "Sorting", "Status", "User"
    ];

    public $notificationModules = [
        'Process order and registration',
        'Process order with existing account',
        'Reminder'
    ];

    public $enableOption = ["Disable", "Enable"];

    public $modules = [
        "dashboard" => ["id" => 1, "name" => "Dashboard", "icon" => "nav-icon fas fa-tachometer-alt", "modal" => ""],
        "order" => ["id" => 2, "name" => "Orders", "icon" => "nav-icon fas fa-people-carry", "modal" => ""],
        "customer" => ["id" => 2, "name" => "Customers", "icon" => "nav-icon fas fa-users", "modal" => ""],
        "page" => ["id" => 3, "name" => "Pages", "icon" => "nav-icon fas fa-file", "modal" => "modal-show-advice"],
        "product" => ["id" => 4, "name" => "Products", "icon" => "nav-icon fas fa-shopping-basket", "modal" => ""],
        "user" => ["id" => 5, "name" => "Users", "icon" => "nav-icon fas fa-uds", "modal" => ""],
        "config" => ["id" => 6, "name" => "Configuration", "icon" => "far fa-circle nav-icon", "modal" => ""],
        "menu" => ["id" => 7, "name" => "Menu Manager", "icon" => "far fa-circle nav-icon", "modal" => ""],
        "brand" => ["id" => 8, "name" => "Brands Manager", "icon" => "far fa-circle nav-icon", "modal" => ""],
        "status" => ["id" => 9, "name" => "Status Manager", "icon" => "far fa-circle nav-icon", "modal" => ""],
        "status" => ["id" => 10, "name" => "Products Order", "icon" => "far fa-sort-alpha-down nav-icon", "modal" => ""]
    ];
}
