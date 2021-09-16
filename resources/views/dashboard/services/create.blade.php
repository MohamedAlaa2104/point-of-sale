@extends('dashboard.layouts.master')
@section('title', __('dashboard.add_service'))
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
                <h4 class="content-title mb-0 my-auto">@lang('dashboard.main')</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('dashboard.services')</span>
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
                        <h6 class="card-title mb-1">@lang('dashboard.add_service')</h6>
                        <p class="text-muted card-sub-title"></p>
                    </div>
                    <form method="POST" action="{{route('dashboard.services.store')}}" class="form-horizontal" enctype="multipart/form-data" >
                        @csrf
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.name_en')</p>
                            <input type="text" name="name_en" value="{{old('name_en')}}" class="form-control" id="inputName" required>
                        </div>
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.name_ar')</p>
                            <input type="text" name="name_ar" value="{{old('name_ar')}}" class="form-control" id="inputName" required>
                        </div>
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.small_description_en')</p>
                            <textarea type="text" name="small_description_en" class="form-control" id="inputName" required>{{old('small_description_en')}}</textarea>
                        </div>
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.small_description_ar')</p>
                            <textarea type="text" name="small_description_ar" class="form-control" id="inputName" required>{{old('small_description_ar')}}</textarea>
                        </div>
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.description_en')</p>
                            <textarea type="text" name="description_en" class="form-control" id="inputName" required>{{old('description_en')}}</textarea>
                        </div>
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.description_ar')</p>
                            <textarea type="text" name="description_ar" class="form-control" id="inputName" required>{{old('description_ar')}}</textarea>
                        </div>
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.slider_phrase_en')</p>
                            <input type="text" name="slider_phrase_en" value="{{old('slider_phrase_en')}}" class="form-control" id="inputName" required>
                        </div>
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.slider_phrase_ar')</p>
                            <input type="text" name="slider_phrase_ar" value="{{old('slider_phrase_ar')}}" class="form-control" id="inputName" required>
                        </div>
                        <div class="main-toggle-group-demo mg-t-20 mg-b-10">
                            <p class="mg-b-10 mg-l-10">@lang('dashboard.active')</p>
                            <div id="active-switch" class="main-toggle main-toggle-success  mg-x-10 on">
                                <span></span>
                            </div>
                        </div>
                        <div class="mg-b-20">
                            <p class="mg-b-10">@lang('dashboard.main-photo')</p>
                            <div class="col-sm-12 col-md-4">
                                <input type="file" name="mainImg" class="dropify" data-height="200" />
                            </div>
                        </div>
                        <div class="mg-b-20">
                            <p class="mg-b-10">@lang('dashboard.cover-photo')</p>
                            <div class="col-sm-12 col-md-4">
                                <input type="file" name="coverImg" class="dropify" data-height="200" />
                            </div>
                        </div>
                        <div class="form-group mb-0 mt-3 justify-content-end">
                            <div>
                                <button type="submit" class="btn btn-success">@lang('dashboard.create')</button>
                            </div>
                        </div>
                        <input type="hidden" name="active" value="1">
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
    <script>
        $('#active-switch').on('click', function() {
            if($(this).hasClass('on')){
                $(this).removeClass('on');
                $('input[name="active"]').val(0);
            }else{
                $(this).addClass('on');
                $('input[name="active"]').val(1);
            }
        });

    </script>
@endsection
