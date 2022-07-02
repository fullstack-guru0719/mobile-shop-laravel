@extends('layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Blank Page</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Dashboard</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
	

		<!--
			START: TOP STATISTICS
		-->

		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Products</span>
						<span class="info-box-number">90<small>%</small></span>
					</div>
				</div>
			</div>

			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Orders</span>
						<span class="info-box-number">41,410</span>
					</div>
				</div>
			</div>

			<div class="clearfix visible-sm-block"></div>

			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Customer</span>
						<span class="info-box-number">760</span>
					</div>
				</div>
			</div>

			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Customers</span>
						<span class="info-box-number">2,000</span>
					</div>
				</div>
			</div>
		</div>

		<!--
			END: TOP STATISTICS
		-->

		<!-- 
			START: CHART
		-->
		<!-- <div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Monthly Recap Report</h3>

						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							<div class="btn-group">
								<button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></button>
								<ul class="dropdown-menu" role="menu">
									<li><a href="#">Action</a></li>
									<li><a href="#">Another action</a></li>
									<li><a href="#">Something else here</a></li>
									<li class="divider"></li>
									<li><a href="#">Separated link</a></li>
								</ul>
							</div>
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					</div>
					
					<div class="box-body">
						<div class="row">
							<div class="col-md-8">
								<p class="text-center">
									<strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
								</p>

								<div class="chart">
									<canvas id="salesChart" style="height: 180px;"></canvas>
								</div>
							</div>
							
							<div class="col-md-4">
								<p class="text-center">
									<strong>Goal Completion</strong>
								</p>

								<div class="progress-group">
									<span class="progress-text">Add Products to Cart</span>
									<span class="progress-number"><b>160</b>/200</span>

									<div class="progress sm">
										<div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
									</div>
								</div>
							
								<div class="progress-group">
									<span class="progress-text">Complete Purchase</span>
									<span class="progress-number"><b>310</b>/400</span>

									<div class="progress sm">
										<div class="progress-bar progress-bar-red" style="width: 80%"></div>
									</div>
								</div>
							
								<div class="progress-group">
									<span class="progress-text">Visit Premium Page</span>
									<span class="progress-number"><b>480</b>/800</span>

									<div class="progress sm">
										<div class="progress-bar progress-bar-green" style="width: 80%"></div>
									</div>
								</div>
							
								<div class="progress-group">
									<span class="progress-text">Send Inquiries</span>
									<span class="progress-number"><b>250</b>/500</span>

									<div class="progress sm">
										<div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="box-footer">
						<div class="row">
							<div class="col-sm-3 col-xs-6">
								<div class="description-block border-right">
									<span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
									<h5 class="description-header">$35,210.43</h5>
									<span class="description-text">TOTAL REVENUE</span>
								</div>
							</div>
					
							<div class="col-sm-3 col-xs-6">
								<div class="description-block border-right">
									<span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
									<h5 class="description-header">$10,390.90</h5>
									<span class="description-text">TOTAL COST</span>
								</div>
							</div>
						
							<div class="col-sm-3 col-xs-6">
								<div class="description-block border-right">
									<span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
									<h5 class="description-header">$24,813.53</h5>
									<span class="description-text">TOTAL PROFIT</span>
								</div>
							</div>
					
							<div class="col-sm-3 col-xs-6">
								<div class="description-block">
									<span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
									<h5 class="description-header">1200</h5>
									<span class="description-text">GOAL COMPLETIONS</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> -->

		<!-- 
			END: CHART
		-->




		<!-- Default box -->
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Title</h3>

				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fas fa-minus"></i></button>
					<button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fas fa-times"></i></button>
				</div>
			</div>
			<div class="card-body">
				Start creating your amazing application!
			</div>
			<!-- /.card-body -->
			<div class="card-footer">
				Footer
			</div>
			<!-- /.card-footer-->
		</div>
		<!-- /.card -->

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
