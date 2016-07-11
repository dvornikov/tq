<!DOCTYPE html>
<html>
    <head>
        <title>A test questions for Rivasense</title>
        <!-- Bootstrap CSS served from a CDN -->
        <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="content">

                <p>
                    <a href="{{ route('tickets.index') }}" class="btn btn-info">{{ trans('tq::messages.home' )}}</a>
                    <a href="{{ route('tickets.create') }}" class="btn btn-info">{{ trans('tq::messages.create') }}</a>

                    @foreach( Config::get('app.languages') as $lang )
                        <a href="{{ url($lang. '/tickets') }}" class="btn btn-info">{{ $lang }}</a>
                    @endforeach
                </p>

                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </div>

        <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/g/jquery.formvalidation@0.6.1(js/formValidation.min.js+js/framework/bootstrap.min.js)"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>
    </body>
</html>
