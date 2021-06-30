@extends('layouts.app')

@section('title')
    Add New Client
@endsection

@section('extra-styles')
	<link rel="stylesheet" href="/assets/bower_components/select2/css/select2.min.css">
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
	<div>
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<div class="card">
					<div class="card-block">
						@include('livewire.backend.crm.common._slab-menu')
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-lg-12 col-sm-12">
				<div class="card">
					<div class="btn-group mt-3 btn-group d-flex justify-content-end mr-3" >
						<a href="{{route('clients')}}" class="btn btn-primary btn-mini waves-effect waves-light">
							<i class="ti-user"></i>All Clients
						</a>
					</div>
					<div class="card-block">
						<h5 class="sub-title">Add New Client</h5>
						<span>All fields marked with <sup class="text-danger">*</sup> are compulsory.</span>
						<form action="" wire:submit.prevent="addNewClient" class="mt-3">
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label for="">Company Name</label>
										<input type="text" placeholder="Company Name" name="company_name" class="form-control">
										@error('company_name')
										<i class="text-danger mt-2">{{$message}}</i>
										@enderror
									</div>
								</div>
							</div>
							<h4 class="sub-title mt-3">Contact Person</h4>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">First Name <sup class="text-danger">*</sup> </label>
										<input type="text" class="form-control" placeholder="First Name" name="first_name">
										@error('first_name')
										<i class="text-danger mt-2">{{$message}}</i>
										@enderror
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Surname <sup class="text-danger">*</sup> </label>
										<input type="text" class="form-control" placeholder="Surname" name="surname">
										@error('surname')
										<i class="text-danger mt-2">{{$message}}</i>
										@enderror
									</div>
								</div>
							</div>
							<div class="row mt-3">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Position </label>
										<input type="text" class="form-control" placeholder="Position" name="position">
										@error('position')
										<i class="text-danger mt-2">{{$message}}</i>
										@enderror
									</div>
								</div>
								<div class="col-md-6">
									<label for="">Mobile No. <sup class="text-danger">*</sup> </label>
									<input type="text" class="form-control" placeholder="Mobile No." name="mobile_no">
									@error('mobile_no')
									<i class="text-danger mt-2">{{$message}}</i>
									@enderror
								</div>
							</div>
							<div class="row mt-3">

								<div class="col-md-6">
									<label for="">Email Address  <sup class="text-danger">*</sup> </label>
									<input type="text" class="form-control" placeholder="Email Address " name="email">
									@error('email')
									<i class="text-danger mt-2">{{$message}}</i>
									@enderror
								</div>
								<div class="col-md-6">
									<label for="">Website</label>
									<input type="text" class="form-control" placeholder="Website" name="website">
									@error('website')
									<i class="text-danger mt-2">{{$message}}</i>
									@enderror
								</div>
							</div>
							<h4 class="sub-title mt-3">Address</h4>
							<div class="row mt-3">
								<div class="col-md-6">
									<label for="">Street 1 <sup class="text-danger">*</sup> </label>
									<input type="street_1" class="form-control" placeholder="Street 1" name="street_1">
									@error('street_1')
									<i class="text-danger mt-2">{{$message}}</i>
									@enderror
								</div>
								<div class="col-md-6">
									<label for="">Street 2</label>
									<input type="text" class="form-control" placeholder="Street 2" name="street_2">
									@error('street_2')
									<i class="text-danger mt-2">{{$message}}</i>
									@enderror
								</div>
							</div>
							<div class="row mt-3">
								<div class="col-md-4">
									<label for="">Country  <sup class="text-danger">*</sup> </label> <br>
									<select  class="form-control js-example-basic-single" name="country" >
										<option selected disabled >Select Country</option>
										@foreach($countries as $count)
											<option value="{{$count->id}}">{{ucfirst(strtolower($count->name))}}</option>
										@endforeach
									</select>
									@error('country')
									<i class="text-danger mt-2">{{$message}}</i>
									@enderror
								</div>
								<div class="col-md-4">
									<label for="">City  <sup class="text-danger">*</sup> </label> <br>
									<input type="text" placeholder="City" class="form-control" name="city">
									@error('city')
									<i class="text-danger mt-2">{{$message}}</i>
									@enderror
								</div>
								<div class="col-md-3">
									<label for="">Postal Code  </label>
									<input type="text" class="form-control" placeholder="Postal Code" name="postal_code">
									@error('postal_code')
									<i class="text-danger mt-2">{{$message}}</i>
									@enderror
								</div>
							</div>
							<div class="row mt-3">
								<div class="col-md-12">
									<label for="">Note</label>
									<textarea class="form-control" placeholder="Leave a Note" name="note"></textarea>
								</div>
							</div>
							<div class="row mt-3">
								<div class="col-md-12">
									<div class="btn-group d-flex justify-content-center">
										<a href="{{url()->previous() }}" class="btn btn-secondary btn-mini">Cancel</a>
										<button type="submit" class="btn btn-primary btn-mini">Submit</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

	</div>

@endsection

@section('dialog-section')

@endsection
@section('extra-scripts')
	<script type="text/javascript" src="/assets/bower_components/select2/js/select2.full.min.js"></script>
	<script>
		$(document).ready(function() {
			$('.js-example-basic-single').select2();
		});
	</script>

@endsection
