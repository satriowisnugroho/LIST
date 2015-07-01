@extends('layouts.main_index')

@section('title')
    Detail
@endsection

@section('navbar')

    <li><a href="{{ url('/') }}">Home</a></li>
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

@section('content')
    <section>
        <div class="container">
            <div class="row">

                <div class="col-sm-12 padding-right">
                    <div class="product-details"><!--product-details-->
                        <div class="col-sm-5">
                            <div class="view-product">
                                <img src="{{ url('image/'.$book->id) }}" alt=""/>
                            </div>

                        </div>
                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->
                                <h2>{{ $book->title }}</h2>

                                <p>{{ $book->author }}</p>
                                <span></span>

                                <p><b>Publisher:</b> {{ $book->publisher }}</p>

                                <p><b>Category:</b> {{ $book->category }}</p>

                                <p><b>Date:</b> {{ $book->date }}</p>

                                <p><b>Stock:</b> {{ $book->stock }}</p>

                                <p><b>Description:</b> {{ $book->description }}</p>
								<span>
									<a href="{{ route('order', $book->id) }}" class="btn btn-default cart">
                                        <i class="fa fa-book"></i>
                                        Order
                                    </a>
								</span>
                            </div>
                            <!--/product-information-->
                        </div>
                    </div>
                    <!--/product-details-->

                </div>
            </div>
        </div>
    </section>
@endsection
