@extends('layouts.main')

@section('title')

    Books

@endsection

@section('navbar')

    @if ($user->role == 'admin')
        <ul class="nav navbar-nav side-nav">
            <li><a href="{{ url('admin') }}"><i class="fa fa-bar-chart"></i> Dashboard</a></li>
            <li><a href="{{ url('admin/users') }}"><i class="fa fa-user"></i></i> Users</a></li>
            <li class="active"><a href="{{ url('admin/books') }}"><i class="fa fa-book"></i> Books</a></li>
        </ul>
    @else
        <ul class="nav navbar-nav side-nav">
            <li><a href="{{ url('operator') }}"><i class="fa fa-bar-chart"></i> Dashboard</a></li>
            <li><a href="{{ url('operator/users') }}"><i class="fa fa-user"></i></i> Users</a></li>
            <li class="active"><a href="{{ url('operator/borrow') }}"><i class="fa fa-book"></i></i> Borrow</a></li>
            <li><a href="{{ url('operator/transactions') }}"><i class="fa fa-exchange"></i> Transactions</a></li>
            <li><a href="{{ url('operator/order') }}"><i class="fa fa-inbox"></i> Order</a></li>
        </ul>
    @endif

@endsection

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                @if ($user->role == 'admin')
                    <h1><i class="fa fa-book"></i></i> Books
                        <small>Books Management</small>
                    </h1>
                @else
                    <h1><i class="fa fa-book"></i></i> Books</h1>
                @endif
            </div>
        </div>
        <div class="space"></div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-table"></i> Books Data</h3>
                    </div>
                    <div class="panel-body">
                        <div id="information">
                            <h2 style="color:#777">{{ $book->title }}</h2>
                            <table>
                                <tr>
                                    <td width="80px"><b>Author</b></td>
                                    <td width="20px">:</td>
                                    <td>{{ $book->author }}</td>
                                </tr>
                                <tr>
                                    <td><b>Publisher</b></td>
                                    <td>:</td>
                                    <td>{{ $book->publisher }}</td>
                                </tr>
                                <tr>
                                    <td><b>Category</b></td>
                                    <td>:</td>
                                    <td>{{ $book->category }}</td>
                                </tr>
                                <tr>
                                    <td><b>Date</b></td>
                                    <td>:</td>
                                    <td>{{ $book->date }}</td>
                                </tr>
                                <tr>
                                    <td><b>Stock</b></td>
                                    <td>:</td>
                                    <td>{{ $book->stock }}</td>
                                </tr>
                                <tr>
                                    <td><b>Description</b></td>
                                    <td>:</td>
                                </tr>
                                <tr>
                                    <td colspan="3">{{ $book->description }}</td>
                                </tr>
                                <tr>
                                    <td><b>Cover</b></td>
                                    <td>:</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><img src="{{ url('image/'.$book->id) }}"
                                             alt="{{ $book->cover }}"
                                             width="100px"/></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                @if ($user->role == 'admin')
                <a href="{{ url('admin/books') }}" class="btn btn-default">Back</a>
                @else
                <a href="{{ url('operator/books') }}" class="btn btn-default">Back</a>
                @endif
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
@endsection