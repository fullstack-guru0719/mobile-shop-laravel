@extends('layouts.front')
@section('content')


<section class="">
    <section class="hero">
        <div class="container">
            <div class="text-center pt-50 hero-top">
                <h1 class="hero-header my-5">Send In Your Mobile Device &amp; Get Paid.</h1>
                <div class="search-input mt-5 input-group">
                    <input type="text" name="productname" id="search-input" placeholder="Search for your device..." class="form-control" autocomplete="off" />
                    <div class="input-group-append">
                        <button class="btn btn-warning" type="button" id="button-addon2" >Search</button>
                        <!-- <button class="btn btn-warning" type="button" id="button-addon2" onclick="event.stopPropagation();document.querySelector('#search-result-list').focus();document.querySelector('#search-result-container').classList.remove('d-none');">Search</button> -->
                    </div>
                </div>
                <div id="s-r-parent" style="position: relative;margin: 0 auto;">

                    <div class="search d-none" id="search-result-container" style="width: 100%;">
                        <div class="lds-ring" id="search-loader">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                        <ul id="search-result-list" class="d-none">
                        </ul>
                    </div>
                    {{-- <form action="{{ url('products') }}" method="POST" autocomplete="off">
                    @csrf
                    <input type="text" name="productname" placeholder="Search for your device..." class="form-control" />
                    <br />
                    <button type="submit" class="btn btn-warning btn-md hvr-shrink">Search</button>
                    </form> --}}
                </div>
            </div>
            <div class="row mt-50 mt-5">
                @if(isset($rowone))
                @foreach($rowone as $row)
                <div class="col-lg-2 col-md-4 col-6 device-link">
                    <a href="{{ url('products/category', $row->name) }}" class="hvr-shrink">
                        <img src="{{ url($row->photo) }}" class="img-fluid" style="height: 150px !important;object-fit:contain;" />
                        <h4 class="device-name">{{ $row->name }}</h4>
                    </a>
                </div>
                @endforeach
                @endif
            </div>
            <div class="row mt-50">
                <div class="col-lg-1"></div>
                @if(isset($rowtwo))
                @foreach($rowtwo as $row)
                <div class="col-lg-2 col-md-4 col-6 device-link mb-2">
                    <a href="{{ url('products/category', $row->name) }}" class="hvr-shrink">
                        <img src="{{ url($row->photo) }}" class="img-fluid" style="height: 150px !important;object-fit:contain;" />
                        <h4 class="device-name">{{ $row->name }}</h4>
                    </a>
                </div>
                @endforeach
                @endif
                <div class="col-lg-1"></div>
            </div>
            <div class="row mb-1 mt-5">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h1 class="hero-header ">Other Devices</h1>
                    </div>
                </div>
            </div>
            {{-- <div class="row pb-50">
                    @if(isset($rowtri))
                        @foreach($rowtri as $row)
                        <div class="col-lg-2 col-md-4 col-6 device-link" style="align-items: center; display: flex;">
                            <a href="{{ url('products/category', $row->name) }}" class="hvr-shrink">
            <img src="{{ url($row->photo) }}" class="img-fluid" style="height: 150px !important;object-fit:contain;" />
            <h4 class="device-name">{{ $row->name }}</h4>
            </a>
        </div>
        @endforeach
        @endif
        </div> --}}
        <div class="row">
            <!-- <div class="d-flex flex-row flex-wrap justify-content-center"> -->
            <div class="col-lg-1"></div>
            @foreach($rowtri as $other_device)
            <div class="device-link col-lg-2 col-md-4 col-6 mb-2">
                <!-- <div class="device-link" style="width: 15rem;"> -->
                <a href="{{ url('products/category', $other_device->name) }}" class="hvr-shrink">
                    <img src="{{ url($other_device->photo) }}" alt="other_device_product_image" style="height: 150px !important; width: 150px !important;object-fit:contain;">
                    <h4 class="device-name">{{ $other_device->name }}</h4>
                </a>
            </div>
            @endforeach
            <div class="col-lg-1"></div>
        </div>
        @if(isset($rowqua))
        <div class="row mt-5 mb-1 ">
            <div class="col-lg-12">
                <div class="text-center">
                    <h1 class="hero-header">Gaming</h1>
                </div>
            </div>
        </div>
        <div class="row pb-50 justify-content-center">
            <div class="col-lg-1"></div>
            @foreach($rowqua as $gaming_device)
            <div class="device-link col-lg-2 col-md-4 col-6 mb-2">
                <a href="{{ url('products/category', $gaming_device->name) }}" class="hvr-shrink">
                    <img src="{{ url($gaming_device->photo) }}" alt="gaming_device_product_image" style="height: 150px !important; width: 150px !important;object-fit:contain;">
                    <h4 class="device-name">{{ $gaming_device->name }}</h4>
                </a>
            </div>
            @endforeach
            <div class="col-lg-1"></div>
        </div>
        @endif

        <div class="row mt-5 pb-50">
            <div class="col-lg-12">
                <div class="text-center">
                    <h2 class="text-white">Choose How You Wish to be Paid</h2>
                    <h5 style="color: #7c7c7c; font-weight:normal">We cater to a vast amount of payment provider</h5>
                </div>
            </div>
        </div>
        <div class="row pb-50">
            <div class="col-md-12">
                <div class="text-center">
                    <img src="{{ url('assets/images/payments/payment-services.png') }}" class="img-fluid">
                </div>
            </div>
        </div>
        </div>
    </section>
    <section class="section-grey">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 col-md-6 parallax-1 d-none d-sm-block" id="iviglp"></div>
                <div class="col-lg-4 col-md-6 right-content">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title ct-tronics">SELLING YOUR PHONE.</h5>
                            <hr />
                            <h4 class="sh-tronics">How It Works</h4>
                            <p class="card-text content-p pb-30">
                                <strong>Step 1 - Get an Instant Offer.</strong> Tell us a little bit about your phone and we’ll make an offer right away! We have a highest price guarantee &amp; there are no obligations.
                            </p>
                            <p class="card-text content-p pb-30">
                                <strong>Step 2 - Ship Your Phone.</strong> Shipping is 100% free. We’ll send you a prepaid shipping label via email. Simply print the label and place it on a box or padded envelope.
                            </p>
                            <p class="card-text content-p pb-30">
                                <strong>Step 3 - Get Paid.</strong> Once we receive your order, it’s time for you to cash in! Tronics Pay offers the highest payouts, 30-day price locks, and speedy payments.
                            </p>
                            <p class="card-text content-p">
                                <strong>Speedy Payment Options.</strong> Choose the payment method that works best for you. We can send you a check in the mail or send your payment directly to your PayPal account.
                            </p>
                            <div class="more-details">
                                <a href="{{ url('how-it-works') }}" class="hvr-shrink">More Details
                                    <i class="fas fa-long-arrow-alt-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-grey">
        <div class="container-fluid">
            <!-- <div class="container-fluid parallax-2"> -->
            <div class="row" style="padding: 50px 0px;">
                <div class="col-lg-4">
                    <div class="card mb-4 shadow-sm h-100">
                        <div class="card-body">
                            <div data-aos="fade-right" data-aos-duration="500" class="card-step">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <img src="library/images/quote-img.png" class="card-step1-logo">
                                        </div>
                                        <div class="form-group mb-0">
                                            <div class="card-step-header">Quote Your Device</div>
                                            <div class="text-gray-1">
                                                Find your device and checkout on our site to lock in your 30-day quote.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-4 shadow-sm h-100">
                        <div class="card-body">
                            <div data-aos="fade-right" data-aos-duration="1500" class="card-step">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <img src="library/images/ship-img.png" class="card-step2-logo">
                                        </div>
                                        <div class="form-group mb-0">
                                            <div class="card-step-header">Mail Your Item</div>
                                            <div class="text-gray-1">
                                                We email a pre-paid USPS label. Use any box and ship from your local post office!
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-4 shadow-sm h-100">
                        <div class="card-body">
                            <div data-aos="fade-right" data-aos-duration="2000" class="card-step">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <img src="library/images/get-paid-img.png" class="card-step3-logo">
                                        </div>
                                        <div class="form-group mb-0">
                                            <div class="card-step-header">Get Paid Fast!</div>
                                            <div class="text-gray-1">
                                                Choose PayPal or check and get paid in as little as 3 days!
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-grey">

        <div class="container">
            <div class="text-center hero-header pt-50 form-group">
                <h1 class="text-black">What Others Have To Say About Us...</h1>
            </div>
        </div>
        <div class="container-fluid p-0">
            <div class="row bg-white  m-2 m-md-0">
                <!-- <div class="col d-flex bg-white"> -->
                    <div class="col-12 col-md-6 col-xl-3">
                    <!-- <div class="w-50 w-xl-25" > -->
                        <a href="https://www.trustpilot.com/review/tronicspay.com"  target="_blank"><img   src="https://share.trustpilot.com/images/company-rating?locale=en-US&businessUnitId=5d824c40ccaf3c0001c3029e" class="img-fluid"></a>
                    <!-- </div> -->
                    </div>
                    <div class="col-12 col-md-6 col-xl-9 px-5 " id="slider-container">
                    <!-- <div class="w-50 w-xl-75" id="slider-container"> -->
                        <div id="slider" class="">
                            <div>
                                <img src="assets/images/reviews/2_546.png" alt="" class="w-100">                            
                            </div>
                            <div>
                                <img src="assets/images/reviews/2_546.png" alt="" class="w-100">                            
                            </div>
                            <div>
                                <img src="assets/images/reviews/2_546.png" alt="" class="w-100">                            
                            </div>
                            <div>
                                <img src="assets/images/reviews/2_546.png" alt="" class="w-100">                            
                            </div>
                            <div>
                                <img src="assets/images/reviews/2_546.png" alt="" class="w-100">                            
                            </div>
                            <div>
                                <img src="assets/images/reviews/2_546.png" alt="" class="w-100">                            
                            </div>
                            
                        <!-- </div> -->
                        </div>
                    </div>
            
                
                <!-- </div> -->
            </div>
        </div>

        <div class="container pb-50">
            <div class="text-center hero-header pt-50 form-group">
                <!-- <h1 class="text-black">What Others Have To Say About Us...</h1> -->
                <!-- <div class="row bg-white  m-2 m-md-0">
                        <div class="col-12 col-md-6 col-xl-3">
                            <a href="https://www.trustpilot.com/review/tronicspay.com"  target="_blank"><img   src="https://share.trustpilot.com/images/company-rating?locale=en-US&businessUnitId=5d824c40ccaf3c0001c3029e" class="img-fluid"></a>
                        </div>
                        <div class="col-12 col-md-6 col-xl-9" id="slider-container">
                            <div id="slider" class="">
                                <div>
                                    <img src="assets/images/reviews/2_546.png" alt="" class="w-100">                            
                                </div>
                                <div>
                                    <img src="assets/images/reviews/2_546.png" alt="" class="w-100">                            
                                </div>
                                <div>
                                    <img src="assets/images/reviews/2_546.png" alt="" class="w-100">                            
                                </div>
                                <div>
                                    <img src="assets/images/reviews/2_546.png" alt="" class="w-100">                            
                                </div>
                                <div>
                                    <img src="assets/images/reviews/2_546.png" alt="" class="w-100">                            
                                </div>
                                <div>
                                    <img src="assets/images/reviews/2_546.png" alt="" class="w-100">                            
                                </div>
                                
                            </div>
                        </div>

                    
                </div> -->
                <div class="row mt-5">
                    <div class="col-md-12 form-group">
                    <!-- <div class="col-md-6 form-group"> -->
                        <div data-token="lj6Va39nDtC6vl9e0eurxMZ2SFK7tUBgDYYxuplFXijsC25OZU" class="romw-badge"></div>
                        <script src="https://reviewsonmywebsite.com/js/embedLoader.js?id=16985fd9e429040ba7c6" type="text/javascript"></script>
                    </div>
                    <!-- <div class="col-md-6 form-group">
                        <a href="https://www.trustpilot.com/review/tronicspay.com" target="_blank"><img height="300" width="280" src="https://share.trustpilot.com/images/company-rating?locale=en-US&businessUnitId=5d824c40ccaf3c0001c3029e" class="img-fluid"></a>
                        <div id="review-container"></div>
                    </div> -->
                </div>
            </div>
            <!-- <div class="row">
                <div class="col-lg-6">
                    <img src="assets/images/reviews/2.png" class="img-fluid d-block m-auto" sizes="(max-width: 500px) 350px,
                        (max-width: 1400px) 546px,
                        636px" srcset="assets/images/reviews/2_636.png 636w,
                            assets/images/reviews/2_546.png 546w,
                            assets/images/reviews/2_350.png 350w" />
                </div>
                <div class="col-lg-6">
                    <img src="assets/images/reviews/3.png" class="img-fluid d-block m-auto" sizes="(max-width: 500px) 350px,
                        (max-width: 1400px) 546px,
                        636px" srcset="assets/images/reviews/3_636.png 636w,
                            assets/images/reviews/3_546.png 546w,
                            assets/images/reviews/3_350.png 350w" />
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <img src="assets/images/reviews/4.png" class="img-fluid d-block m-auto" sizes="(max-width: 500px) 350px,
                        (max-width: 1400px) 546px,
                        636px" srcset="assets/images/reviews/4_636.png 636w,
                            assets/images/reviews/4_546.png 546w,
                            assets/images/reviews/4_350.png 350w" />
                </div>
                <div class="col-lg-6">
                    <img src="assets/images/reviews/5.png" class="img-fluid d-block m-auto" sizes="(max-width: 500px) 350px,
                        (max-width: 1400px) 546px,
                        636px" srcset="assets/images/reviews/5_636.png 636w,
                            assets/images/reviews/5_546.png 546w,
                            assets/images/reviews/5_350.png 350w" />
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <img src="assets/images/reviews/6.png" class="img-fluid d-block m-auto" sizes="(max-width: 500px) 350px,
                        (max-width: 1400px) 546px,
                        636px" srcset="assets/images/reviews/6_636.png 636w,
                            assets/images/reviews/6_546.png 546w,
                            assets/images/reviews/6_350.png 350w" />
                </div>
                <div class="col-lg-6">
                    <img src="assets/images/reviews/7.png" class="img-fluid d-block m-auto" sizes="(max-width: 500px) 350px,
                        (max-width: 1400px) 546px,
                        636px" srcset="assets/images/reviews/7_636.png 636w,
                            assets/images/reviews/7_546.png 546w,
                            assets/images/reviews/7_350.png 350w" />
                </div>
            </div> -->


            <!-- <div class="row">
                <div class="col-lg-6"><img src="assets/images/reviews/4.png" class="img-fluid" /></div>
                <div class="col-lg-6"><img src="assets/images/reviews/5.png" class="img-fluid" /></div>
            </div>
            <div class="row">
                <div class="col-lg-6"><img src="assets/images/reviews/6.png" class="img-fluid" /></div>
                <div class="col-lg-6"><img src="assets/images/reviews/7.png" class="img-fluid" /></div>
            </div> -->
        </div>
    </section>
    <section class="section-grey">
        <div class="container pb-50">
            <div class="row">
                <div class="col-lg-7" style="background-color: rgb(238, 238, 233); margin-left: auto; margin-right: auto;">
                    <div class="text-center contact-us">
                        <i class="far fa-fw fa-envelope"></i>
                        <h4 class="contact-head">Contact Us</h4>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3097.2195538694464!2d-94.41648289308372!3d39.07869647373669!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x87c0fdf2628895ff%3A0x74b538aa176b05bc!2sTronics%20Pay!5e0!3m2!1sen!2sph!4v1605701145623!5m2!1sen!2sph" width="100%" height="450" frameborder="0" allowfullscreen="allowfullscreen" aria-hidden="false" tabindex="0" id="ij70oa"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-grey">
        <div class="container pb-50">
            <div class="row">
                <div class="col" style="background-color: rgb(255, 255, 255);">
                    <div id="google-reviews"></div>
                </div>

            </div>
        </div>
    </section>
