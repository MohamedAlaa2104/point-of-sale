@extends('dashboard.layouts.master')
@section('title', __('dashboard.contact_us'))
@section('css')
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css')}}">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">@lang('dashboard.main')</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('dashboard.contact_us')</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h6 class="card-title mb-1">@lang('dashboard.contact_us')</h6>
                        <p class="text-muted card-sub-title"></p>
                    </div>

                    <div class="form-group">
                        <p class="mg-b-10">@lang('dashboard.name')</p>
                        <input type="text"  value="{{$message->name}}" disabled class="form-control" id="inputName" required>
                    </div>
                    <div class="form-group">
                        <p class="mg-b-10">@lang('dashboard.email')</p>
                        <input type="text"  value="{{$message->email}}" disabled class="form-control" id="inputName" required>
                    </div>
                    <div class="form-group">
                        <p class="mg-b-10">@lang('dashboard.subject')</p>
                        <input type="text"  value="{{$message->subject}}" disabled class="form-control" id="inputName" required>
                    </div>
                    <div class="form-group">
                        <p class="mg-b-10">@lang('dashboard.phone')</p>
                        <input type="text" value="{{$message->phone}}" disabled class="form-control" id="inputName" required>
                    </div>
                    <div class="form-group">
                        <p class="mg-b-10">@lang('dashboard.message')</p>
                        <textarea type="text" class="form-control" rows="10" disabled id="inputName" required>{{$message->message}}</textarea>
                    </div>

                </div>
            </div>
        </div>
    </div>

    </div>
    </div>

@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{URL::asset('assets/js/advanced-form-elements.js')}}"></script>
    <script src="{{URL::asset('assets/js/select2.js')}}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js')}}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{URL::asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fileuploads/js/file-upload.js')}}"></script>
@endsection
