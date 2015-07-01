<!DOCTYPE HTML>
<html>
<head>
    <title>Login &raquo; LIST</title>
    <link href='{{ asset("images/icon.png") }}' rel='SHORTCUT ICON'/>
    <link href="{{ asset('css/login-style.css') }}" rel='stylesheet' type='text/css'/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords"
          content="Client Login Form,Login Forms,Sign up Forms,Registration Forms,News latter Forms,Elements" ./>
    <script type="application/x-javascript">
        addEventListener("load", function () {
                setTimeout(hideURLbar, 0);
            }, false
        );
        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>

    <!--webfonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700,800'
          rel='stylesheet' type='text/css'>
    <!--//webfonts-->
    <script>
        var __links = document.querySelectorAll('a');
        function __linkClick(e) {
            parent.window.postMessage(this.href, '*');
        };
        for (var i = 0, l = __links.length; i < l; i++) {
            if (__links[i].getAttribute('data-t') == '_blank')
            {
                __links[i].addEventListener('click', __linkClick, false);
            }
        }
    </script>
    <script src="{{ asset('js/jquery-1.10.2.min.js') }}"></script>

    <!-- include sweetAlert css and js -->
    <script src="{{ asset('js/sweet-alert.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweet-alert.css') }}">

</head>
<body>
<div class="shadow-forms">
    <div class="message warning">
        <div class="login-head">
            <h2>LOGIN</h2>
        </div>
        <div class="sub-head">
        </div>
        <form method="POST" action="{{ url('auth/login') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="text" class="text" name="email" placeholder="Email" autofocus>
            <input type="password" name="password" placeholder="Password">

            <div class="p-container">
                <label class="checkbox"><input type="checkbox" name="checkbox" checked><i></i>Remember Me</label>
                <h6><a class="popup-with-zoom-anim" href="#small-dialog3">Forgot a Password ?</a></h6>

                <div class="clear"></div>
            </div>
            <div class="submit">
                <input type="submit" value="LOG IN">
            </div>
        </form>
        <div class="sign-up">
            <a class="sign-left">Want new account ?</a>
            <a class="signup play-icon popup-with-zoom-anim" href="#small-dialog2">Sign Up</a>
            <!-- pop-up-box -->
            <script type="text/javascript" src="{{ asset('js/login/modernizr.custom.min.js') }}"></script>
            <link href="{{ asset('css/popuo-box.css') }}" rel="stylesheet" type="text/css" media="all"/>
            <script src="{{ asset('js/login/jquery.magnific-popup.js') }}" type="text/javascript"></script>
            <!--//pop-up-box -->
            <div id="small-dialog2" class="mfp-hide">
                <div class="signup">
                    <h3>Signup</h3>
                    <h4><a href="#">let's get started</a></h4>

                    <form action="{{ route('register') }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="text" name="email" class="email" placeholder="Email adress" required/>
                        <input type="password" name="password" placeholder="Password" required/>
                        <input type="password" name="password_confirmation" placeholder="Password Confirmation"
                               required/>
                        <input type="submit" value="Signup"/>
                    </form>
                </div>
            </div>
            <div id="small-dialog3" class="mfp-hide">
                <div class="signup">
                    <form action="{{ route('reset') }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="text" name="email" class="email" placeholder="Email adress" required/>
                        <input type="submit" value="Send Password Reset Link" style="font-size:14px"/>
                    </form>
                </div>
            </div>
            <script>
                $(document).ready(function () {
                    $('.popup-with-zoom-anim').magnificPopup({
                        type: 'inline',
                        fixedContentPos: false,
                        fixedBgPos: true,
                        overflowY: 'auto',
                        closeBtnInside: true,
                        preloader: false,
                        midClick: true,
                        removalDelay: 300,
                        mainClass: 'my-mfp-zoom-in'
                    });

                });
            </script>
        </div>

        <div class="clear"></div>
    </div>

</div>
</div>
<!--- footer -->
<div class="footer">
</div>
<script>
    @if(count($errors) || Session::has('errorMessage'))

    var text2 = ""
    @foreach($errors->all() as $error)
    text2 += "- {{ $error }}" + "\n"
    @endforeach

    text2 += "{{ Session::get('errorMessage') }}"

    swal({
        title: "Whoooops!",
        text: "" + text2 + "",
        type: "warning"
    });
    @endif

    @if (Session::has('warning'))
    swal(
            "Maaf!", "{{ Session::get('warning') }}", "warning"
    );
    @endif
</script>
</body>
</html>