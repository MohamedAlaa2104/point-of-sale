@extends('dashboard.layouts.master')
@section('title', __('dashboard.settings'))
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
                <h4 class="content-title mb-0 my-auto">@lang('dashboard.main')</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('dashboard.settings')</span>
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
                        <h6 class="card-title mb-1">@lang('dashboard.settings')</h6>
                        <p class="text-muted card-sub-title"></p>
                    </div>
                    <form method="POST" action="{{route('dashboard.settings.update', $settings->id)}}" class="form-horizontal" enctype="multipart/form-data" >
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.name_en')</p>
                            <input type="text" name="name_en" value="{{$settings->name_en}}" class="form-control" id="inputName" required>
                        </div>
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.name_ar')</p>
                            <input type="text" name="name_ar" value="{{$settings->name_ar}}" class="form-control" id="inputName" required>
                        </div>
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.keywords_en')</p>
                            <input type="text" name="keywords_en" value="{{$settings->keywords_en}}" class="form-control" id="inputName" required>
                        </div>
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.keywords_ar')</p>
                            <input type="text" name="keywords_ar" value="{{$settings->keywords_ar}}" class="form-control" id="inputName" required>
                        </div>
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.description_en')</p>
                            <textarea type="text" name="description_en" class="form-control" id="inputName" required>{{$settings->description_en}}</textarea>
                        </div>
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.description_ar')</p>
                            <textarea type="text" name="description_ar" class="form-control" id="inputName" required>{{$settings->description_ar}}</textarea>
                        </div>
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.email')</p>
                            <input type="text" name="email" value="{{$settings->email}}" class="form-control" id="inputName" required>
                        </div>
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.phone')</p>
                            <input type="text" name="phone" value="{{$settings->phone}}" class="form-control" id="inputName" required>
                        </div>
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.website_link')</p>
                            <input type="text" name="website_link" value="{{$settings->website_link}}" class="form-control" id="inputName" required>
                        </div>
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.address_ar')</p>
                            <input type="text" name="address_ar" value="{{$settings->address_ar}}" class="form-control" id="inputName" required>
                        </div>
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.address_en')</p>
                            <input type="text" name="address_en" value="{{$settings->address_en}}" class="form-control" id="inputName" required>
                        </div>
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.facebook')</p>
                            <input type="text" name="facebook" value="{{$settings->facebook}}" class="form-control" id="inputName" required>
                        </div>
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.twitter')</p>
                            <input type="text" name="twitter" value="{{$settings->twitter}}" class="form-control" id="inputName" required>
                        </div>
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.instagram')</p>
                            <input type="text" name="instagram" value="{{$settings->instagram}}" class="form-control" id="inputName" required>
                        </div>
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.youtube')</p>
                            <input type="text" name="youtube" value="{{$settings->youtube}}" class="form-control" id="inputName" required>
                        </div>
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.linkedin')</p>
                            <input type="text" name="linkedin" value="{{$settings->linkedin}}" class="form-control" id="inputName" required>
                        </div>
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.map')</p>
                            <textarea type="text" name="map" class="form-control" id="inputName" required>{{$settings->map}}</textarea>
                        </div>
{{--                        <div class="mg-b-20 row">--}}
{{--                            <div class="col-sm-12 col-md-4">--}}
{{--                                <p class="mg-b-10">@lang('dashboard.logo_en')</p>--}}
{{--                                <input type="file" name="logo_en" class="dropify" data-height="200" />--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-12 col-md-4">--}}
{{--                                @if ($settings->getFirstMediaUrl('logo_en'))--}}
{{--                                    <img style="width: 50%;" src="{{$settings->getFirstMediaUrl('logo_en')}}" alt="{{$settings->name_en}}">--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="mg-b-20 row">--}}
{{--                            <div class="col-sm-12 col-md-4">--}}
{{--                                <p class="mg-b-10">@lang('dashboard.logo_ar')</p>--}}
{{--                                <input type="file" name="logo_ar" class="dropify" data-height="200" />--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-12 col-md-4">--}}
{{--                                @if ($settings->getFirstMediaUrl('logo_ar'))--}}
{{--                                    <img style="width: 50%;" src="{{$settings->getFirstMediaUrl('logo_ar')}}" alt="{{$settings->name_en}}">--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="form-group mb-0 mt-3 justify-content-end">
                            <div>
                                <button type="submit" class="btn btn-success">@lang('dashboard.edit')</button>
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
