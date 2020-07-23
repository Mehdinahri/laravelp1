<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <nav class="navbar navbar-expand-sm navbar-light bg-light">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">{{__('message.Home')}} <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">{{__('message.Link')}} </a>
                        </li>
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li class="nav-item">
                            <a class="nav-link" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"> {{ $properties['native'] }} </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </nav>
            <div class="col-md-8 m-auto">
            <h2>
                {{__('message.titre')}}
            </h2>
            <form method="POST" action="{{route('commands.update',$cmd -> id)}}">
                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}">--}}
                @if (Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{Session::get('success')}}
                            </div>
                        @endif    
                <div class="form-group">                        
                      <label for="exampleInputEmail1">{{__('message.name_en')}}</label>
                      <input type="text" class="form-control" name="name_en" value="{{$cmd->name_en}}" id="name_en" aria-describedby="emailHelp">
                      @error('name_en')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                      @enderror
                    </div>
                    <div class="form-group">                        
                        <label for="exampleInputEmail1">{{__('message.name_ar')}}</label>
                        <input type="text" class="form-control" name="name_ar" id="name_ar" value="{{$cmd->name_ar}}" aria-describedby="emailHelp">
                        @error('name_ar')
                          <div class="alert alert-danger" role="alert">
                              {{$message}}
                          </div>
                        @enderror
                      </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('message.price')}}</label>
                        <input type="text" class="form-control" name="price"  id="price" value="{{$cmd->price}}" aria-describedby="emailHelp">
                        @error('price')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                      @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">{{__('message.details_en')}}</label>
                        <input type="text" class="form-control" name="details_en"  id="details_en" value="{{$cmd->details_en}}" aria-describedby="emailHelp">
                        @error('details_en')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                      @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">{{__('message.details_ar')}}</label>
                        <input type="text" class="form-control" name="details_ar"  id="details_ar" value="{{$cmd->details_ar}}" aria-describedby="emailHelp">
                        @error('details_ar')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                      @enderror
                      </div>
                    <button type="submit" class="btn btn-primary">{{__('message.modifier')}}</button>
                  </form>
            </div>
        </div>
    </body>
</html>
