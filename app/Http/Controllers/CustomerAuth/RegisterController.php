<?php

namespace App\Http\Controllers\CustomerAuth;

use Laravel\Socialite\Facades\Socialite;

use App\Models\Customer;
use App\Models\TableList;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Saperemarketing\SCart\Facades\Cart;
use App\Models\Customer\CustomerAddress;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\Customer\CreateCustomerRequest;
use App\Repositories\Customer\StateRepositoryEloquent as State;
use App\Repositories\Customer\CustomerRepositoryEloquent as CustomerRepo;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected $tablelist;
    protected $stateRepo;
    protected $customerRepo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TableList $tablelist, State $stateRepo, CustomerRepo $customerRepo)
    {
        $this->tablelist = $tablelist;
        $this->stateRepo = $stateRepo;
        $this->customerRepo = $customerRepo;
        $this->middleware('guest:customer');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'street' => ['required'],
            'city' => ['required'],
            'state' => ['required'],
            'zip' => ['required'],
            'phone' => ['required']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    private function getCaptcha($SecretKey)
    {
        $recaptcha = $this->tablelist->recaptcha_test_local;
        $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $recaptcha['secret_key'] . "&response={$SecretKey}");
        $Return = json_decode($Response);
        return $Return;
    }


    protected function create(CreateCustomerRequest $request)
    {
        $response = Http::asForm()->post("https://www.google.com/recaptcha/api/siteverify", [
            "secret"    => env("RECAPTCHA_SECRET_KEY"),
            "response"  => $request->get('g-recaptcha-response'),
        ]);
        $response = json_decode($response->body());
        if ($response->success) {
            // if (true) { /// ttt
            if ($this->CheckExistingEmail($request['email']) == false) {
                return redirect('customer/auth/register')->with('error', 'Email Address has been already used!');
            }
            $password = Str::random(10);
            $customer = Customer::create([
                'fname' => $request['first_name'],
                'lname' => $request['last_name'],
                'email' => $request['email'],
                'username' => '',
                'password' => Hash::make($request->get('password')),
                'authpw' => "",
                'verification_code' => app('App\Http\Controllers\GlobalFunctionController')->verificationCode(),
                'status' => 'inactive'
            ]);

            CustomerAddress::create([
                'customer_id' => $customer->id,
                'address1' => $request['address1'],
                'address2' => $request['address2'],
                'city' => $request['city'],
                'state' => $request['state'],
                'zip' => $request['zip'],
                'phone' => $request['phone']
            ]);

            Auth::guard('customer')->login($customer);
            if (!Auth::guard('customer')->check()) {
                return redirect()->to('customer/auth/login');
            }
            if ($request['cart']) {
                return redirect()->to('products/checkout');
            }
            return redirect()->to('customer/dashboard');
        } else {
            return redirect('customer/auth/register')->with('error', "I'm sorry, but there was an issue with your registration");
        }
    }

    public function showRegistrationForm()
    {
        $data['recaptcha'] = $this->tablelist->recaptcha_test_server;
        $data['stateList'] = $this->stateRepo->selectlist('name', 'abbr');
        $data['cartcount'] = Cart::count();
        return view('customer.register', $data);
    }

    public function showGoogleRegistrationForm()
    {
        $data['stateList'] = $this->stateRepo->selectlist('name', 'abbr');
        $data['cartcount'] = Cart::count();
        return view('customer.register_google', $data);
    }

    public function showFacebookRegistrationForm()
    {
        $data['stateList'] = $this->stateRepo->selectlist('name', 'abbr');
        $data['cartcount'] = Cart::count();
        return view('customer.register_facebook', $data);
    }

    private function CheckExistingEmail($email)
    {
        $checker = $this->customerRepo->rawByWithField(['bill'], 'email = ?', [$email]);
        if ($checker) {
            return false;
        } else {
            return true;
        }
    }

    public function redirectToGoogle(Request $request)
    {
        if (
            $this->validateAddressData($request)
        ) {
            return;
        }
        $this->sessionStoreAddressData($request);

        return Socialite::driver('google')
            ->redirect();
    }

    public function redirectToFacebook(Request $request)
    {
        if (
            $this->validateAddressData($request)
        ) {
            return;
        }
        $this->sessionStoreAddressData($request);

        return Socialite::driver('facebook')
            ->redirect();
    }

    public function returnFromGoogle(Request $request)
    {
        $user = Socialite::driver('google')->stateless()->user();

        if (!$user) return;

        if ($this->CheckExistingEmail($user->email) == false) {

            if ($request['cart']) {
                // TODO ttt
                return redirect()->back();
            }

            $customer = Customer::where('email', $user->email)->first();

            if ($customer->provider !== 'google') {
                return redirect('customer/auth/register-google')->with('error', 'Email Address has been already used!');
            }

            Auth::guard('customer')->login($customer);
            return redirect()->to('customer/dashboard');
        }

        $customer = $this->createOAuthCustomer($request, $user, 'google');

        Auth::guard('customer')->login($customer);
        if (!Auth::guard('customer')->check()) {
            return redirect()->to('customer/auth/login');
        }
        if ($request['cart']) {
            // TODO ttt
            return redirect()->to('products/checkout');
        }
        return redirect()->to('customer/dashboard');
    }

    public function returnFromFacebook(Request $request)
    {
        $user = Socialite::driver('facebook')->stateless()->user();

        if (!$user) return;

        if ($this->CheckExistingEmail($user->email) == false) {

            if ($request['cart']) {
                // TODO ttt
                return redirect()->back();
            }

            $customer = Customer::where('email', $user->email)->first();

            if ($customer->provider !== 'facebook') {
                return redirect('customer/auth/register-facebook')->with('error', 'Email Address has been already used!');
            }

            Auth::guard('customer')->login($customer);
            return redirect()->to('customer/dashboard');
        }

        $customer = $this->createOAuthCustomer($request, $user, 'facebook');

        Auth::guard('customer')->login($customer);
        if (!Auth::guard('customer')->check()) {
            return redirect()->to('customer/auth/login');
        }
        if ($request['cart']) {
            // TODO ttt
            return redirect()->to('products/checkout');
        }
        return redirect()->to('customer/dashboard');
    }


    private function validateAddressData(Request $request)
    {
        if (
            !is_string($request['address1']) ||
            !is_string($request['address2']) ||
            !is_string($request['city']) ||
            !is_string($request['state']) ||
            !is_string($request['zip']) ||
            !is_string($request['phone'])
        ) {
            return false;
        }

        return true;
    }

    private function sessionStoreAddressData(Request $request)
    {

        $request->session()->put('address1', $request['address1']);
        $request->session()->put('address2', $request['address2']);
        $request->session()->put('city', $request['city']);
        $request->session()->put('state', $request['state']);
        $request->session()->put('zip', $request['zip']);
        $request->session()->put('phone', $request['phone']);
    }

    private function createOAuthCustomer(Request $request, $user, $provider)
    {


        $fname = "";
        $lname = "";

        if ($provider === "google") {
            $fname = $user->user['given_name'];
            $lname = $user->user['family_name'];
        } else {
            $parts = explode(" ", $user['name']);
            if (count($parts) === 1) {
                $fname = $parts[0];
                $lname = $parts[0];
            } else {
                $fname = implode(" ", array_slice($parts, 0, -1));
                $lname = array_slice($parts, -1)[0];
            }
            // die(($fname . $lname));
        }

        $customer = Customer::create([
            'fname' => $fname,
            'lname' => $lname,
            'email' => $user->email,
            'username' => '',
            'authpw' => "",
            'verification_code' => app('App\Http\Controllers\GlobalFunctionController')->verificationCode(),
            'status' => 'inactive',
            'provider' => $provider,
        ]);

        CustomerAddress::create([
            'customer_id' => $customer->id,
            'address1' => $request->session()->get('address1'),
            'address2' => $request->session()->get('address2'),
            'city' => $request->session()->get('city'),
            'state' => $request->session()->get('state'),
            'zip' => $request->session()->get('zip'),
            'phone' => $request->session()->get('phone'),
        ]);


        $request->session()->forget('address1', $request['address1']);
        $request->session()->forget('address2', $request['address2']);
        $request->session()->forget('city', $request['city']);
        $request->session()->forget('state', $request['state']);
        $request->session()->forget('zip', $request['zip']);
        $request->session()->forget('phone', $request['phone']);

        return $customer;
    }
}
