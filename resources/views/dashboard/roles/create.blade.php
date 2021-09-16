@extends('dashboard.layouts.master')
@section('title', __('dashboard.roles'))
@section('css')
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    @if(LaravelLocalization::getCurrentLocale() == 'en')
    <link rel="stylesheet" href="{{URL::asset('assets/plugins/sumoselect/sumoselect.css')}}">
    @else
    <link rel="stylesheet" href="{{URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css')}}">
    @endif
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">@lang('dashboard.manage-users')</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('dashboard.roles')</span>
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
                        <h6 class="card-title mb-1">@lang('dashboard.create_new_role')</h6>
                        <p class="text-muted card-sub-title"></p>
                    </div>
                    <form method="POST" action="{{route('dashboard.roles.store')}}" class="form-horizontal">
                        @csrf
                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.name')</p>
                            <input type="text" name="name" class="form-control" id="inputName">
                        </div>
                        <div class=" mg-b-20 mg-lg-b-0">
                            <p class="mg-b-10">@lang('dashboard.permissions')</p>

                            <select name="permissions[]" multiple="multiple" class="testselect2">
                                @foreach($permissions as $id=>$name)
                                    <option value="{{$id}}">
                                        {{$name}}
                                    </option>
                                @endforeach
                            </select>


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
@endsection