</section>



@endsection
@section('page-css')
<link rel="stylesheet" href="https://tronicspay.com/assets/slick/slick.css">
<link rel="stylesheet" href="https://tronicspay.com/assets/slick/slick-theme.css">
<style>
    @media (min-width: 768px) {
        .p-50-desktop {
            padding: 50px;
        }
    }

    div.search {
        height: 200px;
        width: 435px;
        background-color: white;
        overflow: auto;
        position: absolute;
        z-index: 999;
    }

    div.search>ul {
        list-style: none;
        font-weight: bold;
        text-align: left
    }

    .lds-ring {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
    }

    .lds-ring div {
        box-sizing: border-box;
        display: block;
        position: absolute;
        width: 40px;
        height: 40px;
        margin: 5px;
        border: 5px solid rgb(33, 180, 238);
        border-radius: 50%;
        animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
        border-color: rgb(33, 180, 238) transparent transparent transparent;
    }

    .lds-ring div:nth-child(1) {
        animation-delay: -0.45s;
    }

    .lds-ring div:nth-child(2) {
        animation-delay: -0.3s;
    }

    .lds-ring div:nth-child(3) {
        animation-delay: -0.15s;
    }

    @keyframes lds-ring {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }



    /* Slider */
    .slick-arrow {
        background: gray  !important;
        border-radius: 50px;
        color: white !important;
    }
    .slick-arrow:hover {
        background: gray;
        color: white !important;
    }
    .slick-prev:before {
        font-family: monospace;
        content: '<';
        color: white;
    }
    .slick-next:before {
        font-family: monospace;
        content: '>';
        color: white;
    }
