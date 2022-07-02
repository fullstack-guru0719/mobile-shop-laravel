<nav class="navbar navbar-expand-xl navbar-light shadow-sm bg-light fixed-top padtb15">
    <div class="container justify-content-start">
        <button class="navbar-toggler navbar-toggler-right " style="border: none;border-right: 1px solid #ccc;border-radius: 0;" type="button" data-toggle="collapse" data-target="#navbar4">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand d-flex align-items-center ml-1 ml-s-0" href="{{ url('/') }}">
            <img src="{{ url('assets/images/logo.png') }}" class="d-inline-block align-top " />
        </a>
        <div class="d-flex d-xl-none flex-fill justify-content-end align-self-stretch">
            <div style="border-right: 1px solid #ccc;display:flex;align-items: center;" id="cart-counter" class="cart-counter" class="d-flex align-items-center" >
                <a href="{{ url('cart') }}" style="text-decoration: none; color: #000" class="">
                    <i class="fas fa-shopping-cart fa-fw"></i> <span></span><span class="ml-2"></span>
                </a>
            </div>
            <div class="mx-2 d-flex align-items-center">
                <a href="{{ url('customer/dashboard') }}" target="_self" class="text-black" >
                    <i class="far fa-user" style="font-size:24px"></i>  
                </a>
            </div>
        </div>

        <div class="collapse navbar-collapse" id="navbar4">
            <ul class="navbar-nav mr-auto pl-lg-4">
                <li class="nav-item px-lg-2  sell-btn" >
                    <a href="{{ url('/') }}" aria-current="page" class="{{ navactive('/') }}" target="_self">Sell</a>
                </li>
                <li class="nav-item px-lg-2  shop-btn">
                    <a href="https://buy.tronicspay.com" class="nav-link" target="_self">Shop</a>
                </li>

                <li class="nav-item px-lg-2 d-block d-xl-none reg-btn">
                    <a href="{{ url('customer/auth/login') }}" class="nav-link" target="_self">Register / Sign In</a>
                </li>
                <li class="nav-item px-lg-2 help-btn">
                    <a href="https://tronicspay.com/how-it-works" class="{{ navactive('how-it-works') }}" target="_self">How it works</a>
                </li>
                <li class="nav-item px-lg-2 help-btn">
                    <a href="https://support.tronicspay.com" class="{{ navactive('support') }}" target="_blank">Help</a>
                </li>

            </ul>
            <ul class="navbar-nav ml-auto mt-3 mt-lg-0 d-none d-xl-flex">
                <li class="nav-item">
                    <form class="form-inline">

                        <a href="{{ url('cart') }}" style="text-decoration: none; color: #000" class="mr-3">
                            <div style="margin-left: 20px" id="cart-counter" class="cart-counter">
                                <i class="fas fa-shopping-cart fa-fw"></i> <span></span><span class="ml-3 mr-2">Cart</span>
                            </div>
                        </a>
                        @if(isset($isValidAuthentication))
                        @if(isset($isValidAuthentication) && $isValidAuthentication == false)
                        <div class="d-lg-flex pl-2"  style="border-left: 1px solid #ccc;">
                            <div class="ml-2 mr-3 d-flex align-items-center">
                                <i class="far fa-user" style="font-size:24px"></i>  
                            </div>
                            <div class="d-none d-lg-flex flex-column align-items-start">
                                <a href="{{ url('/customer/dashboard') }}" target="_self" class="btn btn-sm p-0 border-0" style="font-size: 15px;font-weight: bold;line-height:20px">My Account</a>
                                <div class="d-lg-flex">
                                    <a href="{{ url('customer/auth/login') }}" target="_self" class="btn  btn-sm my-2 my-sm-0 py-0 pl-0 pr-1" style="font-size: 11px;font-weight: bold;border-radius: 0;border:none;border-right: 1px solid rgb(44,44,44);">Sign in</a>
                                    <a href="{{ url('customer/auth/register') }}" target="_self" class="btn  btn-sm my-2 my-sm-0 py-0 pl-1 pr-0 border-0" style="font-size: 11px;font-weight: bold;">Register</a>
                                </div>
                            </div>
                        </div>
                        @elseif(isset($isValidAuthentication) && $isValidAuthentication == true)
                        <a href="{{ url('customer/dashboard') }}" target="_self" class="btn btn-warning btn-md my-2 my-sm-0">Back to Dashboard</a>
                        @endif
                        @endif
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
