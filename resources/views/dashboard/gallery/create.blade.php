@extends('dashboard.layouts.master')
@section('title', __('dashboard.add_gallery'))
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
                <h4 class="content-title mb-0 my-auto">@lang('dashboard.main')</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('dashboard.gallery')</span>
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
                        <h6 class="card-title mb-1">@lang('dashboard.add_gallery')</h6>
                        <p class="text-muted card-sub-title"></p>
                    </div>
                    <form method="POST" action="{{route('dashboard.gallery.store')}}" class="form-horizontal" enctype="multipart/form-data" >
                        @csrf
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.name_en')</p>
                            <input type="text" name="name_en" value="{{old('name_en')}}" class="form-control" id="inputName" required>
                        </div>
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.name_ar')</p>
                            <input type="text" name="name_ar" value="{{old('name_ar')}}" class="form-control" id="inputName" required>
                        </div>
                        <div class="mg-b-20">
                            <p class="mg-b-10">@lang('dashboard.main-photo')</p>
                            <div class="col-sm-12 col-md-4">
                                <input type="file" name="mainImg" class="dropify" data-height="200" />
                            </div>
                        </div>
                        <div class="mg-b-20">
                            <p class="mg-b-10">@lang('dashboard.photos')</p>
                            <div class="col-sm-12 col-md-8">
                                <input type="file" name="imgs[]" class="dropify" data-height="200"  multiple/>
                            </div>
                        </div>
                        <div class="form-group mb-0 mt-3 justify-content-end">
                            <div>
                                <button type="submit" class="btn btn-success">@lang('dashboard.create')</button>
                            </div>
                        </div>
                    </form>
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
