@extends('layouts.main_index')

@section('title')
    Category
@endsection

@section('navbar')

    <li><a href="{{ url('/') }}">Home</a></li>
    <li class="dropdown"><a href="#" class="active">Category<i class="fa fa-angle-down"></i></a>
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

@section('content')
    <section>
        <div class="container">
            <div class="row">

                <div class="col-sm-12 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">{{ $category }}</h2>

                        {{--@if($books)--}}
                            {{--<div style="margin: 200px;">--}}
                                {{--<center><h1>Data Belum Ada</h1></center>--}}
                            {{--</div>--}}
                        {{--@endif--}}

                        @foreach($books as $book)
                            <div class="col-sm-3">
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
                                                   class="btn btn-default add-to-cart hov"><i
                                                            class="fa fa-shopping-cart"></i>Order</a>
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
                    <!--features_items-->

                </div>
            </div>
        </div>
    </section>
@endsection
