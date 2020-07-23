@extends('layouts.app')

@section('content')

  
<div class="col-md-8 m-auto">
    <h2>
      المستضفيات
    </h2>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Title</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($doctors) && $doctors->count() > 0)
                @foreach ($doctors as $item)  
                    <tr>
                        <td scope="row">{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->title}}</td>
                        <td>
                        <a href="{{route('Services.doc',$item->id)}}" class="btn btn-success">Services doctor</a>
                        </td>
                    </tr>
                @endforeach  
            @endif
        </tbody>
    </table>
 </div>
    
@endsection