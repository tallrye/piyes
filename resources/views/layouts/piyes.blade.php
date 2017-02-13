<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="{{ url('piyes/favicon.ico') }}" /> 
    @yield('title')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ url('piyes/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('piyes/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{ url('piyes/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ url('piyes/css/plugins/select2/select2.min.css') }}" rel="stylesheet">

    <!-- Gritter -->
    <link href="{{ url('piyes/js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet">
    <link href="{{ url('piyes/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">

    <link href="{{ url('piyes/css/animate.css') }}" rel="stylesheet">
    <link href="{{ url('piyes/css/style.css') }}" rel="stylesheet">
    <link href="{{ url('css/piyes.css') }}" rel="stylesheet">

    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
        var globalBaseUrl ='<?php echo url('/'); ?>';
    </script>
    @yield('styles')
</head>

<body class="{{ auth()->user()->settings->isSidebarClosed ? 'mini-navbar' : '' }}">
    <div id="wrapper">
        @include('piyes.includes.side-nav')

        <div id="page-wrapper" class="gray-bg dashbard-1">
            @include('piyes.includes.top-bar')
            <!-- Page Content -->
            @yield('content')
            <!-- End Page Content -->
        </div>
        

        @include('piyes.includes.right-tabs')
    </div>

    <!-- Mainly scripts -->
    <script src="{{ url('piyes/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ url('piyes/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('piyes/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ url('piyes/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ url('piyes/js/plugins/dataTables/datatables.min.js') }}"></script>

    <!-- Flot -->
    <script src="{{ url('piyes/js/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ url('piyes/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ url('piyes/js/plugins/flot/jquery.flot.spline.js') }}"></script>
    <script src="{{ url('piyes/js/plugins/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ url('piyes/js/plugins/flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ url('piyes/js/plugins/flot/jquery.flot.symbol.js') }}"></script>
    <script src="{{ url('piyes/js/plugins/flot/jquery.flot.time.js') }}"></script>
    <script src="{{ url('piyes/js/plugins/flot/curvedLines.js') }}"></script>

    <!-- Summernote -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>

    <!-- Select2 -->
    <script src="{{ url('piyes/js/plugins/select2/select2.full.min.js') }}"></script>

    <!-- Peity -->
    <script src="{{ url('piyes/js/plugins/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ url('piyes/js/demo/peity-demo.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ url('piyes/js/inspinia.js') }}"></script>
    <script src="{{ url('piyes/js/plugins/pace/pace.min.js') }}"></script>

    <!-- Touch Punch - Touch Event Support for jQuery UI -->
    <script src="{{ url('piyes/js/plugins/touchpunch/jquery.ui.touch-punch.min.js') }}"></script>

    <!-- GITTER -->
    <script src="{{ url('piyes/js/plugins/gritter/jquery.gritter.min.js') }}"></script>

    <!-- Sparkline -->
    <script src="{{ url('piyes/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Sparkline demo data  -->
    <script src="{{ url('piyes/js/demo/sparkline-demo.js') }}"></script>

    <!-- ChartJS-->
    <script src="{{ url('piyes/js/plugins/easypiechart/jquery.easypiechart.js') }}"></script>

    <!-- Toastr -->
    <script src="{{ url('piyes/js/plugins/toastr/toastr.min.js') }}"></script>

    
    <script src="{{ url('js/piyes.js') }}"></script>
    

    @if(Session::has('success') || Session::has('danger'))
    <script>
        @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @elseif(Session::has('danger'))
            toastr.error("{{ Session::get('danger') }}");
        @endif
    </script>
    @endif
    @yield('scripts')
    
</body>
</html>
