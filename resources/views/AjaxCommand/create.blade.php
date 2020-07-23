@extends('layouts.app')

@section('content')

  
<div class="col-md-8 m-auto">
    <h2>
        {{__('message.titre')}}
    </h2>
    <form method="POST" id="commandform" action="" enctype="multipart/form-data">
        @csrf
        {{-- <input name="_token" value="{{csrf_token()}}">--}}
        @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                    </div>
                @endif    
                <div class="form-group">                        
                    <label for="exampleInputEmail1">{{__('message.image')}}</label>
                    <input type="file" class="form-control" name="image" id="image" aria-describedby="emailHelp">
                    <small id='image_error' class='form-test text-danger'></small>

                  </div>
        <div class="form-group">                        
              <label for="exampleInputEmail1">{{__('message.name_en')}}</label>
              <input type="text" class="form-control" name="name_en" id="name_en" aria-describedby="emailHelp">
              <small id='name_en_error' class='form-test text-danger'></small>
            </div>
            <div class="form-group">                        
                <label for="exampleInputEmail1">{{__('message.name_ar')}}</label>
                <input type="text" class="form-control" name="name_ar" id="name_ar" aria-describedby="emailHelp">
                <small id='name_ar_error' class='form-test text-danger'></small>

              </div>
            <div class="form-group">
                <label for="exampleInputEmail1">{{__('message.price')}}</label>
                <input type="text" class="form-control" name="price"  id="price" aria-describedby="emailHelp">
                <small id='price_error' class='form-test text-danger'></small>

              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">{{__('message.details_en')}}</label>
                <input type="text" class="form-control" name="details_en"  id="details_en" aria-describedby="emailHelp">
                <small id='details_en_error' class='form-test text-danger'></small>

              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">{{__('message.details_ar')}}</label>
                <input type="text" class="form-control" name="details_ar"  id="details_ar" aria-describedby="emailHelp">
                <small id='details_ar_error' class='form-test text-danger'></small>

              </div>
            <button id="save_cmd" class="btn btn-primary">{{__('message.Submit')}}</button>
          </form>
          <div class="alert alert-danger" role="alert" id="msg" style="display: none">
            dakchi dzad akhouya 5/5
        </div>
    </div>
    
@endsection

@section('scripts')
    <script>
        $(document).on('click', '#save_cmd', function(e){
            e.preventDefault();

            $("#name_ar_error").text('');
            $("#image_error").text('');
            $("#name_en_error").text('');
            $("#price_error").text('');
            $("#details_ar_error").text('');
            $("#details_en_error").text('');

            var formD = new FormData($('#commandform')[0]);
            
            $.ajax({
                type : 'post',
                enctype :'multipart/form-data',
                url : "{{route('ajax-command.store')}}",
                data : formD,
                processData : false,
                contentType : false,
                cache : false,
                success : function(data){
                    if (data.status == true) {
                        $('#msg').show();

                    }

                },
                error: function(reject){
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(key, val)
                    {
                        $("#"+key+"_error").text(val[0]);
                    })
                }
            });
        });
       
    </script>
    
@endsection