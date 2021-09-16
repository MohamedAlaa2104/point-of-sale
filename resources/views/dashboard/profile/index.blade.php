@extends('dashboard.layouts.master')
@section('title', __('dashboard.users'))
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
                <h4 class="content-title mb-0 my-auto">@lang('dashboard.manage-users')</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('dashboard.profile')</span>
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
                    @include('dashboard.partials.alerts')
                    <div>
                        <h6 class="card-title mb-1">@lang('dashboard.profile')</h6>
                        <p class="text-muted card-sub-title"></p>
                    </div>
                    <form method="POST" action="{{route('dashboard.users.profile')}}" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.name')</p>
                            <input type="text" name="name" value="{{$user->name}}" class="form-control" id="inputName" required>
                        </div>
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.email')</p>
                            <input type="email" name="email" value="{{$user->email}}" class="form-control" id="inputName" required>
                        </div>
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.password')</p>
                            <input type="password" name="password" class="form-control" id="inputName">
                        </div>
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.confirm-password')</p>
                            <input type="password" name="password_confirmation" class="form-control" id="inputName">
                        </div>
                        <div class="mg-b-20 row">
                            <div class="col-sm-12 col-md-4">
                                <p class="mg-b-10">@lang('dashboard.main-photo')</p>
                                <input type="file" name="mainImg" class="dropify" data-height="200" />
                            </div>
                            <div class="col-sm-12 col-md-4">
                                @if ($user->getFirstMediaUrl('avatar'))
                                    <img style="width: 50%;" src="{{$user->getFirstMediaUrl('avatar')}}" alt="{{$user->name}}">
                                @endif
                            </div>
                        </div>
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
