@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="alert alert-success" id="success_msg" style="display: none;">
            تم  التحديث بنجاح
        </div>

        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                   Edit your offer

                </div>
                
                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <br>
                <form method="POST"  id="offerFormUpdate" action="" enctype="multipart/form-data">
                    @csrf
                    {{-- <input name="_token" value="{{csrf_token()}}"> --}}
                    
                    {{--  لاني محتجاه حتى اعرف اي صف تم التعديل بيه ولكن لا اريد اظهاره للكل --}}
                    <input type="text" style="display: none;" class="form-control" value="{{$offer -> id}}" name="offer_id">


                    <div class="form-group">
                        <label >أختر صوره العرض</label>
                        <input type="file" id="file" class="form-control" name="photo">
                        @error('photo')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label >Offer Name </label>
                        <input type="text" class="form-control" value="{{$offer -> name}}" name="name"
                               placeholder="Offer Name">
                        @error('name')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                   
                  

                    <div class="form-group">
                        <label >Offer Price</label>
                        <input type="text" class="form-control" value="{{$offer -> price}}" name="price"
                               placeholder="Offer Price">
                        @error('price')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                   

                    <div class="form-group">
                        <label for="">Offer details </label>
                        <input type="text" class="form-control" value="{{$offer -> details}}" name="details"
                               placeholder="Offer details">
                        @error('details')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <button id="update_offer" class="btn btn-primary">Save Offer</button>
                </form>


            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(document).on('click', '#update_offer', function (e) {
            e.preventDefault();
            var formData = new FormData($('#offerFormUpdate')[0]);
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route('ajax.offers.update')}}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if(data.status == true){
                        $('#success_msg').show();
                    }
                }, error: function (reject) {
                }
            });
        });
    </script>
@stop
