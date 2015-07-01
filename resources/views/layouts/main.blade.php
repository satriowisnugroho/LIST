<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') &raquo; LIST</title>

    <link href='{{ asset("images/icon.png") }}' rel='SHORTCUT ICON'/>
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome/css/font-awesome.min.css') }}" />
    @if ($user->role == 'admin')
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/local.css') }}" />
    @else
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/css/bootstrap2.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/local2.css') }}" />
    @endif

    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.dataTables.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.bootstrap.css') }}" />

    <script type="text/javascript" src="{{ asset('js/jquery-1.10.2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dataTables.bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/natural.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-filestyle.js') }}"></script>
    <link href='http://fonts.googleapis.com/css?family=Cabin:400,500' rel='stylesheet' type='text/css'>

    <!-- include sweetAlert css and js -->
    <script src="{{ asset('js/sweet-alert.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweet-alert.css') }}">

    <!-- MORRIS CHART STYLES-->
    <link href="{{ asset('js/morris/morris-0.4.3.min.css') }}" rel="stylesheet" />
    
    @yield('head')

    <!-- you need to include the shieldui css and js assets in order for the charts to work -->
    <!--
    <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/shieldui-all.min.css" />
    <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light-bootstrap/all.min.css" />
    <script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
    <script type="text/javascript" src="http://prepbootstrap.com/Content/js/gridData.js"></script> 
    -->

    <script>
        $(document).ready(function() {
            $('#table').DataTable();
            var table = $('#table2').DataTable({
                "order": [[ 2, "desc" ]]
            });
        } );
    </script>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">            
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                @if ($user->role == 'admin')
                <a class="navbar-brand" href="{{ url('admin') }}"><img style="width:20px;float:left" src="{{ asset('images/icon.png') }}"> &nbsp; LIST - Library Information System</a>
                @else
                <a class="navbar-brand" href="{{ url('operator') }}"><img style="width:20px;float:left" src="{{ asset('images/icon.png') }}"> &nbsp; LIST - Library Information System</a>
                @endif
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">

                @yield('navbar')
                
                <ul class="nav navbar-nav navbar-right navbar-user">
                    <li class="dropdown user-dropdown">
                       <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ $user->name }}<b class="caret"></b></a>
                       <ul class="dropdown-menu">
                            @if ($user->role == 'admin')
                            <li><a href="{{ url('admin/profile') }}"><i class="fa fa-user"></i> Profile</a></li>
                            @else
                            <li><a href="{{ url('operator/profile') }}"><i class="fa fa-user"></i> Profile</a></li>
                            @endif
                            <li class="divider"></li>
                            <li><a href="{{ url('auth/logout') }}"><i class="fa fa-power-off"></i> Log Out</a></li>
                       </ul>
                   </li>
                </ul>
            </div>
        </nav>

        @yield('content')

    </div>
    <!-- /#wrapper -->

    @yield('script')
</body>
</html>
