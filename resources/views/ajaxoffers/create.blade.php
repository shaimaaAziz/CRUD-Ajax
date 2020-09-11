@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="alert alert-success" id="success_msg" style="display: none;">
            تم الحفظ بنجاح
        </div>

        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    Add your offer

                </div>
                
                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <br>
                <form method="POST" id="offerForm" action="" enctype="multipart/form-data">
                    @csrf
                    {{-- <input name="_token" value="{{csrf_token()}}"> --}}


                    <div class="form-group">
                        <label >أختر صوره العرض</label>
                        <input type="file" id="file" class="form-control" name="photo">

                        <small id="photo_error" class="form-text text-danger"></small>
                    </div>


                    <div class="form-group">
                        <label >Offer Name</label>
                        <input type="text" class="form-control" name="name"
                               placeholder="Offer Name">
                               <small id="name_error" class="form-text text-danger"></small>

                    </div>



                    <div class="form-group">
                        <label >Offer Price</label>
                        <input type="text" class="form-control" name="price"
                               placeholder="Offer Price">
                        <small id="price_error" class="form-text text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label >Offer details</label>
                        <input type="text" class="form-control" name="details"
                               placeholder="Offer details">
                        <small id="details_error" class="form-text text-danger"></small>
                    </div>

                  
                    <button id="save_offer" class="btn btn-primary" >Save Offer</button>
                </form>


            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(document).on('click', '#save_offer', function (e) {
            e.preventDefault();
            $('#photo_error').text('');
            $('#name_error').text('');
            $('#price_error').text('');
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
    </script>
@stop
