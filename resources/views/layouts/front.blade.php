<!DOCTYPE html>
<html lang="en">

<head>
	@include('analytics')
	<title>TronicsPay | Sell used Cell Phones, Game Consoles and Electronics. Get Paid!</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="robots" content="index, follow">
	<meta name="title" content="TronicsPay">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta name="keywords" content="Apple,Samsung,LG,HTC,Nokia,Sony,Alcatel,Google,Zte,OnePlus,Motorola,Sell device,Sell used phone,Sell your used phone,Sell electronics,iPad,Tablet,Smart Watches,Game console">
	<meta name="description" content="Sell your used cell phones and electronics. Sell your iPhone, Samsung Galaxy, iPad, Smart Watches, Game Consoles and more for cash. We will pay you!" />
	<meta name="language" content="English">
	<meta name="revisit-after" content="1 days">

	<meta property="og:site_name" content="Tronics Pay" />
	<meta property="og:locale" content="en_US" />

	<meta property="article:publisher" content="https://www.facebook.com/recellelectronics816/" />
	<meta name="twitter:card" content="summary_large_image" />
	<meta name="csrf-token" content="{{ csrf_token() }}">

	@if(isset($meta) && count($meta) > 0)
	@foreach($meta as $key => $val)
	{!! $val !!}
	@endforeach
	@endif

	<link rel="canonical" href="https://www.tronicspay.com/" />
	<link rel="shortcut icon" href="{{ url('library/images/favicon.ico') }}" />
	<link href="https://getbootstrap.com/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{ url('assets/css/style.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ url('assets/plugins/fontawesome-free/css/all.min.css') }}">
	<link rel="stylesheet" href="{{ url('css/admin-style.css') }}">
	<link rel="stylesheet" href="{{ url('library/plugins/sweetalert/dist/sweetalert.css') }}">


	<!-- Bootstrap core CSS -->
	<!-- <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"> -->
	<link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

	<!-- Favicons -->
	<link rel="apple-touch-icon" href="{{ url('library/images/favicon.ico') }}" sizes="180x180">
	<link rel="icon" href="{{ url('library/images/favicon.ico') }}" sizes="32x32" type="image/png">
	<link rel="icon" href="{{ url('library/images/favicon.ico') }}" sizes="16x16" type="image/png">
	<link rel="manifest" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/manifest.json">
	<link rel="mask-icon" href="{{ url('library/images/favicon.ico') }}" color="#7952b3">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<title>{{ (isset($page) && $page->title != '') ? $page->title : 'TronicsPay' }}</title>
	<!-- <link rel="stylesheet" href="<?= phpb_theme_asset('css/style.css') ?>" /> -->

	@yield('page-css')
</head>

