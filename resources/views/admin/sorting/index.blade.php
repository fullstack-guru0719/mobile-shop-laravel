@extends('layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1><i class="nav-icon fas fa-sort-alpha-down"></i> Products Order</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item active"><i class="nav-icon fas fa-sort-alpha-down"></i> Products Order</li>
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

		<div class='row py-5'>
			<div class="col-md-12 fn">
				<div class="text-center">
					<button class="btn btn-primary btn-md save-sorting" type="submit" onclick="saveSorting()">Save</button>
				</div>
			</div>
		</div>
		<div class="row align-items-center justify-content-center">
			<div class="col-12 col-md-6 ">
				<form action="{{ url('admin/sorting') }}" id="sortingForm" method="POST" enctype="multipart/form-data" onsubmit="saveSorting()">
					@csrf
					@method('POST')
					<div class="accordion" id="accordion">
						@foreach($brands as $brand)
						<div class="card">
							<div class="card-header" id="heading-{{$brand['id']}}">
								<h2 class="mb-0">
									<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-{{$brand['id']}}" aria-expanded="true" aria-controls="#collapse-{{$brand['id']}}">
										{{$brand['name']}}
									</button>
								</h2>
							</div>

							<div id="collapse-{{$brand['id']}}" class="collapse" aria-labelledby="heading-{{$brand['id']}}" data-parent="#accordion">
								<div class="card-body">
									<ul class="sort-ul" id="sortable-{{$brand['id']}}">
										@foreach($brand['products'] as $product)
										<li class='ui-state-default' data-id="{{$product->id}}">{{$product->model}}</li>
										@endforeach
									</ul>
								</div>
							</div>
						</div>
						@endforeach

					</div>

				</form>
			</div>

		</div>
		<div class='row py-5'>
			<div class="col-md-12 fn">
				<div class="text-center">
					<button class="btn btn-primary btn-md save-sorting" type="submit">Save</button>
				</div>
			</div>
		</div>




	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection


@section('page-css')
<link href="{{ url('//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css') }}" rel="stylesheet">
<style>
	.sort-ul {
		list-style: none;
		margin: 0;
		padding: 0;
	}

	.ui-state-default {
		/* display: inline-block; */
		padding: 3px;
		margin-bottom: 2px;
	}
</style>
@endsection


@section('page-js')

@include('admin.modals.sorting.modal')


<script src="{{ url('https://code.jquery.com/ui/1.12.1/jquery-ui.js') }}"></script>
@foreach($brands as $brand)
<script>
	$(function() {
		$("#sortable-{{$brand['id']}}").sortable({
			placeholder: "ui-state-highlight"
		});
		$("#sortable-{{$brand['id']}}").disableSelection();
	});
</script>
@endforeach

<script>
	function saveSorting(e) {
		const itemPriorities = {}
		const lists = document.querySelectorAll(".sort-ul")
		for (let i = 0; i < lists.length; i++) {
			const list = lists[i];
			const items = list.querySelectorAll("li")
			for (let j = 0; j < items.length; j++) {
				const item = items[j];
				itemPriorities[item.dataset.id] = j;
			}
		}

		const form = document.getElementById("sortingForm")

		const serializedDataInput = document.createElement("input")
		serializedDataInput.name = 'priorities'
		serializedDataInput.type = "hidden"
		serializedDataInput.value = JSON.stringify(itemPriorities)

		form.appendChild(serializedDataInput)

		form.submit()
	}

	// TODO ttt
</script>
<script>
	$(document).ready(function() {
		<?php if (session()->has('msg')) { ?>
			swalWarning("Congratulations", "<?php echo session('msg'); ?>", "success", "Close");
		<?php } ?>
		<?php if (session()->has('errormsg')) { ?>
			swalWarning("Oops", "<?php echo session('errormsg'); ?>", "waarning", "Close");
		<?php } ?>

	});
</script>
@endsection