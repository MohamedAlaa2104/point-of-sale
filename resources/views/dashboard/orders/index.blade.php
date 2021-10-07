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
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">@lang('dashboard.orders')</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="products-table">
                            <thead>
                            <tr>
                                <th class="wd-5p border-bottom-0"> # </th>
                                <th class="wd-15p border-bottom-0"> @lang('dashboard.name') </th>
                                <th class="wd-15p border-bottom-0">@lang('dashboard.price')</th>
                                <th class="wd-10p border-bottom-0">@lang('dashboard.action')</th>
                            </tr>
                            </thead>
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
            ajax: '{!! route('dashboard.orders-table') !!}',
            columns: [
                {data: 'DT_RowIndex', name:'DT_RowIndex'},
                {data: 'client.name', name:'client.name'},
                {data: 'total_price', name:'total_price'},
                {data: 'action', name:'action'},
            ]
        });
    </script>

{{--    <script>--}}
{{--        function clickedButton(e) {--}}
{{--            var data = {--}}
{{--                "_token": "{{ csrf_token() }}",--}}
{{--                "id": e.attr('switch-id'),--}}
{{--                "type":e.attr('switch-type')--}}
{{--            }--}}
{{--            $.post( "{{ route('dashboard.ajax-buttons') }}", data)--}}
{{--                .done(function( data ) {--}}
{{--                    if (e.attr('switch-type') == 'active'){--}}
{{--                        if (data.active){--}}
{{--                            e.addClass('on');--}}
{{--                        }--}}
{{--                        if (data.active == 0){--}}
{{--                            e.removeClass('on');--}}
{{--                        }--}}
{{--                    }--}}

{{--                    if (e.attr('switch-type') == 'featured'){--}}
{{--                        if (data.featured){--}}
{{--                            e.addClass('on');--}}
{{--                        }--}}
{{--                        if (data.featured == 0){--}}
{{--                            e.removeClass('on');--}}
{{--                        }--}}
{{--                    }--}}

{{--                    swal({--}}
{{--                        title: "{{__('dashboard.done')}}",--}}
{{--                        text: "{{__('dashboard.your-request-has-been-applied')}}",--}}
{{--                        icon: "success",--}}
{{--                    });--}}
{{--                });--}}

{{--        }--}}
{{--    </script>--}}

    @if ($success = session()->get('success'))
        <script>
            swal({
                title: "{{__('dashboard.done')}}",
                text: "{{__('dashboard.your-request-has-been-applied')}}",
                icon: "success",
            });
        </script>
    @endif
@endsection
