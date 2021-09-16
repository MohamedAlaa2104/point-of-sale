@extends('dashboard.layouts.master')
@section('title', __('dashboard.orders'))
@section('css')
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css')}}">
    <!---Internal Fileupload css-->
    <link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
    <!---Internal Fancy uploader css-->
    <link href="{{URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">@lang('dashboard.main')</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('dashboard.orders')</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('dashboard.partials.errors')
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h6 class="card-title mb-1">@lang('dashboard.orders')</h6>
                        <p class="text-muted card-sub-title"></p>
                    </div>

                    <div class="form-group">
                        <p class="mg-b-10">@lang('dashboard.name')</p>
                        <input type="text"   value="{{$order->first_name . ' ' . $order->last_name}}" disabled class="form-control" id="inputName" required>
                    </div>
                    <div class="form-group">
                        <p class="mg-b-10">@lang('dashboard.email')</p>
                        <input type="text"   value="{{$order->email}}"disabled class="form-control" id="inputName" required>
                    <div class="form-group">
                        <p class="mg-b-10">@lang('dashboard.phone')</p>
                        <input type="text"   value="{{$order->phone}}"disabled class="form-control" id="inputName" required>
                    </div>
                    <div class="form-group">
                        <p class="mg-b-10">@lang('dashboard.address')</p>
                        <input type="text"   value="{{$order->state . ' - ' . $order->city . ' - ' . $order->street}}"disabled class="form-control" id="inputName" required>
                    </div>
                    <div class="form-group">
                        <p class="mg-b-10">@lang('dashboard.type')</p>
                        <input type="text"   value="{{$order->type == 1 ? trans('main.personal') : trans('main.commercial')}}"disabled class="form-control" id="inputName" required>
                    </div>

                    <div class="form-group">
                        <p class="mg-b-10">@lang('main.payment_type')</p>
                        <input type="text"   value="{{$order->payment_type == 1 ? trans('main.visa_master') : trans('main.mada')}}"disabled class="form-control" id="inputName" required>
                    </div>
                    <div class="form-group">
                        <p class="mg-b-10">@lang('dashboard.product_name')</p>
                        <input type="text"   value="{{$order->Product['name_'.LaravelLocalization::getCurrentLocale()]}}"disabled class="form-control" id="inputName" required>
                    </div>

                    <div class="form-group">
                        <p class="mg-b-10">@lang('dashboard.category')</p>
                        <input type="text"   value="{{$order->Product->Category['name_'.LaravelLocalization::getCurrentLocale()]}}"disabled class="form-control" id="inputName" required>
                    </div>

                    <div class="form-group">
                        <p class="mg-b-10">@lang('dashboard.paid')</p>
                        <input type="text"   value="{{$order->Contract()->exists() ? $order->Contract->Payments()->sum('amount') : 0}}"disabled class="form-control" id="inputName" required>
                    </div>
                    <div class="form-group">
                        <p class="mg-b-10">@lang('dashboard.post_code')</p>
                        <input type="text"   value="{{$order->post_code}}"disabled class="form-control" id="inputName" required>
                    </div>
                    @if($order->type == 2)
                    <div class="form-group">
                        <p class="mg-b-10">@lang('main.commercial_register')</p>
                        <input type="text"   value="{{$order->commercial_register}}"disabled class="form-control" id="inputName" required>
                    </div>
                    <div class="form-group">
                        <p class="mg-b-10">@lang('main.tax_number')</p>
                        <input type="text"   value="{{$order->tax_number}}"disabled class="form-control" id="inputName" required>
                    </div>
                    <div class="form-group">
                        <p class="mg-b-10">@lang('main.company_name')</p>
                        <input type="text"   value="{{$order->company_name}}"disabled class="form-control" id="inputName" required>
                    </div>
                    @endif
                    <div class="form-group">
                        <p class="mg-b-10">@lang('dashboard.status')</p>
                        <input type="text"   value="{{trans('dashboard.status_'. $order->status)}}"disabled class="form-control" id="inputName" required>
                    </div>
                    <div class="form-group">
                        <p class="mg-b-10">@lang('dashboard.renting_duration')</p>
                        <input type="text"   value="{{$order->Contract()->exists() > 0 ? $order->Contract->Payments()->sum('renting_duration') : 0}} @if ($order->Product->Category->renting_duration == 0){{trans('dashboard.day')}}@elseif($order->Product->Category->renting_duration == 1){{trans('dashboard.month')}}@else{{trans('dashboard.year')}}@endif"disabled class="form-control" id="inputName" required>
                    </div>
                    <div class="form-group">
                        <p class="mg-b-10">@lang('dashboard.start_at')</p>
                        <input type="text"   value="{{ date('Y-m-d', strtotime($order->created_at))}}"disabled class="form-control" id="inputName" required>
                    </div>
                    <div class="form-group">
                        <p class="mg-b-10">@lang('dashboard.end_at')</p>
                        <input type="text"   value="{{$order->Contract()->exists() > 0 ? date('Y-m-d', strtotime($order->Contract->Payments->first()->end_at)) : ''}}"disabled class="form-control" id="inputName" required>
                    </div>
                    <div class="form-group">
                        <p class="mg-b-10">@lang('dashboard.result_code')</p>
                        <input type="text"   value="{{$order->result_code}}"disabled class="form-control" id="inputName" required>
                    </div>
                    <div class="form-group">
                        <p class="mg-b-10">@lang('dashboard.result_description')</p>
                        <input type="text"   value="{{$order->result_description}}"disabled class="form-control" id="inputName" required>
                    </div>
                    <div class="form-group">
                        <p class="mg-b-10">@lang('dashboard.notes')</p>
                        <textarea type="text"  class="form-control" id="inputName" disabled>{{$order->inquiry}}</textarea>
                    </div>
                    <div class="form-group">
                        <p class="mg-b-10">@lang('dashboard.main-photo')</p>
                        <div class="row">
                            <div class="col-md-3">
                                <img src="{{$order->Product->getFirstMediaUrl('main')}}" alt="">
                            </div>
                        </div>
                    </div>
                    @if($order->Contract()->exists())
                    <div class="form-group mb-0 mt-3 justify-content-end">
                        <div>
                            <a href="{{route('dashboard.payments.show', $order->Contract->id)}}" class="btn btn-success">@lang('dashboard.payments')</a>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    </div>
    </div>

@endsection
@section('js')


@endsection
