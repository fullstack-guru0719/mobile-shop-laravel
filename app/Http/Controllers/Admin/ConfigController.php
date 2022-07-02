<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Admin\ConfigRepositoryEloquent as Config;
use App\Repositories\Customer\StateRepositoryEloquent as State;
use App\Models\TableList;

require __DIR__ . '/../../../../vendor/autoload.php';

use Twilio\Rest\Client;

class ConfigController extends Controller
{
    protected $configRepo;
    protected $stateRepo;
    protected $tablelist;

    function __construct(Config $configRepo, State $stateRepo, TableList $tablelist)
    {
        $this->configRepo = $configRepo;
        $this->stateRepo = $stateRepo;
        $this->tablelist = $tablelist;
    }

    public function index()
    {
        $data['config'] = $this->configRepo->find(1);
        $data['tvsettings'] = true;
        $data['stateList'] = $this->stateRepo->selectlist('name', 'abbr');
        $data['module'] = 'config';
        $data['is_dark_mode'] = ($data['config']['is_dark_mode'] == 1) ? true : false;


        $client = new Client(config('services.twilio.sid'), config('services.twilio.auth_token'));

        $response = $client->balance->fetch();

        $data['sms_remaining_credit'] = ($response->balance > 0)
            ? '<b class="text-green">$' . $response->balance . '</b>'
            : '<b class="text-red">$' . $response->balance . '</b>';

        return view('admin.settings.config.index', $data);
    }

    public function update(Request $request, $id)
    {
        $makeRequest = [
            'company_name' => $request['company_name'],
            'company_email' => $request['company_email'],
            'address1' => $request['address1'],
            'address2' => $request['address2'],
            'city' => $request['city'],
            'state' => $request['state'],
            'zip_code' => $request['zip_code'],
            'phone' => $request['phone'],
            'company_schedule' => $request['company_schedule'],
            'good' => $request['good'],
            'fair' => $request['fair'],
            'poor' => $request['poor'],
            'is_dark_mode' => $request['is_dark_mode'],
            'is_sms_feature_active' => $request['is_sms_feature_active'],
            'insurance_fee' => $request['insurance_fee'],
            'notify_device_by_last_updated_date' => $request['notify_device_by_last_updated_date']
        ];

        $this->configRepo->update($makeRequest, $id);
        return redirect()->back();
    }
}
