@extends('dashboard.layouts.master')
@section('title', __('dashboard.orders'))
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
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header pb-4 border-bottom ">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">@lang('dashboard.orders')</h4>
                    </div>
                </div>
                <div class="card-body">

                    <div class=" mg-b-15">
                        <p class="mg-b-10">@lang('dashboard.category')</p>
                        <select id="category" class="form-control" >
                            <option value="">@lang('dashboard.select_category')</option>
                            @foreach($categories as $category)
                                <option data-id="{{$category->id}}">
                                    {{$category->translate(app()->getLocale())->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="table-responsive mt-5">
                        <table class="table text-md-nowrap" id="products-table">
                            <thead>
                            <tr>
                                <th class="wd-5p border-bottom-0"> # </th>
                                <th class="wd-15p border-bottom-0"> @lang('dashboard.name') </th>
                                <th class="wd-15p border-bottom-0">@lang('dashboard.sell_price')</th>
                                <th class="wd-15p border-bottom-0">@lang('dashboard.stock')</th>
                                <th class="wd-15p border-bottom-0">@lang('dashboard.action')</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-header pb-4 border-bottom ">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">@lang('dashboard.invoice')</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0"> @lang('dashboard.name') </th>
                                <th class="wd-15p border-bottom-0">@lang('dashboard.number')</th>
                                <th class="wd-10p border-bottom-0">@lang('dashboard.price')</th>
                                <th class="wd-10p border-bottom-0">@lang('dashboard.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr></tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <!--/div-->
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
    <!--Internal  Sweet-Alert js-->
    <script src="{{URL::asset('assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/sweet-alert/jquery.sweet-alert.js')}}"></script>
    <!-- Sweet-alert js  -->
    <script src="{{URL::asset('assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/sweet-alert.js')}}"></script>
    <script>

        $('#products-table').DataTable({
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_',
            },
            processing:true,
            serverside:true,
            ajax: '{!! route('dashboard.orders.products-table') !!}',
            columns: [
                {data: 'DT_RowIndex', name:'DT_RowIndex'},
                {data: 'translation.name', name:'translation.name'},
                {data: 'sell_price', name:'sell_price'},
                {data: 'stock', name:'stock'},
                {data: 'button', name:'button'},
            ]
        });
    </script>
    <script>
        $(document).ready(function (){
           $('#category').on('change', function (){
               var cat_id = $('#category option:selected').data('id');
               var table = $('#products-table');

               table.DataTable().clear().destroy();

               table.DataTable({
                    language: {
                        searchPlaceholder: 'Search...',
                        sSearch: '',
                        lengthMenu: '_MENU_',
                    },
                    processing:true,
                    serverside:true,
                    ajax: '{!! route('dashboard.orders.products-table') !!}?category_id=' + cat_id,
                    columns: [
                        {data: 'DT_RowIndex', name:'DT_RowIndex'},
                        {data: 'translation.name', name:'translation.name'},
                        {data: 'sell_price', name:'sell_price'},
                        {data: 'stock', name:'stock'},
                        {data: 'button', name:'button'},
                    ]
                });
           });

            $('#products-table').on('click', 'a', function(){
               var id = $(this).data('id');
               var name = $(this).data('name');
               var price = $(this).data('price');

               html =   `<tr>
                            <td>${name}</td>
                            <td>
                                 <div class="form-group">
                                    <input type="number"  min="1" value="1" class="form-control">
                                </div>
                            </td>
                            <td>${price}</td>
                            <td><button class="btn btn-danger btn-sm delete-product"><i class="las la-trash-alt"></i></button></td>
                        </tr>`;
               $('#example1 tbody').append(html);
            });

            $('#example1').on('click', '.delete-product', function(){
                $(this).closest('tr').remove();
            });
        });

    </script>
@endsection
