@extends('dashboard.layouts.master')
@section('title', __('dashboard.applicants'))
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
                <h4 class="content-title mb-0 my-auto">@lang('dashboard.main')</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('dashboard.applicants')</span>
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
                        <h6 class="card-title mb-1">@lang('dashboard.applicants')</h6>
                        <p class="text-muted card-sub-title"></p>
                    </div>

                    <div class="form-group">
                        <p class="mg-b-10">@lang('dashboard.cv')</p>
                        <div class="p-1">
                            <a class="btn btn-success" target="_blank" href="{{route('dashboard.applicants.cv', $applicant->id)}}">@lang('dashboard.show')</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <p class="mg-b-10">@lang('dashboard.name')</p>
                        <input type="text"   value="{{$applicant->name}}" disabled class="form-control" id="inputName" required>
                    </div>
                    <div class="form-group">
                        <p class="mg-b-10">@lang('dashboard.email')</p>
                        <input type="text"   value="{{$applicant->email}}"disabled class="form-control" id="inputName" required>
                    </div>
                    <div class="form-group">
                        <p class="mg-b-10">@lang('dashboard.gender')</p>
                        <input type="text"   value="{{$applicant->gender == '1' ? 'Male' : 'Female'}}"disabled class="form-control" id="inputName" required>
                    </div>
                    <div class="form-group">
                        <p class="mg-b-10">@lang('dashboard.phone')</p>
                        <input type="text"   value="{{$applicant->phone}}"disabled class="form-control" id="inputName" required>
                    </div>

                    <div class="form-group">
                        <p class="mg-b-10">@lang('dashboard.message')</p>
                        <textarea type="text"  class="form-control" id="inputName" disabled>{{$applicant->message}}</textarea>
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
    <!--Internal Fancy uploader js-->
    <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fancyuploder/fancy-uploader.js')}}"></script>

@endsection
