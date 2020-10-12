<script>
    // tostr message 
    @if(Session::has('success'))
    iziToast.success({
        title: '{{Session::get('success')}}',
        message: '',
        position: 'topRight'
    });
    @endif
    @if(Session::has('warning'))
    iziToast.warning({
        // title: 'Hello, world!',
        title: '{{Session::get('warning')}}',
        position: 'topRight'
    });
    @endif
    @if(Session::has('error'))
    iziToast.error({
        // title: 'Hello, world!',
        title: '{{Session::get('error')}}',
        position: 'topRight'
    });
    @endif
    //sidebar css setting
    @if(Helper::sidebar())
    jQuery("body").addClass("{{Helper::sidebar()}}");
    @endif

</script>
