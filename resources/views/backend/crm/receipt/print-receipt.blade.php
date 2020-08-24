@extends('layouts.app')

@section('title')
    Receipt
@endsection

@section('extra-styles')

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
    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="card">
                <div class="card-block">
                    @include('livewire.backend.crm.common._slab-menu')
                </div>
            </div>
        </div>
    </div>
    <div class="card" id="invoiceContainer">
        <div class="row invoice-contact">
            <div class="col-md-8">
                <div class="invoice-box row">
                    <div class="col-sm-12">
                        <table class="table table-responsive invoice-table table-borderless">
                            <tbody>
                                <tr>
                                    <td><img src="{{asset('/assets/images/company-assets/logos/'.Auth::user()->tenant->logo ?? 'logo.png')}}" class="m-b-10" alt="{{Auth::user()->tenant->company_name ?? 'CNX247 ERP Solution'}}" height="52" width="82"></td>
                                </tr>
                                <tr>
                                    <td>{{ Auth::user()->tenant->company_name ?? 'Company Name here'}}</td>
                                </tr>
                                <tr>
                                    <td>{{Auth::user()->tenant->street_1 ?? 'Street here'}} {{ Auth::user()->tenant->city ?? ''}} {{Auth::user()->tenant->postal_code ?? 'Postal code here'}}</td>
                                </tr>
                                <tr>
                                    <td><a href="mailto:{{Auth::user()->tenant->email ?? ''}}" target="_top"><span class="__cf_email__" data-cfemail="">[ {{Auth::user()->tenant->email ?? 'Email here'}} ]</span></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{Auth::user()->tenant->phone ?? 'Phone Number here'}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
            </div>
        </div>
        <div class="card-block">
            <div class="row invoive-info">
                <div class="col-md-4 col-xs-12 invoice-client-info">
                    <h6>Client Information :</h6>
                    <h6 class="m-0">{{$receipt->client->first_name ?? ''}} {{$receipt->client->surname ?? ''}}</h6>
                    <p class="m-0 m-t-10">{{$receipt->client->street_1 ?? ''}}, {{$receipt->client->postal_code ?? ''}} {{$receipt->client->city ?? ''}}</p>
                    <p class="m-0">{{$receipt->client->mobile_no ?? ''}}</p>
                    <p><a href="mailto:{{$receipt->client->email ?? ''}}" class="__cf_email__" data-cfemail="eb8f8e8684ab939291c5888486">[{{$receipt->client->email ?? ''}}]</a></p>
                </div>
                <div class="col-md-4 col-sm-6">
                    <h6>Order Information :</h6>
                    <table class="table table-responsive invoice-table invoice-order table-borderless">
                        <tbody>
                            <tr>
                                <th>Issue Date :</th>
                                <td>{{date('d F, Y', strtotime($receipt->issue_date))}}</td>
                            </tr>
                            <tr>
                                <th>Due Date :</th>
                                <td>{{date('d F, Y', strtotime($receipt->due_date))}}</td>
                            </tr>
                            <tr>
                                <th>Status :</th>
                                <td>
                                    <span class="label label-warning">Pending</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4 col-sm-6">
                    <h6 class="m-b-20">Invoice Number <span>#{{$receipt->receipt_no}}</span></h6>
                    <h6 class="text-uppercase text-primary">Total Due :
                        <span>{{Auth::user()->tenant->currency->symbol ?? '₦'}}{{number_format($receipt->total,2)}}</span>
                    </h6>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table  invoice-detail-table">
                            <thead>
                                <tr class="thead-default">
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($receipt->receiptItem as $item)
                                    <tr>
                                        <td>
                                            <p>{{$item->description ?? ''}}</p>
                                        </td>
                                        <td>{{number_format($item->quantity)}}</td>
                                        <td>{{Auth::user()->tenant->currency->symbol ?? '₦'}}{{number_format($item->unit_cost, 2)}}</td>
                                        <td>{{Auth::user()->tenant->currency->symbol ?? '₦'}}{{number_format($item->total, 2)}}</td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-responsive invoice-table invoice-total">
                        <tbody>
                            <tr>
                                <th>Sub Total :</th>
                                <td>{{Auth::user()->tenant->currency->symbol ?? '₦'}}{{number_format($receipt->sub_total,2)}}</td>
                            </tr>
                            <tr>
                                <th>Taxes ({{$receipt->tax_rate}}%) :</th>
                                <td>{{Auth::user()->tenant->currency->symbol ?? '₦'}}{{number_format($receipt->tax_value,2) ?? 0}}</td>
                            </tr>
                            <tr>
                                <th>Discount ({{$receipt->discount_rate}}%) :</th>
                                <td>{{Auth::user()->tenant->currency->symbol ?? '₦'}}{{number_format($receipt->discount_value,2) ?? 0}}</td>
                            </tr>
                            <tr class="text-info">
                                <td>
                                    <hr>
                                    <h5 class="text-primary">Total :</h5>
                                </td>
                                <td>
                                    <hr>
                                    <h5 class="text-primary">{{Auth::user()->tenant->currency->symbol ?? '₦'}}{{number_format($receipt->total,2)}}</h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h6>Terms And Condition :</h6>
                    <p>{!! Auth::user()->tenant->receipt_terms !!}</p>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-sm-12 invoice-btn-group text-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-mini btn-print-invoice m-b-10 btn-sm waves-effect waves-light m-r-20" value="{{$receipt->id}}" id="sendInvoiceViaEmail"> <i class="icofont icofont-email mr-2"></i> <span id="sendEmailAddon">Send as Email</span> </button>
                        <button type="button" class="btn btn-primary btn-mini btn-print-invoice m-b-10 btn-sm waves-effect waves-light m-r-20" type="button" id="printInvoice"><i class="icofont icofont-printer mr-2"></i> Print</button>
                        <a href="{{url()->previous()}}" class="btn btn-secondary btn-mini waves-effect m-b-10 btn-sm waves-light"><i class="ti-arrow-left mr-2"></i> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('dialog-section')

@endsection
@section('extra-scripts')
<script src="{{asset('/assets/js/cus/printThis.js')}}"></script>
<script src="{{asset('/assets/js/cus/axios.min.js')}}"></script>
<script src="{{asset('/assets/js/cus/axios-progress.js')}}"></script>
<script>
    $(document).ready(function(){
        //print without commission
        $(document).on('click', '#printInvoice', function(event){
            $('#invoiceContainer').printThis({
                header:"<p></p>",
                footer:"<p></p>",
            });
        });

        //send invoice
        $(document).on('click', '#sendInvoiceViaEmail', function(e){
            $('#sendEmailAddon').text('Processing...');
            axios.post('/send/receipt/email/',{id:$(this).val()})
            .then(response=>{
                $('#sendEmailAddon').text('Done!');
            })
            .catch(error=>{
                $('#sendEmailAddon').text('Error!');
            });
        });
    });
</script>
@endsection
