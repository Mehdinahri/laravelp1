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
                <th>Adresse</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($hopital) && $hopital->count() > 0)
                @foreach ($hopital as $item)  
                    <tr>
                        <td scope="row">{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->Adresse}}</td>
                        <td>
                        <a href="{{route('hos.doctors',$item->id)}}" class="btn btn-success">show doctors</a>
                        <a href="{{route('delete.hos',$item->id)}}" class="btn btn-danger">delete Hopital</a>

                        </td>
                    </tr>
                @endforeach  
            @endif
        </tbody>
    </table>
 </div>
    
@endsection