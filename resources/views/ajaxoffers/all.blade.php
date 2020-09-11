@extends('layouts.app')

@section('content')

    <div class="alert alert-success" id="success_msg" style="display: none;">
        تم الحفظ بنجاح
    </div>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Offer Name</th>
            <th scope="col">Offer Price</th>
            <th scope="col">Offer details</th>
            <th scope="col"> Offer picture</th>

            <th scope="col">operation</th>
        </tr>
        </thead>
        <tbody>


        @foreach($offers as $offer)
        <tr class="offerRow{{$offer -> id}}">    {{--  قمنا بوضع كلاس حتى لما يحذف السطر يحذف الرقم تبعه وما يعطيه للصف الي وراه --}}
                <th scope="row">{{$offer -> id}}</th>
                <td>{{$offer -> name}}</td>
                <td>{{$offer -> price}}</td>
                <td>{{$offer -> details}}</td>
                <td><img  style="width: 90px; height: 90px;" src="{{asset('images/offers/'.$offer->photo)}}"></td>

                <td>
                    <a href="" offer_id="{{$offer -> id}}" id="delete_btn" class="delete_btn btn btn-danger"> delete</a>
                    <a href="{{route('ajax.offers.edit',$offer -> id)}}" class="btn btn-success"> edit</a>
                </td>

            </tr>
        @endforeach

        </tbody>



    </table>

@stop



@section('scripts')
    <script>
        // حطينا . يعني كلاس  لانو بختلف من صف لاخر 
        $(document).on('click', '#delete_btn', function (e) {
            e.preventDefault();
              var offer_id =  $(this).attr('offer_id');
            $.ajax({
                type: 'post',
                 url: "{{route('ajax.offers.delete')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id' :offer_id

                    // this id is exists in the data in the controller response
                },
                success: function (data) {
                    if(data.status == true){
                        $('#success_msg').show();
                    }
                    $('.offerRow'+data.id).remove();
                }, error: function (reject) {
                }
            });
        });
    </script>
@stop