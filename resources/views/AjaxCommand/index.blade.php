@extends('layouts.app')

@section('content')
<div class="col-md-8 m-auto">
    
    <div class="alert alert-danger" role="alert" id="msg" style="display: none">
        dakchi dzad akhouya 5/5
    </div>
    <h2>All Commands</h2>
                @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
            @endif   
            @if (Session::has('error'))
            <div class="alert alert-danger" role="alert">
                {{Session::get('error')}}
            </div>
        @endif   
            <table class="table mt-4">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{__('message.name_'.LaravelLocalization::getCurrentLocale())}}</th>
                        <th>{{__('message.price')}}</th>
                        <th>{{__('message.details_'.LaravelLocalization::getCurrentLocale())}}</th>
                        <th>image</th>
                        <th>{{__('message.operation')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($commands as $cmd)
                        <tr class="cmd{{$cmd -> id}}">
                            <td scope="row">{{$cmd -> id}}</td>
                                <td>{{$cmd -> name}}</td>
                                <td>{{$cmd -> price}}</td>
                                <td>{{$cmd -> details}}</td>
                                <td><img style="width: 200px" src="{{asset('images/command/'.$cmd -> image)}}" /></td>
                                <td>
                                    <a class="btn btn-primary" href="{{url('commands/edit/'.$cmd -> id)}}" role="button">
                                        {{__('message.modifier')}}
                                    </a>
                                    <a class="btn btn-danger" href="{{route('command.delete',$cmd -> id)}}" role="button">
                                        {{__('message.delete')}}
                                    </a>
                                    <button id="" cmdid="{{$cmd -> id}}" class="delete_ajax btn btn-danger">delete ajax</button>
                                    <a href="{{route('ajax-command.edit',$cmd -> id)}}" class="btn btn-success">edite ajax</a>

                                </td>
                            </tr>
                    @endforeach
                </tbody>
            </table>
</div>
@endsection

@section('scripts')
    <script>
        $(document).on('click', '.delete_ajax', function(e){

            e.preventDefault();

            var cmdid = $(this).attr('cmdid');

            $.ajax({
                type : 'post',
                enctype :'multipart/form-data',
                url : "{{route('ajax-command.delete')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": cmdid
                },
                success : function(data){
                    if (data.status == true) {
                        $('#msg').show();
                    }
                    $('.cmd'+data.cmdid).remove();

                },
                error: function(reject){

                }
            });
        });
       
    </script>
    
@endsection