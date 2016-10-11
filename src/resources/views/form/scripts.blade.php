{!! HTML::script('https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js') !!}
{!! HTML::script('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js') !!}
{!! HTML::script('https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.1/switchery.min.js') !!}

<script>
    $(".dropzone").each(function() {
        $(this).dropzone({ url: "/file/post" })
    });
</script>