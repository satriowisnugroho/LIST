<!DOCTYPE HTML>
<html>
<head>
    <title>Reset &raquo; LIST</title>
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
            <h2>Reset Password</h2>
        </div>
        <div class="sub-head">
        </div>
        <form method="POST" action="{{ url('reset/password') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{ $user->id }}">
            <input type="password" name="password" placeholder="New Password" autofocus>
            <input type="password" name="password_confirmation" placeholder="Password Confirmation">
            <div class="submit">
                <input type="submit" value="RESET">
            </div>
        </form>
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