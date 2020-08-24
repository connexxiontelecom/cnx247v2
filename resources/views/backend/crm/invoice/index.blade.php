@extends('layouts.app')

@section('title')
    Invoice List
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
    <div class="row">
        <div class="col-xl-3 col-lg-12 push-xl-9">
            <div class="card">
                <div class="card-block p-t-10">
                    <div class="task-right">
                        <div class="task-right-header-status">
                            <span data-toggle="collapse">Top Converters</span>
                        </div>
                        @foreach ($invoices as $invoice)
                        <div class="user-box assign-user taskboard-right-users">
                            <div class="media">
                                <div class="media-left media-middle photo-table">
                                    <a href="#">
                                        <img class="media-object img-radius" src="\assets\images\avatar-1.jpg" alt="Generic placeholder image">
                                        <div class="live-status bg-danger"></div>
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h6>{{$invoice->converter->first_name ?? ''}} {{$invoice->converter->surname ?? ''}}</h6>
                                    <p>{{$invoice->converter->position ?? ''}} <br> <label for="" class="label label-primary">on</label> <small>{{date('d F, Y', strtotime($invoice->created_at))}}</small> <label for="" class="label label-primary">@</label> <small>{{date('h:ia', strtotime($invoice->created_at))}}</small></p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-12 pull-xl-3 filter-bar">
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-block">
                            <div class="row align-items-center m-l-0">
                                <div class="col-auto">
                                    <i class="icofont icofont-ui-calendar f-30 text-c-lite-green"></i>
                                </div>
                                <div class="col-auto">
                                    <h6 class="text-muted m-b-10">This Year</h6>
                                    <h5 class="m-b-0">379</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-block">
                            <div class="row align-items-center m-l-0">
                                <div class="col-auto">
                                    <i class="icofont icofont-ui-calendar f-30 text-c-lite-green"></i>
                                </div>
                                <div class="col-auto">
                                    <h6 class="text-muted m-b-10">Last Month</h6>
                                    <h5 class="m-b-0">{{Auth::user()->tenant->currency->symbol ?? '₦'}}{{number_format($last_month,2)}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-block">
                            <div class="row align-items-center m-l-0">
                                <div class="col-auto">
                                    <i class="icofont icofont-ui-calendar f-30 text-c-lite-green"></i>
                                </div>
                                <div class="col-auto">
                                    <h6 class="text-muted m-b-10">This Month</h6>
                                    <h5 class="m-b-0">{{Auth::user()->tenant->currency->symbol ?? '₦'}}{{number_format($monthly,2)}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-block">
                            <div class="row align-items-center m-l-0">
                                <div class="col-auto">
                                    <i class="icofont icofont-ui-calendar f-30 text-c-lite-green"></i>
                                </div>
                                <div class="col-auto">
                                    <h6 class="text-muted m-b-10">This Week</h6>
                                    <h5 class="m-b-0">379</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($invoices as $invoice)
                    <div class="col-sm-6">
                        <div class="card card-border-primary">
                            <div class="card-header">
                                <h5>{{$invoice->client->first_name ?? ''}}  {{$invoice->client->surname ?? ''}}</h5>
                                <div class="dropdown-secondary dropdown f-right">
                                    <a class="btn btn-primary btn-mini waves-effect waves-light" href="#" aria-haspopup="true" aria-expanded="false">{{$invoice->converter->first_name ?? ''}}  {{$invoice->converter->surname ?? ''}}</a>
                                    <span class="f-left m-r-5 text-inverse">Issued By :</span>
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <ul class="list list-unstyled">
                                            <li>Invoice #: {{$invoice->invoice_no}}</li>
                                            <li>Issued on: <span class="text-semibold">{{date('d F, Y', strtotime($invoice->issue_date))}}</span></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6">
                                        <ul class="list list-unstyled text-right">
                                            <li>{{number_format($invoice->total,2)}}</li>
                                            <li>: <span class="text-semibold">cc</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="task-list-table">
                                    <p class="task-due"><strong> Due : </strong><strong class="label label-danger">{{date('d F, Y', strtotime($invoice->due_date))}}</strong></p>
                                </div>
                                <div class="task-board m-0">
                                    <a href="{{route('print-invoice',$invoice->slug)}}" class="btn btn-info btn-mini b-none"><i class="icofont icofont-eye-alt m-0"></i></a>
                                    <div class="dropdown-secondary dropdown">
                                        <button class="btn btn-info btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown14" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                        <div class="dropdown-menu" aria-labelledby="dropdown14" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                            <a class="dropdown-item waves-light waves-effect" href="{{route('print-invoice', $invoice->slug)}}"><i class="icofont icofont-ui-alarm"></i> Print Invoice</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-attachment"></i> Download invoice</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="ti-trash text-danger"></i> Delete Invoice</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

@section('dialog-section')

@endsection
@section('extra-scripts')

@endsection
