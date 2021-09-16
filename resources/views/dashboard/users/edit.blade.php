@extends('dashboard.layouts.master')
@section('title', __('dashboard.users'))
@section('css')
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css')}}">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">@lang('dashboard.manage-users')</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('dashboard.users')</span>
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
                        <h6 class="card-title mb-1">@lang('dashboard.edit_user')</h6>
                        <p class="text-muted card-sub-title"></p>
                    </div>
                    <form method="POST" action="{{route('dashboard.users.update', $user->id)}}" class="form-horizontal">
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
                        <div class=" mg-b-10 mg-lg-b-0 ">
                            <p class="mg-b-10">@lang('dashboard.roles')</p>
                            <select name="role[]" class="form-control select2" >
                                @foreach($roles as $id=>$name)
                                    <option value="{{$id}}" {{$user->hasRole($name) ? 'selected': ''}}>
                                        {{$name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.password')</p>
                            <input type="password" name="password" class="form-control" id="inputName">
                        </div>
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.confirm-password')</p>
                            <input type="password" name="password_confirmation" class="form-control" id="inputName">
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
@endsection
