@extends('layouts.app')

@section('content')

  
<div class="col-md-8 m-auto">
    <h2>
        {{__('message.titre')}}
    </h2>
    <form method="POST" id="commandupdate" action="" enctype="multipart/form-data">
        @csrf
        <input type="hidden" class="form-control" value="{{$cmd->id}}" name="id" id="id">
        {{-- <input name="_token" value="{{csrf_token()}}">--}}
        @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                    </div>
                @endif    
                <div class="form-group">                        
                    <label for="exampleInputEmail1">{{__('message.image')}}</label>
                    <input type="file" class="form-control" name="image" id="image" aria-describedby="emailHelp">
                    @error('image')
                      <div class="alert alert-danger" role="alert">
                          {{$message}}
                      </div>
                    @enderror
                  </div>
        <div class="form-group">                        
              <label for="exampleInputEmail1">{{__('message.name_en')}}</label>
              <input type="text" class="form-control" value="{{$cmd->name_en}}" name="name_en" id="name_en" aria-describedby="emailHelp">
              @error('name_en')
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
              @enderror
            </div>
            <div class="form-group">                        
                <label for="exampleInputEmail1">{{__('message.name_ar')}}</label>
                <input type="text" class="form-control" value="{{$cmd->name_ar}}" name="name_ar" id="name_ar" aria-describedby="emailHelp">
                @error('name_ar')
                  <div class="alert alert-danger" role="alert">
                      {{$message}}
                  </div>
                @enderror
              </div>
            <div class="form-group">
                <label for="exampleInputEmail1">{{__('message.price')}}</label>
                <input type="text" class="form-control" value="{{$cmd->price}}" name="price"  id="price" aria-describedby="emailHelp">
                @error('price')
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
              @enderror
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">{{__('message.details_en')}}</label>
                <input type="text" class="form-control" value="{{$cmd->details_en}}" name="details_en"  id="details_en" aria-describedby="emailHelp">
                @error('details_en')
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
              @enderror
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">{{__('message.details_ar')}}</label>
                <input type="text" class="form-control" value="{{$cmd->details_ar}}" name="details_ar"  id="details_ar" aria-describedby="emailHelp">
                @error('details_ar')
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
              @enderror
              </div>
            <button id="update_cmd" class="btn btn-primary">{{__('message.Submit')}}</button>
          </form>
          <div class="alert alert-danger" role="alert" id="msg" style="display: none">
            dakchi dzad akhouya 5/5
        </div>
    </div>
    
@endsection

@section('scripts')
    <script>
        $(document).on('click', '#update_cmd', function(e){
            e.preventDefault();

            var formD = new FormData($('#commandupdate')[0]);
            
            $.ajax({
                type : 'post',
                enctype :'multipart/form-data',
                url : "{{route('ajax-command.update')}}",
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

                }
            });
        });
       
    </script>
    
@endsection