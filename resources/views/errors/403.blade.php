<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Piyes | 404 Error</title>

    <link href="{{ url('public/piyes/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('public/piyes/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ url('public/piyes/css/animate.css') }}" rel="stylesheet">
    <link href="{{ url('public/piyes/css/style.css') }}" rel="stylesheet">

</head>

<body class="gray-bg">


    <div class="middle-box text-center animated fadeInDown">
        <h1>403</h1>
        <h3 class="font-bold">Not Authorized</h3>

        <div class="error-desc">
            Sorry, but you have no permission to view this page. If this is a mistake, please contact to your manager.
            <br>
            <br>
            <a class="btn btn-primary" href="{{ route('piyes.home') }}"><i class="fa fa-home"></i> Go To Homepage</a>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ url('public/piyes/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ url('public/piyes/js/bootstrap.min.js') }}"></script>

</body>

</html>