</style>
@endsection
@section('page-js')
<script>
    window.onload = function() {
        const search_result_container = $("#search-result-container");
        const search_loader = $("#search-loader");
        const list_result = $("#search-result-list");
        let data = [];
        let main_url = window.location.origin;
        if (localStorage.getItem('cart-empty')) {
            alert(`Please add some item in your cart first`);
            localStorage.removeItem('cart-empty');
        }


        $("#search-input").on('input', function() {
            if ($(this).val().length > 0) {
                // search_result_container.css("height","50px");
                search_result_container.removeClass('d-none');
            }
            let search = $(this).val();
            if (search) {
                $.ajax(`${main_url}/api/search?search=${search}`, {
                    method: "GET",
                    async: true,
                    success: res => {
                        data = [];
                        data = res.products;
                        list_result.empty();
                        update_search_result();
                        append_result();
                    },
                    error: err => {
                        console.log(err);
                    }
                });
            }
        });


        function update_search_result() {
            search_result_container.css('height', "250px");
            search_loader.addClass('d-none');
            list_result.removeClass('d-none');
        }

        function append_result() {
            data.map(phone => {
                let li = `<li>
                                <a href="${phone.link}">
                                    <img src="${main_url}/${phone.photo}" style="height: 50px;width:50px;margin-right:10px;margin-top:10px" />
                                    ${phone.model}
                                </a>
                            </li>`;
                list_result.append(li);
            });
        }

        $("body").click(function() {
            search_result_container.addClass('d-none');
        });
    }
