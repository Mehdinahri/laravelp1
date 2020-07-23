@extends('layouts.app')

@section('content')

  
<div class="col-md-8 m-auto">
    <h2>
      إختصاص الدكتور
    </h2>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($services) && $services->count() > 0)
                @foreach ($services as $item)  
                    <tr>
                        <td scope="row">{{$item->id}}</td>
                        <td>{{$item->nom}}</td>
                    </tr>
                @endforeach  
            @endif
        </tbody>
    </table>
    <br>
    <form method="POST" action="{{route('add.service')}}">
        @csrf
        <div class="form-group">                        
            <label for="exampleInputEmail1">select doctor:</label>
            <select class="form-control" name="doctorid">
                @if(isset($doctors) && $doctors->count() > 0)
                    @foreach ($doctors as $item)  
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach  
                @endif
            </select>
        </div>
        <div class="form-group">                        
            <label for="exampleInputEmail1">select service:</label>
            <select multiple class="form-control" name="servicesid[]">
                @if(isset($service) && $service->count() > 0)
                    @foreach ($service as $item)  
                        <option value="{{$item->id}}">{{$item->nom}}</option>
                    @endforeach  
                @endif
            </select>
        </div>
        <div class="form-group">                        
            <button type="submit" class="btn btn-primary">Ajouter Service</button>
        </div>
    </form>

 </div>
    
@endsection