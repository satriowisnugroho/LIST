<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title') &raquo; LIST</title>
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fonts/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/index/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('css/index/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('css/index/animate.css') }}" rel="stylesheet">
    {{--    <link href="{{ asset('css/index/main.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('css/index/blue_main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/index/responsive.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{ asset('js/index/html5shiv.js') }}"></script>
    <script src="{{ asset('js/index/respond.min.js') }}"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{ asset('images/icon.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="images/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="images/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png') }}">

    <!-- include sweetAlert css and js -->
    <script src="{{ asset('js/sweet-alert.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweet-alert.css') }}">
</head>
<!--/head-->

<body>
<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@list.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{ url('/') }}"><img src="{{ asset('images/logo.png') }}" alt=""/></a>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            @if(isset($user))
                                @if($user->role == 'member')
                                    <li><a href="#" data-toggle="modal" data-target="#editProfileModal"><i class="fa fa-user"></i> Account</a></li>
                                    @if(isset($notif))
                                        <li class="dropdown">
                                            <a href="#" style="color:red"><i class="fa fa-exclamation-circle"></i>
                                                Notification<i
                                                        class="fa fa-angle-down"></i></a>
                                            <ul role="menu" class="sub-menu" id="notif">
                                                @for($i=0;$i<$length;$i++)
                                                    <li>
                                                        <a href="#" onclick="notification(
                                                                '{{ $notif[$i]->title }}',
                                                                '{{ $notif[$i]->created_at->toDateString() }}',
                                                                '{{ $notif[$i]->created_at->next()->toDateString() }}',
                                                                '{{ number_format($notif[$i]->created_at->next()->diffInDays() * 2000) }}'
                                                                )">
                                                            ~ Keterlambatan pengembalian
                                                            {{ $notif[$i]->created_at->next()->diffForHumans() }}
                                                        </a>
                                                    </li>
                                                    <br/>
                                                @endfor
                                                <br/>
                                            </ul>
                                        </li>
                                    @endif
                                    <li><a href="{{ url('auth/logout') }}"><i class="fa fa-lock"></i> Logout</a></li>
                                @else
                                    <li><a href="{{ url('login') }}"><i class="fa fa-lock"></i> Login</a></li>
                                @endif
                            @else
                                <li><a href="{{ url('login') }}"><i class="fa fa-lock"></i> Login</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            @yield('navbar')
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <input type="text" placeholder="Search" id="search"/>
                        <div id="information"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/header-bottom-->
</header>
<!--/header-->

@yield('slider')

@yield('content')

@if(isset($user))
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editProfileModalLabel">Account</h4>
            </div>
            <form id="delete-form" action="{{ url('users/'.$user->id) }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="PUT">
                <div class="modal-body" style="padding: 10px 5%">
                    <div class="container-fluid">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">E-Mail Address</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Old Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="oldPassword">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">New Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Password Confirmation</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="submit" class="btn btn-info">Edit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

<footer id="footer"><!--Footer-->

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © {{ date("Y") }} LIST. All rights reserved.</p>

                <p class="pull-right">Designed by <span><a target="_blank"
                                                           href="http://www.themeum.com">Themeum</a></span></p>
            </div>
        </div>
    </div>

</footer>
<!--/Footer-->

<script src="{{ asset('js/index/jquery.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/index/jquery.scrollUp.min.js') }}"></script>
<script src="{{ asset('js/index/price-range.js') }}"></script>
<script src="{{ asset('js/index/jquery.prettyPhoto.js') }}"></script>
<script src="{{ asset('js/index/main.js') }}"></script>
<script>

    $(function(){
        $('#search').click(function(){
            $(this).animate({'width':'250px','background-position':'225px'}, 'slow');
        });
        $('#search').blur(function(){
            $(this).animate({'width':'155px','background-position':'130px'}, 'slow');
            $('#searching').animate({'width':'155px','opacity':'0'}, 'slow', function(){
                $('#searching').hide();
            });
        });
        $('#search').keyup(function(){
            $.get('{{ url('search') }}'+'/'+$(this).val(), function(result){
                $('#information').html(result);
            });
        });
    });

    function notification(title, pinjam, kembali, denda) {
        swal(
                "Keterlambatan",
                "Buku : "+title
                    +"\nTanggal pinjam : "+pinjam
                    +"\nTanggal kembali : "+kembali
                    +"\nDenda : Rp. "
                    +denda+",-",
                "warning"
        );
    }

    @if (Session::has('message'))
    swal(
            "Berhasil!", "{{ Session::get('message') }}", "success"
    );
    @endif

    @if (Session::has('category'))
    swal(
            "Maaf!", "{{ Session::get('category') }}", "warning"
    );
    @endif

    @if(count($errors))

    var text2 = ""
    @foreach($errors->all() as $error)
    text2 += "{{ $error }}" + "\n"
    @endforeach

    swal(
            "Gagal", "" + text2 + "", "warning"
    );

    @endif

</script>

@yield('script')

</body>
</html>