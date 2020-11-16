@extends('layouts.app')

@section('title')
    Project Bill
@endsection

@section('extra-styles')
    <link rel="stylesheet" href="/assets/css/cus/jquery-ui.min.css">
    <link rel="stylesheet" href="/assets/css/cus/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/multiselect/css/multi-select.css">
    <link rel="stylesheet" href="/assets/bower_components/select2/css/select2.min.css">
@endsection

@section('content')
<nav class="navbar navbar-light bg-faded m-b-30 p-10">
    <div class="row">
        <div class="d-inline-block">
            <a class="btn btn-warning ml-3 btn-mini btn-round text-white" href="{{route('project-board')}}"><i class="icofont icofont-tasks"></i>  Project Detail</a>
            <a href="{{ route('project-budget', $project->post_url) }}" class=" btn btn-primary btn-mini btn-round text-white"><i class="icofont icofont-spreadsheet"></i> Budget</a>
            <a href="{{ route('project-invoice', $project->post_url) }}" class="btn btn-danger btn-mini btn-round text-white"><i class="icofont icofont-money-bag "></i>  Invoice </a>
            <a href="{{ route('project-receipt', $project->post_url) }}" class="btn btn-info btn-mini btn-round text-white"><i class="ti-receipt "></i>  Receipt </a>
        </div>
    </div>
    <div class="nav-item nav-grid">
        <a href="{{ route('project-calendar') }}" class="btn btn-info btn-mini btn-round text-white"><i class="icofont icofont-pie-chart "></i>  Gantt</a>
        <a href="{{ route('project-calendar') }}" class="btn btn-info btn-mini btn-round text-white"><i class="ti-calendar"></i>  Calendar</a>
        <a href="{{ route('project-analytics') }}" class="btn btn-danger btn-mini btn-round text-white"><i class="icofont icofont-pie-chart "></i>  Analytics </a>
    </div>
</nav>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <form action="{{route('store-project-bill')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Vendor</label>
                                    <select name="vendor" id="vendor" class="text-white select2-selection__rendered js-example-basic-single form-control">
                                        <option disabled selected>Select Vendor</option>
                                        @foreach($vendors as $vendor)
                                            <option value="{{$vendor->id}}" class="">{{$vendor->company_name ?? ''}}</option>
                                        @endforeach
                                    </select>
                                    @error('vendor')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Date</label>
                                            <input type="date" placeholder="Date" class="form-control" name="issue_date">
                                            @error('issue_date')
                                                <i class="text-danger mt-2">{{$message}}</i>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Bill Number</label>
                                            <input type="text" placeholder="Bill Number" class="form-control" disabled value="{{$billNo <= 10 ? '00000'.$billNo : $billNo}}">
                                            <input type="hidden" value="{{$billNo}}" name="bill_no">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Bill To</label>
                                            <textarea name="bill_to" id="bill_to" cols="5" style="resize:none;" placeholder="Bill to..." class="form-control"></textarea>
                                            @error('bill_to')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table  invoice-detail-table">
                                        <thead>
                                        <tr class="thead-default">
                                            <th>Account</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th>Amount</th>
                                            <th class="text-danger">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tbody id="products">
                                        <tr class="item">
                                            <td>
                                                <div class="form-group">
                                                    <select name="account[]" class="js-example-basic-single select-product">
                                                        <option selected disabled>Select account</option>
                                                        @foreach ($accounts as $account)
                                                            <option value="{{$account->glcode}}">{{$account->account_name ?? ''}} - ({{$account->glcode}})</option>
                                                        @endforeach
                                                    </select>
                                                    @error('description')
                                                    <i class="text-danger mt-2">{{$message}}</i>
                                                    @enderror
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" name="description[]" class="form-control" id="description" style="resize: none;" placeholder="Description">
                                                    @error('description')
                                                    <i class="text-danger mt-2">{{$message}}</i>
                                                    @enderror
                                                </div>
                                            </td>
                                            <td>
                                                <input type="number" placeholder="Quantity" name="quantity[]" class="form-control">
                                                @error('quantity')
                                                <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </td>
                                            <td><input type="text" name="total[]" class="form-control payment" style="width: 120px;"></td>
                                            <td>
                                                <i class="ti-trash text-danger remove-line" style="cursor: pointer;"></i>
                                            </td>
<input type="hidden" name="projectId" value="{{$project->id}}">
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <button class="btn btn-mini btn-primary add-line"> <i class="ti-plus mr-2"></i> Add Line</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Payment Instruction <sup class="text-danger">*</sup></label>
                                    <textarea name="payment_instruction" placeholder="Payment instruction..." class="form-control" style="resize: none;"></textarea>
                                    @error('payment_instruction')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                    <input type="hidden" name="totalAmount" id="totalAmount">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-responsive invoice-table invoice-total">
                                    <tbody>
                                    <tr class="text-info">
                                        <td>
                                            <hr>
                                            <h5 class="text-primary">Total :</h5>
                                        </td>
                                        <td>
                                            <hr>
                                            <h5 class="text-primary"> <span>{{Auth::user()->tenant->currency->symbol ?? 'N'}}</span> <span class="total"> 0.00</span></h5>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-12">
                                <div class="btn-group d-flex justify-content-center">
                                    <a href="" class="btn btn-mini btn-danger"><i class="ti-close mr-2"></i>Cancel</a>
                                    <button type="submit" class="btn btn-primary btn-mini"><i class="ti-check mr-2"> Submit</i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('dialog-section')

@endsection

@section('extra-scripts')
    <script src="/assets/js/cus/jquery-ui.min.js"></script>
    <script src="/assets/js/cus/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/assets/bower_components/select2/js/select2.full.min.js"></script>
    <script type="text/javascript" src="/assets/bower_components/multiselect/js/jquery.multi-select.js"></script>
    <script type="text/javascript" src="/assets/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
    <script type="text/javascript" src="/assets/pages/advance-elements/select2-custom.js"></script>
    <script>
        $(document).ready(function(){
            $(".select-product").select2({
                placeholder: "Select product/service"
            });
            var grand_total = 0;
            var rowCount = 1;

            $(document).on('click', '.add-line', function(e){
                e.preventDefault();
                var new_selection = $('.item').first().clone();
                $('#products').append(new_selection);

                $(".select-product").select2({
                    placeholder: "Select product or service"
                });
                $(".select-product").last().next().next().remove();
            });

            //Remove line
            $(document).on('click', '.remove-line', function(e){
                e.preventDefault();
                $(this).closest('tr').remove();
                calculateTotals();
                rowCount--;
            });

            $(document).on('change', '#vendor', function(e){
                e.preventDefault();
                axios.post('/vendor-bill/details', {vendor:$(this).val()})
                .then(response=>{
                    $('#bill_to').val(response.data.vendor.company_address);
                })
                .catch(error=>{

                });
            });

            //format as currency
            function formatAsCurrency(amount){
                return "₦"+Number(amount).toFixed(2);
            }
            $('.payment').on('change', function(e){
                e.preventDefault();
                setTotal();
            });

        function setTotal(){
            var sum = 0;
            $(".payment").each(function(){
                sum += +$(this).val();
            });
                $(".total").text(sum.toLocaleString());
        }
        });
    </script>
@endsection
