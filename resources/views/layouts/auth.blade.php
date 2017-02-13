<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="{{ url('piyes/favicon.ico') }}" /> 
    
    @yield('title')
    
    <link href="{{ url('piyes/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('piyes/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ url('piyes/css/animate.css') }}" rel="stylesheet">
    <link href="{{ url('piyes/css/style.css') }}" rel="stylesheet">
    <link href="{{ url('css/piyes.css') }}" rel="stylesheet">
</head>

<body class="gray-bg">
    <div class="loginColumns animated fadeInDown">
        @yield('content')
        <hr/>
        <div class="row">
            <div class="col-md-6">
                tallrye
            </div>
            <div class="col-md-6 text-right">
               <small>© 2017</small>
            </div>
        </div>
    </div>
</body>
</html>
