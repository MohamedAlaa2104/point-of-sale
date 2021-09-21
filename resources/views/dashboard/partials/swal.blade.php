@if ($swall = session()->get('swall'))
    <script>
        swal({
            title: "{{__('dashboard.done')}}",
            text: "{{$swall}}",
            icon: "success",
        });
    </script>
@endif