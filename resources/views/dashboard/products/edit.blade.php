@extends('dashboard.layouts.master')
@section('title', __('dashboard.edit_product'))
@section('css')
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css')}}">
    <!---Internal Fileupload css-->
    <link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
    <!---Internal Fancy uploader css-->
    <link href="{{URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">@lang('dashboard.main')</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('dashboard.products')</span>
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
                        <h6 class="card-title mb-1">@lang('dashboard.edit_product')</h6>
                        <p class="text-muted card-sub-title"></p>
                    </div>
                    <form method="POST" action="{{route('dashboard.products.update', $product->id)}}" class="form-horizontal" enctype="multipart/form-data" >
                        @csrf
                        @method('PUT')

                        <div class=" mg-b-15">
                            <p class="mg-b-10">@lang('dashboard.category')</p>
                            <select name="category_id" class="form-control " >
                                @foreach($categories as $category)
                                    <option {{$product->category_id == $category->id ? 'selected' : ''}} value="{{$category->id}}">
                                        {{$category->translate(app()->getLocale())->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        @foreach (config('translatable.locales') as $locale)

                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.' . $locale . '.name')</p>
                            <input type="text" name="{{$locale}}[name]" value="{{$product->translate( app()->getLocale() )->name}}" class="form-control" id="inputName" required>
                        </div>

                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.' . $locale . '.description')</p>
                            <textarea id="summernote_{{$locale}}" name="{{$locale}}[description]">{{$product->translate( app()->getLocale() )->description}}</textarea>
                            <script>
                                $('#summernote_{{$locale}}').summernote({
                                    tabsize: 2,
                                    height: 250
                                });
                            </script>
                        </div>

                        @endforeach

                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.buy_price')</p>
                            <input type="number" name="buy_price" value="{{$product->buy_price}}" class="form-control" id="inputName" required>
                        </div>

                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.sell_price')</p>
                            <input type="number" name="sell_price" value="{{$product->sell_price}}" class="form-control" id="inputName" required>
                        </div>

                        <div class="form-group">
                            <p class="mg-b-10">@lang('dashboard.stock')</p>
                            <input type="number" name="stock" value="{{$product->stock}}" class="form-control" id="inputName" required>
                        </div>

                        <div class="main-toggle-group-demo mg-t-20 mg-b-10">
                            <p class="mg-b-10 mg-l-10">@lang('dashboard.active')</p>
                            <div id="active-switch" class="mg-x-20 main-toggle main-toggle-success {{$product->active  ? 'on' : ''}}">
                                <span></span>
                            </div>
                        </div>

                        <div class="mg-b-20 row">
                            <div class="col-sm-12 col-md-4">
                                <p class="mg-b-10">@lang('dashboard.main-photo')</p>
                                <input type="file" name="mainImg" class="dropify" data-height="200" />
                            </div>
                            <div class="col-sm-12 col-md-4">
                                @if ($product->getFirstMediaUrl('main'))
                                    <img style="width: 50%;" src="{{$product->getFirstMediaUrl('main')}}" alt="{{$product->name_en}}">
                                @endif
                            </div>
                        </div>
{{--                        <div class="mg-b-20">--}}
{{--                            <p class="mg-b-10">@lang('dashboard.photos')</p>--}}
{{--                            <div class="col-sm-12 col-md-8">--}}
{{--                                <input type="file" name="imgs[]" class="dropify" data-height="200"  multiple/>--}}
{{--                            </div>--}}
{{--                            <div class="mg-t-10 row">--}}
{{--                                @if ($product->getFirstMediaUrl())--}}
{{--                                    @foreach($product->getMedia() as $row)--}}
{{--                                        <div class="col-sm-12 col-md-4 mg-b-20">--}}
{{--                                            <img style="width: 50%;" src="{{$row->getUrl()}}" alt="{{$product->name_en}}">--}}
{{--                                        </div>--}}
{{--                                    @endforeach--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="form-group mb-0 mt-3 justify-content-end">
                            <div>
                                <button type="submit" class="btn btn-success">@lang('dashboard.edit')</button>
                            </div>
                        </div>
                        <input type="hidden" name="active" value="{{$product->active}}">
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

        $('#featured-switch').on('click', function() {
            if($(this).hasClass('on')){
                $(this).removeClass('on');
                $('input[name="featured"]').val(0);
            }else{
                $(this).addClass('on');
                $('input[name="featured"]').val(1);
            }
        });
    </script>
@endsection