<body data-url="{{ url('/') }}" style="display: flex;flex-direction: column;">
	@include('partial.front.navbar')
	<div style="flex-grow: 1;">
		@yield('content')
	</div>
	<footer class="section-footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-12 column-1">
					<div class="form-group">
						<img src="{{ url('assets/images/footer-logo.png') }}" class="img-fluid" />
					</div>
					<div class="form-group">
						<a href="{{ url('/') }}" class=" fontGray2-5 font14px">Home</a> |
						<a href="{{ url('/about-us') }}" class=" fontGray2-5 font14px">About Us</a> |
						<a href="{{ url('/how-it-works') }}" class=" fontGray2-5 font14px">How It Works</a> |
						<a href="{{ url('/contact-us') }}" class=" fontGray2-5 font14px">Contact Us</a>
					</div>
					<div class="form-group footer-left-button">
						<a href="{{ url('products/sell') }}" class="btn btn-warning btn-md btn-footer hvr-shrink fontWhite">
							Sell Your Phone
						</a>
					</div>
					<div class="form-group">
						<div class="">
							<h4 class="footer-subtitle">Follow us</h4>
						</div>
						<div class="top-margin social-column">
							<a href="https://www.facebook.com/TronicsPay/" class="hvr-shrink">
								<img src="{{ url('assets/images/social/facebook.png') }}" class="social-icons" />
							</a>
							<a href="https://twitter.com/tronicspay" class="hvr-shrink">
								<img src="{{ url('assets/images/social/twitter.png') }}" class="social-icons" />
							</a>
							<a href="https://www.instagram.com/tronicspay/" class="hvr-shrink">
								<img src="{{ url('assets/images/social/instagram.png') }}" class="social-icons" />
							</a>
							<a href="#" class="hvr-shrink">
								<img src="{{ url('assets/images/social/youtube.png') }}" class="social-icons" />
							</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 column-2">
					<div class="footer-title">
						<h4 class="footer-subtitle">Contact Us</h4>
					</div>
					<div class="top-margin">
						<div class="media padding5">
							<i class="far fa-fw fa-clock fontYellow"></i>
							<div class="media-body footer-column">
								<p class="fontGray2-5">
									10:00AM - 7:00PM <br />
									Monday - Saturday<br />
									12:00PM - 5:00PM <br />
									Sunday
								</p>
							</div>
						</div>
						<div class="media">
							<i class="fas fa-fw fa-map-marker-alt fontYellow"></i>
							<div class="media-body footer-column">
								<p class="fontGray2-5">1214 S Noland Rd, Independence, MO 64055</p>
							</div>
						</div>
						<div class="media">
							<i class="fas fa-fw fa-phone-alt fontYellow"></i>
							<div class="media-body footer-column">
								<p class="fontGray2-5">1-816-886-7285</p>
							</div>
						</div>
						<div class="media">
							<i class="far fa-fw fa-envelope fontYellow"></i>
							<div class="media-body footer-column">
								<p class="fontGray2-5">tronicspay@gmail.com</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 column-5 form-group">
					<div class="footer-title">
						<h4 class="footer-subtitle">Subscribe</h4>
					</div>
					<div class="top-margin social-column  fontGray2-5 font14px">
						By clicking “Subscribe”, you agree to receive our newsletter about our website, special offers and promos. You can opt-out at any time.
						<br />



						<div id="mc_embed_signup">
							<form action="https://gmail.us20.list-manage.com/subscribe/post?u=a7b99d655398a5f5fa4d589b1&amp;id=62d2caa63b" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
								<div id="mc_embed_signup_scroll">
									<div class="input-group">

										<!-- <div class="input-group-prepend">
											<div class="input-group-text btn-warning" id="btnGroupAddon">
												<i onclick="document.querySelector('#mc-embedded-subscribe').click()" class="fab fa-telegram-plane fontWhite"></i>

											</div>
										</div> -->

										<div class="mc-field-group">
											<input type="email" class="form-control" placeholder="Email Address" value="" name="EMAIL" class="required email" id="mce-EMAIL">
										</div>
										<div class="input-group-append">
											<input type="submit" value="Subscribe" class="btn btn-warning text-white" name="subscribe" id="mc-embedded-subscribe">
										</div>

										<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_a7b99d655398a5f5fa4d589b1_62d2caa63b" tabindex="-1" value=""></div>

										<div id="mce-responses">
											<div class="response" id="mce-error-response" style="display:none"></div>
											<div class="response" id="mce-success-response" style="display:none"></div>
										</div>

									</div>
								</div>
						</div>
						</form>
					</div>

				</div>
			</div>
		</div>
		</div>
		<div class="container-fluid">
			<div class="row no-gutters">
				<div class="col-lg-12">
					<style>
						.copyright-area {
							background: #eee;
						}
					</style>
					<div class="copyright-area pt15 background-theme">
						<div class="container">
							<div class="row">
								<div class="col-xl-6 col-lg-4 text-center text-lg-left">
									<div class="copyright-text fontWhite">
										<p>Copyright &copy; 2021 All Rights Reserved</p>
									</div>
								</div>
								<div class="col-xl-6 col-lg-8 d-none d-lg-block text-right">
									<div class="footer-menu">
										<a href="{{ url('/') }}" class="fontWhite font14px">Home</a> |
										<a href="{{ url('/about-us') }}" class="fontWhite font14px">About Us</a> |
										<a href="{{ url('/how-it-works') }}" class="fontWhite font14px">How It Works</a> |
										<a href="{{ url('/contact-us') }}" class="fontWhite font14px">Contact Us</a> |
										<a href="{{ url('/terms-and-conditions') }}" class="fontWhite font14px">Terms & Condition</a> |
										<a href="{{ url('/privacy-policy') }}" class="fontWhite font14px">Privacy Policy</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<!-- <script src="https://getbootstrap.com/docs/4.5/dist/js/bootstrap.bundle.min.js"></script> -->
	<script src="https://getbootstrap.com/docs/5.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
	<!-- <script src="https://getbootstrap.com/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>
	<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
	<script src="{{ url('assets/dist/js/functions.js') }}"></script>
	<script src="{{ url('library/js/jsfunctions.js') }}"></script>
	<script type="text/javascript" src="{{ url('library/plugins/sweetalert/sweetalert_old.min.js')}}"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" crossorigin="anonymous"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
	<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->

	@yield('page-js')
	<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$(document).ready(function() {
			if (localStorage.getItem("sessionCart")) {
				$('.cart-counter').html('<i class="fas fa-shopping-cart fa-fw"></i> <span>' + JSON.parse(decryptData(localStorage.getItem("sessionCart"))).length + '</span>');
			}
		});
	</script>
	<!-- Google Code for Remarketing Tag -->
	<!--------------------------------------------------
Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. See more information and instructions on how to setup the tag on: http://google.com/ads/remarketingsetup
--------------------------------------------------->
	<script type="text/javascript">
		/* <![CDATA[ */
		var google_conversion_id = 948593355;
		var google_custom_params = window.google_tag_params;
		var google_remarketing_only = true;
		/* ]]> */
	</script>
	<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
	</script>
	<noscript>
		<div style="display:inline;">
			<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/948593355/?value=0&amp;guid=ON&amp;script=0" />
		</div>
	</noscript>
	<!-- <script src="//t1.extreme-dm.com/f.js" id="eXF-tronics-0" async defer></script> -->
	<script type="text/javascript">
		(function() {
			window['__CF$cv$params'] = {
				r: '64abdb0dcf8b23c8',
				m: '36042d2678c16d31f4720198f2d93ed4280f0aee-1620237495-1800-AVS7I89fIQQ8Q8QPrkf1dLn2Dxk4Bfa1zK91ybtrhWpcBIz+lYv5MFTxzlXMOynDnlfzU+Ig5CtQFpz94Y2qxd95yVwB1zWxFR3GWePpiFe1fTe1Bujg+mEKVmg8yLQqgg==',
				s: [0x50b995ec94, 0xe0da9c633d],
			}
		})();
	</script>
	<!--Start of Tawk.to Script-->
	<script type="text/javascript">
		var Tawk_API = Tawk_API || {},
			Tawk_LoadStart = new Date();
		(function() {
			var s1 = document.createElement("script"),
				s0 = document.getElementsByTagName("script")[0];
			s1.async = true;
			s1.src = 'https://embed.tawk.to/60de64417f4b000ac03a9e15/1f9ibf8je';
			s1.charset = 'UTF-8';
			s1.setAttribute('crossorigin', '*');
			s0.parentNode.insertBefore(s1, s0);
		})();
	</script>
	<!--End of Tawk.to Script-->
</body>

</html>
