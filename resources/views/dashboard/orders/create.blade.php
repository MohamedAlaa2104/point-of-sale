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
                            <option value="" selected>@lang('dashboard.select_category')</option>
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
                    <form action="{{ route('dashboard.order.store', ['customer_id'=>request()->customer_id] ) }}" method="POST">

                        @csrf

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

                        <div class="row">
                            <div class="col-sm-6">السعر الكلي</div>
                            <div class="col-sm-6" id="total-price" data-totalprice="0">0</div>
                            <div class="col-sm-12">
                                <button id="form-btn" class="btn btn-success btn d-none mt-5">@lang('dashboard.confirm')</button>
                            </div>
                        </div>
                    </form>


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

            $('#products-table').on('click', 'a', function(btn){
               var id = $(this).data('id');
               var name = $(this).data('name');
               var price = $(this).data('price');

               html =   `<tr class="products-row" data-id="${id}" data-price="${price}" data-total="${price}">
                            <input type="hidden" name="products[]" value="${id}">
                            <td>${name}</td>
                            <td>
                                 <div class="form-group">
                                    <input type="number" name="amount[]"  min="1" value="1" class="form-control product-amount">
                                </div>
                            </td>
                            <td id="product-${id}-price">${price}</td>
                            <td><button class="btn btn-danger btn-sm delete-product"><i class="las la-trash-alt"></i></button></td>
                        </tr>`;
               if (!checkRowExists(id)){

                   $('#example1 tbody').append(html);

               }
               $(this).css('display', 'none');
               calculateTotal();

            });

            $('#example1').on('click', '.delete-product', function(){
                var id = $(this).closest('tr').data('id');
                var price = $(this).closest('tr').data('price');
                var amount = $('input[name="product-'+ id + '"]').val();
                $('#btn-' + id).css('display', 'inline-block');
                $(this).closest('tr').remove();
                calculateTotal();
            });

            $('body').on('change', '.product-amount', function (){
                calculateTotal();
            });
        });

        function calculateTotal(){
            var totalPrice =0;
            $('.products-row').each(function (){
                var id = $(this).data('id');
                var amount = parseInt($(this).find('.product-amount').val());
                var price = parseInt($(this).data('price'));
                 totalPrice += amount*price;
                 $('#product-'+id+'-price').html(amount*price);
            });
            $('#total-price').html(totalPrice);
            if (totalPrice > 0){
                $('#form-btn').removeClass('d-none');
            }else {
                let btn = document.querySelector('#form-btn');
                btn.classList.add('d-none');
            }
        }

        function checkRowExists(newId){
            var value = 0;
            $('.products-row').each(function (){
                var id = $(this).data('id');
                if (parseInt(newId) === parseInt(id)){
                    return value = 1;
                }
            });
            return value;
        }

    </script>
@endsection
