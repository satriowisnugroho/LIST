@extends('layouts.main')

@section('title')

    Borrow

@endsection

@section('navbar')

<ul class="nav navbar-nav side-nav">
    <li><a href="{{ url('operator') }}"><i class="fa fa-bar-chart"></i> Dashboard</a></li>
    <li><a href="{{ url('operator/users') }}"><i class="fa fa-user"></i></i> Users</a></li>
    <li class="active"><a href="#"><i class="fa fa-book"></i></i> Borrow</a></li>
    <li><a href="{{ url('operator/transactions') }}"><i class="fa fa-exchange"></i> Transactions</a></li>
    <li><a href="{{ url('operator/order') }}"><i class="fa fa-inbox"></i> Order</a></li>
</ul>

@endsection

@section('content')
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1><i class="fa fa-book"></i></i> Borrow <small>Borrow Management</small></h1>
                </div>
            </div>
            <div class="space"></div>
            @if (Session::has('successMessage'))
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('successMessage') }}
                </div>
            @elseif (Session::has('errorMessage'))
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('errorMessage') }}
                </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-table"></i> Books Data</h3>
                        </div>
                        <div class="panel-body">
                            <table class="cell-border hover stripe dataTable" id="table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Category</th>
                                        <th>Stock</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($books as $book)
                                <tr>
                                    <td>
                                        {{ $book->title }}
                                    </td>
                                    <td>
                                        {{ $book->author }}
                                    </td>
                                    <td>
                                        {{ $book->category }}
                                    </td>
                                    <td style="text-align:center">
                                        {{ $book->stock }}
                                    </td>
                                    <td style="text-align:center">
                                        <a href="{{ url('operator/books') }}/{{ $book->id }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('operator.borrow.edit', $book->id) }}" class="btn btn-success"><i class="fa fa-exchange"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->            
        </div>
        <!-- /#page-wrapper -->
@endsection