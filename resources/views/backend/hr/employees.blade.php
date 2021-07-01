@extends('layouts.app')

@section('title')
    Employees
@endsection

@section('extra-styles')
	<link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">

	<style>
		/* The heart of the matter */

		.horizontal-scrollable > .row {
			overflow-x: auto;
			white-space: nowrap;
		}

		.horizontal-scrollable {
			overflow-x: scroll;
			overflow-y: hidden;
			white-space: nowrap;
		}
	</style>
@endsection

@section('content')
	<div class="card">
		<div class="card-block">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-lg-12">
					<h5 class="sub-title text-center">
						{{Auth::user()->tenant->company_name ?? ''}}'s Employees
					</h5>
				</div>
			</div>

		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			@if (session()->has('success'))
				<div class="alert alert-success background-success" role="alert">
					{!! session()->get('success') !!}
				</div>
			@endif
		</div>
	</div>
	<div class="row">
		<div class="col-xl-12 col-lg-12 filter-bar">
			<div class="row">
				<div class="col-sm-12">
					<div class="card card-border-primary">
						<div class="card-block">
							<div class="dt-responsive table-responsive">
								<table id="simpletable" class="table table-striped table-bordered nowrap">
									<thead>
									<tr>
										<th>#</th>
										<th>Full Name</th>
										<th>Email</th>
										<th>Mobile No.</th>
										<th>Department</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
									</thead>
									<tbody>
									@php
										$serial = 1;
									@endphp
									@foreach ($employees as $employee)
										<tr>
											<td>{{$serial++}}</td>
											<td>
												<img style="height: 32px; width: 32px; border-radius: 50%;" src="/assets/images/avatars/thumbnails/{{$employee->avatar ?? 'avatar.png'}}" alt="{{$employee->first_name ?? ''}}">	{{$employee->first_name ?? ''}} {{$employee->surname ?? ''}}</td>
											<td>{{$employee->email ?? ''}}</td>
											<td>{{$employee->mobile ?? ''}}</td>
											<td>{{$employee->department->department_name ?? '' }}</td>
											<td>{!! $employee->account_status == 1 ? "<span class='text-success'>Active</span>" : "<span class='text-danger'>Inactive</span>" !!}</td>
											<td> <a href="{{route('view-profile', $employee->url)}}" class="btn btn-sm btn-primary"><i class="ti-eye"></i></a></td>
										</tr>
									@endforeach
									</tbody>
									<tfoot>
									<tr>
										<th>#</th>
										<th>Full Name</th>
										<th>Email</th>
										<th>Mobile No.</th>
										<th>Department</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
									</tfoot>
								</table>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection

@section('dialog-section')

@endsection
@section('extra-scripts')
	<script src="\assets\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
	<script src="\assets\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
	<script src="\assets\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
	<script src="\assets\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>
	<script src="\assets\pages\data-table\js\data-table-custom.js"></script>
@endsection

