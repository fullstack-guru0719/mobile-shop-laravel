@extends('layouts.front')
@section('content')
<?php
  $result = @json_decode($page->content);
?>
<section class="hero mt-70">
	<div class="container">
		<div class="text-center pt-50 hero-top">
			<h1 class="hero-header">{{ $result->header1 }}</h1>
			<div class="search-input">
				<form action="{{ url('products') }}" method="POST">
					@csrf
					<input type="text" name="productname" placeholder="Search for your device..." class="form-control" /><br />
					<button type="submit" class="btn btn-warning btn-md hvr-shrink">Search</button>
				</form>
			</div>
		</div>
		<div class="row mt-50">
			@foreach($rowone as $row)
			<div class="col-lg-2 col-md-4 device-link">
				<a href="{{ url('products/category', $row->name) }}" class="hvr-shrink">
					<img src="{{ url($row->photo) }}" class="img-fluid" />
					<h4 class="device-name">{{ $row->name }}</h4>
				</a>
			</div>
			@endforeach
		</div>
		<div class="row mt-50">
			<div class="col-lg-1"></div>
			@foreach($rowtwo as $row)
			<div class="col-lg-2 col-md-4 device-link">
				<a href="{{ url('products/brand', $row->name) }}" class="hvr-shrink">
					<img src="{{ url($row->photo) }}" class="img-fluid" />
					<h4 class="device-name">{{ $row->name }}</h4>
				</a>
			</div>
			@endforeach
			<div class="col-lg-1"></div>
		</div>
		<div class="row mt-50 pb-50">
			<div class="col-lg-12">
				<div class="text-center"><h1 class="hero-header">Other Devices</h1></div>
			</div>
		</div>
		<div class="row mt-50 pb-50">
			<div class="col-lg-1"></div>
			@foreach($rowtri as $row)
			<div class="col-lg-2 col-md-4 device-link" style="align-items: center; display: flex;">
				<a href="{{ url('products/brand', $row->name) }}" class="hvr-shrink">
					<img src="{{ url($row->photo) }}" class="img-fluid" />
					<h4 class="device-name">{{ $row->name }}</h4>
				</a>
			</div>
			@endforeach
			<div class="col-lg-1"></div>
		</div>
		<div class="row mt-50 pb-50">
			<div class="col-lg-12">
				<div class="text-center">
					<h2 class="text-white">Choose How You Wish to be Paid</h2>
					<h5 style="color: #7c7c7c; font-weight:normal">We cater to a vast amount of payment provider</h5>
				</div>
			</div>
		</div>
		<div class="row pb-50">
			<div class="col-md-2">
				<div class="text-center">
					<img src="{{ url('assets/images/payments/1.png') }}" class="img-fluid">
				</div>
			</div>
			<div class="col-md-2">
				<div class="text-center">
					<img src="{{ url('assets/images/payments/2.png') }}" class="img-fluid">
				</div>
			</div>
			<div class="col-md-2">
				<div class="text-center">
					<img src="{{ url('assets/images/payments/3.png') }}" class="img-fluid">
				</div>
			</div>
			<div class="col-md-2">
				<div class="text-center">
					<img src="{{ url('assets/images/payments/4.png') }}" class="img-fluid">
				</div>
			</div>
			<div class="col-md-2">
				<div class="text-center">
					<img src="{{ url('assets/images/payments/5.png') }}" class="img-fluid">
				</div>
			</div>
			<div class="col-md-2">
				<div class="text-center">
					<img src="{{ url('assets/images/payments/6.png') }}" class="img-fluid">
				</div>
			</div>
		</div>
	</div>
</section>
<section class="section-grey">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-8 col-md-6 parallax-1" style="background-image: url(<?php echo $result->image1; ?>);"></div>
			<div class="col-lg-4 col-md-6 right-content">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title ct-tronics">{{ $result->header2 }}</h5>
						<hr />
						<h4 class="sh-tronics">{{ $result->sub_header }}</h4>
						<p class="card-text content-p pb-30"><strong>{{ $result->text1 }}</strong> {{ $result->content1 }}</p>
						<p class="card-text content-p pb-30"><strong>{{ $result->text2 }}</strong> {{ $result->content2 }}</p>
						<p class="card-text content-p pb-30"><strong>{{ $result->text3 }}</strong> {{ $result->content3 }}</p>
						<p class="card-text content-p"><strong>{{ $result->text4 }}</strong> {{ $result->content4 }}</p>
						<div class="more-details">
							<a href="#" class="hvr-shrink">More Details <i class="fas fa-long-arrow-alt-right"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="section-grey">
	<div class="container-fluid parallax-2" style="background-image: url(<?php echo $result->image2; ?>);">
		<div class="row" style="padding: 50px 0px;">
			<div class="col-lg-4">
				<div class="card mb-4 shadow-sm">
					<div class="card-body">
						<div data-aos="fade-right" data-aos-duration="500" class="card-step">
							<h3>{{ $result->card1h }}</h3>
							<p>{{ $result->card1t }}</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="card mb-4 shadow-sm">
					<div class="card-body">
						<div data-aos="fade-right" data-aos-duration="1500" class="card-step">
							<h3>{{ $result->card2h }}</h3>
							<p>{{ $result->card2t }}</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="card mb-4 shadow-sm">
					<div class="card-body">
						<div data-aos="fade-right" data-aos-duration="2000" class="card-step">
							<h3>{{ $result->card3h }}</h3>
							<p>{{ $result->card3t }}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="section-grey">
	<div class="container pb-50">
		<div class="text-center hero-header pt-50">
			<h1 class="text-black">What Others Have To Say About Us...</h1>
			<p style="padding-top: 20px;"><img src="assets/images/reviews/1.png" class="img-fluid" /></p>
		</div>
		<div class="row">
			<div class="col-lg-6"><img src="assets/images/reviews/2.png" class="img-fluid" /></div>
			<div class="col-lg-6"><img src="assets/images/reviews/3.png" class="img-fluid" /></div>
		</div>
		<div class="row">
			<div class="col-lg-6"><img src="assets/images/reviews/4.png" class="img-fluid" /></div>
			<div class="col-lg-6"><img src="assets/images/reviews/5.png" class="img-fluid" /></div>
		</div>
		<div class="row">
			<div class="col-lg-6"><img src="assets/images/reviews/6.png" class="img-fluid" /></div>
			<div class="col-lg-6"><img src="assets/images/reviews/7.png" class="img-fluid" /></div>
		</div>
	</div>
</section>
<section class="section-grey">
	<div class="container pb-50">
		<div class="row">
			<div class="col-lg-5" style="background-color: rgb(255, 255, 255);">
				<div style="padding: 50px;">
					<img src="assets/images/reviews/8.png" class="img-fluid" /><img src="assets/images/reviews/9.png" class="img-fluid" /><img src="assets/images/reviews/10.png" class="img-fluid" />
					<img src="assets/images/reviews/11.png" class="img-fluid" />
				</div>
			</div>
			<div class="col-lg-7" style="background-color: rgb(238, 238, 233);">
				<div class="text-center contact-us">
					<i class="far fa-fw fa-envelope"></i>
					<h4 class="contact-head">Contact Us</h4>
					<iframe
						src="{{ $result->google_map }}"
						width="100%"
						height="450"
						frameborder="0"
						allowfullscreen="allowfullscreen"
						aria-hidden="false"
						tabindex="0"
						style="border: 0px;"
					></iframe>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection