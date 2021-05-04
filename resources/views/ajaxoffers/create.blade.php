@extends('layouts.app')
@section('content')
<div class="container mt-5 text-center">

    <div class="alert alert-success" id="success_msg" style="display: none;">
        تم الحفظ بنجاح
    </div>

    <div class="title m-b-md mb-5">
        <h1>Add your offer</h1>
    </div>

    <form action="" id="offerForm" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-5">
            <label for="photo" class="form-label">Offer Photo</label>
            <input type="file" class="form-control" name="photo" placeholder="Offer Photo" id="photo">
            @error('photo')
                <small class="form-text text-danger">{{$message}}</small>
            @enderror
        </div>

        <div class="mb-5">
            <label for="offername" class="form-label">Offer Name</label>
            <input type="text" class="form-control" name="name" placeholder="Offer Name" id="offername">
            @error('name')
                <small class="form-text text-danger">{{$message}}</small>
            @enderror
        </div>

        <div class="mb-5">
            <label for="offerprice" class="form-label">Offer Price</label>
            <input type="text" class="form-control" name="price" placeholder="Offer Price" id="offerprice">
            @error('price')
                <small class="form-text text-danger">{{$message}}</small>
            @enderror
        </div>

        <div class="mb-5">
            <label for="offerdetails" class="form-label">Offer Details</label>
            <input type="text" class="form-control" name="details" placeholder="Offer Details" id="offerdetails">
            @error('details')
                <small class="form-text text-danger">{{$message}}</small>
            @enderror
        </div>

        <button id="save_offer" class="btn btn-primary">Save Offer</button>
    </form>
</div>
@stop

@section('scripts')
    <script>

        $(document).on('click', '#save_offer', function(e) {
            e.preventDefault();

            var formData = new FormData($('#offerForm')[0])

            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route('ajax.offers.store')}}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if(data.status == true)
                        $('#success_msg').show();
                }, error: function (reject) {

                }
            });
        });



    </script>
    {{-- <script>

        $(document).on('click', '#save_offer', function (e) {
            e.preventDefault();

            $('#photo_error').text('');
            $('#name_ar_error').text('');
            $('#name_error').text('');
            $('#price_error').text('');
            $('#details_ar_error').text('');
            $('#details_error').text('');
            var formData = new FormData($('#offerForm')[0]);

            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route('ajax.offers.store')}}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {

                    if (data.status == true) {
                        $('#success_msg').show();
                    }


                }, error: function (reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, val) {
                        $("#" + key + "_error").text(val[0]);
                    });
                }
            });
        });


    </script> --}}
@stop