</script>


<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key={{$api_key}}&libraries=places"></script>
<script src="https://tronicspay.com/assets/slick/slick.min.js"></script>
<script>
    (function($) {

        $.googlePlaces = function(element, options) {

            var defaults = {
                // placeId: '<?php echo $place_ID; ?>',
                render: ['reviews'],
                // min_rating: <?php echo $min_star; ?>,
                // max_rows: <?php echo $max_rows; ?>,
                rotateTime: false
            };

            var plugin = this;

            plugin.settings = {}

            var $element = $(element),
                element = element;

            plugin.init = function() {
                plugin.settings = $.extend({}, defaults, options);
                $element.html("<div id='the-reviews'></div>"); // create a plug for google to load data into
                initialize_place(function(place) {
                    plugin.place_data = place;
                    // render specified sections
                    if (plugin.settings.render.indexOf('reviews') > -1) {
                        renderReviews(plugin.place_data.reviews);
                        if (!!plugin.settings.rotateTime) {
                            initRotation();
                        }
                    }
                });
            }

            var initialize_place = function(c) {
                var map = new google.maps.Map(document.getElementById('the-reviews'));

                var request = {
                    placeId: plugin.settings.placeId
                };

                var service = new google.maps.places.PlacesService(map);

                service.getDetails(request, function(place, status) {
                    if (status == google.maps.places.PlacesServiceStatus.OK) {
                        c(place);
                    }
                });
            }

            var sort_by_date = function(ray) {
                ray.sort(function(a, b) {
                    var keyA = new Date(a.time),
                        keyB = new Date(b.time);
                    // Compare the 2 dates
                    if (keyA < keyB) return -1;
                    if (keyA > keyB) return 1;
                    return 0;
                });
                return ray;
            }

            var filter_minimum_rating = function(reviews) {
                for (var i = reviews.length - 1; i >= 0; i--) {
                    if (reviews[i].rating < plugin.settings.min_rating) {
                        reviews.splice(i, 1);
                    }
                }
                return reviews;
            }

            var renderReviews = function(reviews) {
                reviews = sort_by_date(reviews);
                reviews = filter_minimum_rating(reviews);
                var html = "";
                var row_count = (plugin.settings.max_rows > 0) ? plugin.settings.max_rows - 1 : reviews.length - 1;
                // make sure the row_count is not greater than available records
                row_count = (row_count > reviews.length - 1) ? reviews.length - 1 : row_count;
                for (var i = row_count; i >= 0; i--) {
                    var stars = renderStars(reviews[i].rating);
                    var date = convertTime(reviews[i].time);
                    html = html + "<div class='review-item' itemprop='review' itemscope itemtype='http://schema.org/Review'><img src='" + reviews[i].profile_photo_url + "'/><div class='review-inner'><meta itemprop='itemReviewed' content='http://schema.org/{{$business_type}}' /><p class='review-text' itemprop='description'>" + reviews[i].text + "</p><div class='review-meta'><span class='review-author' itemprop='author'>" + reviews[i].author_name + "</span><span class='review-sep'>, </span><span class='review-date' itemprop='datePublished'>" + date + "</span></div>" + stars + "</div></div>"
                };
                $element.append(html);
            }

            var initRotation = function() {
                var $reviewEls = $element.children('.review-item');
                var currentIdx = $reviewEls.length > 0 ? 0 : false;
                $reviewEls.hide();
                if (currentIdx !== false) {
                    $($reviewEls[currentIdx]).show();
                    setInterval(function() {
                        if (++currentIdx >= $reviewEls.length) {
                            currentIdx = 0;
                        }
                        $reviewEls.hide();
                        $($reviewEls[currentIdx]).fadeIn('slow');
                    }, plugin.settings.rotateTime);
                }
            }

            var renderStars = function(rating) {
                var stars = "<div class='review-stars' itemprop='reviewRating' itemscope itemtype='http://schema.org/Rating'><meta itemprop='worstRating' content='1'/><meta itemprop='ratingValue' content='" + rating + "'/><meta itemprop='bestRating' content='5'/><ul>";

                // fill in gold stars
                for (var i = 0; i < rating; i++) {
                    stars = stars + "<li class='star'>&#9733;</li>";
                };

                // fill in empty stars
                if (rating < 5) {
                    for (var i = 0; i < (5 - rating); i++) {
                        stars = stars + "<li class='star inactive'>&#9733;</li>";
                    };
                }
                stars = stars + "</ul></div>";
                return stars;
            }

            var convertTime = function(UNIX_timestamp) {
                var a = new Date(UNIX_timestamp * 1000);
                var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                var time = months[a.getMonth()] + ' ' + a.getDate() + ', ' + a.getFullYear();
                return time;
            }

            plugin.init();

        }

        $.fn.googlePlaces = function(options) {

            return this.each(function() {
                if (undefined == $(this).data('googlePlaces')) {
                    var plugin = new $.googlePlaces(this, options);
                    $(this).data('googlePlaces', plugin);
                }
            });

        }

    })(jQuery);
</script>






<script>
   document.querySelector("#button-addon2").onclick = function(e) {
       e.preventDefault()
       const v = document.querySelector("#search-input").value
       window.location.href = "https://tronicspay.com/products/search?q=" + v
   }
</script>

<script>
    // $(document).ready(function() {
    //     $("#google-reviews").googlePlaces({});
    // });

$(document).ready(function(){
  $('#slider').slick({
      arrows:true,
        slidesToShow: 2,
        // respondTo: '#slider-container',
        // variableWidth: false,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
  });
});
      
 

</script>
@endsection