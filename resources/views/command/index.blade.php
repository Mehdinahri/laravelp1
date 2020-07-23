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
                        <th>{{__('message.operation')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($commands as $cmd)
                        <tr>
                            <td scope="row">{{$cmd -> id}}</td>
                                <td>{{$cmd -> name}}</td>
                                <td>{{$cmd -> price}}</td>
                                <td>{{$cmd -> details}}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{url('/commands/edit/'.$cmd -> id)}}" role="button">
                                        {{__('message.modifier')}}
                                    </a>
                                    <a class="btn btn-danger" href="{{route('command.delete',$cmd -> id)}}" role="button">
                                        {{__('message.delete')}}
                                    </a>
                                </td>
                            </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </body>
</html>
