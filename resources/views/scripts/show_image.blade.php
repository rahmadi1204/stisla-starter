<script>
    function showImage(id, img, name) {
        console.log(img);
        $(this).addClass("clicked");
        let options = {
            'backdrop': 'dinamis'
        };
        $('#modal-img').modal(options)
        $(".clicked").removeClass("clicked");
        $("#modal-show-name").text(name);
        $("#modal-show-image").attr('src', '{{ asset('/storage/images') }}/' + img);
    }

    $(".zoomImage").click(function(e) {
        e.preventDefault();
        $(this).addClass("clicked");
        let options = {
            'backdrop': 'dinamis'
        };
        let img = $(".clicked").attr('src');
        $('#modal-img').modal(options)
        $(".clicked").removeClass("clicked");
        $("#modal-show-image").attr('src', img);
    });
</script>
