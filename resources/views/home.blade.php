@extends('layouts.main_index')

@section('title')
    Home
@endsection

@section('navbar')

    <li><a href="{{ url('/') }}" class="active">Home</a></li>
    <li class="dropdown"><a href="#">Category<i class="fa fa-angle-down"></i></a>
        <ul role="menu" class="sub-menu">
            <li><a href="{{ url('books/computing') }}">COMPUTING & INTERNET</a></li>
            <li><a href="{{ url('books/cooking') }}">COOKING</a></li>
            <li><a href="{{ url('books/education') }}">EDUCATION</a></li>
            <li><a href="{{ url('books/health') }}">HEALTH</a></li>
            <li><a href="{{ url('books/medical') }}">MEDICAL</a></li>
            <li><a href="{{ url('books/novel') }}">NOVEL</a></li>
            <li><a href="{{ url('books/photography') }}">PHOTOGRAPHY</a></li>
            <li><a href="{{ url('books/religion') }}">RELIGION</a></li>
        </ul>
    </li>
    <li><a href="{{ url('contact') }}">Contact</a></li>

@endsection

@section('slider')

    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>

                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="col-sm-6">
                                    <h1><span>LIST</span></h1>

                                    <h2>Library Information System</h2>

                                    <p>“Great books help you understand, and they help you feel understood.”<br>
                                        ― John Green</p>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{ asset('images/index/home/book1.png') }}" class="girl img-responsive"/>
                                </div>
                            </div>
                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>LIST</span></h1>

                                    <h2>Library Information System</h2>

                                    <p>“You're never alone when you're reading a book.” <br>
                                        ― Susan Wiggs</p>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{ asset('images/index/home/book2.png') }}" class="girl img-responsive"
                                         alt=""/>
                                    <img src="{{ asset('images/index/home/pen2.png') }}" class="pricing" alt=""/>
                                </div>
                            </div>

                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>LIST</span></h1>

                                    <h2>Library Information System</h2>

                                    <p>“A room without books is like a body without a soul.” <br> ― Marcus Tullius
                                        Cicero </p>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{ asset('images/index/home/book3.png') }}" class="girl img-responsive"
                                         alt=""/>
                                    <img src="{{ asset('images/index/home/pen1.png') }}" class="pricing" alt=""/>
                                </div>
                            </div>

                        </div>

                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--/slider-->

@endsection

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Category</h2>

                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="category" id="all" data-categ="ALL">
                                            New Arrivals
                                        </a>
                                    </h4>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="category" data-categ="COMPUTING & INTERNET">
                                            Computing & Internet
                                        </a>
                                    </h4>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="category" data-categ="COOKING">
                                            Cooking
                                        </a>
                                    </h4>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="category" data-categ="EDUCATION">Education</a>
                                    </h4>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="category" data-categ="HEALTH">Health</a>
                                    </h4>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="category" data-categ="MEDICAL">Medical</a>
                                    </h4>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="category" data-categ="NOVEL">Novel</a>
                                    </h4>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="category" data-categ="PHOTOGRAPHY">Photography</a>
                                    </h4>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="category" data-categ="RELIGION">Religion</a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <!--/category-products-->

                    </div>
                </div>

                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->

                        <div id="category-items">
                            <h2 class="title text-center">New Arrivals</h2>
                            @foreach($books as $book)
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="{{ url('image/'.$book->id) }}" alt="{{ $book->cover }}"/>

                                                <h2></h2>

                                                <p><b>{{ $book->title }}</b></p>

                                                <p style="font-size: smaller">{{ $book->author }}</p>
                                            </div>
                                            <div class="product-overlay">
                                                <div class="overlay-content">
                                                    <h2></h2>
                                                    <h4 style="margin: 15px;font-weight:bold">{{ $book->title }}</h4>

                                                    <p style="margin:15px;text-align:justify">{{ $book->description }}</p>

                                                    <P style="color:#000">Stock : {{ $book->stock }}</P>
                                                    <a href="{{ route('order', $book->id) }}"
                                                       class="btn btn-default add-to-cart"><i
                                                                class="fa fa-book"></i>Order</a>
                                                    <a href='{{ url("books/detail/$book->id") }}'
                                                       class="btn btn-default add-to-cart"><i
                                                                class="fa fa-eye"></i>Detail</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <!--features_items-->

                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')

    <script>

        $(function () {
            $('.category').click(function () {
                $('#category-items').animate({'opacity':'0.1'},'slow');
                var query = $(this).data('categ');
                $.get("{{ url('books/category/query') }}" + '/' + query, function (result) {
                    $('#category-items').html(result);
                    $('#category-items').animate({'opacity':'1'},'slow');
                });
            });
        });

        @if (Session::has('requiredName'))
        swal({
            title: "Data Nama",
            text: "Tulis nama lengkap anda:",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "Nama"
        }, function (inputValue) {
            if (inputValue === false) return false;
            if (inputValue === "") {
                swal.showInputError("Nama tidak boleh kosong!");
                return false
            }
            var token = "{{ csrf_token() }}"
            var url = "{{ route('profile.member', $user->id) }}"
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    name: inputValue,
                    _token: token,
                    _method: "PUT"
                },
                success: function (result) {
                    swal({
                        title: "Berhasil!",
                        text: result.message,
                        type: "success"
                    }, function (isConfirm) {
                        window.location.href = "{{ route('order', Session::get('requiredName')) }}";
                    });
                }
            });
        });
        @endif

    </script>

@endsection
