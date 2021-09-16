@if (session()->has('done'))
    <script>
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: '{{session()->get('done')}}',
            timeout:1500,
        }).show();
    </script>
@endif