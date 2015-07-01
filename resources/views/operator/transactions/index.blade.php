@extends('layouts.main')

@section('title')

    Transactions

@endsection

@section('navbar')

<ul class="nav navbar-nav side-nav">
    <li><a href="{{ url('operator') }}"><i class="fa fa-bar-chart"></i> Dashboard</a></li>
    <li><a href="{{ url('operator/users') }}"><i class="fa fa-user"></i></i> Users</a></li>
    <li><a href="{{ url('operator/borrow') }}"><i class="fa fa-book"></i></i> Borrow</a></li>
    <li class="active"><a href="#"><i class="fa fa-exchange"></i> Transactions</a></li>
    <li><a href="{{ url('operator/order') }}"><i class="fa fa-inbox"></i> Order</a></li>
</ul>

@endsection

@section('content')
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1><i class="fa fa-exchange"></i></i> Transactions <small>Transactions Management</small></h1>
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
                            <h3 class="panel-title"><i class="fa fa-table"></i> Transaction Data</h3>
                        </div>
                        <div class="panel-body">
                            <table class="cell-border hover stripe dataTable" id="table2">
                                <thead>
                                    <tr>
                                        <th>Book Title</th>
                                        <th>Borrower</th>
                                        <th>Date of Borrowing</th>
                                        <th>Date of Return</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($transactions as $trans)
                                <tr>
                                    <td>
                                        {{ $trans->title }}
                                    </td>
                                    <td>
                                        {{ $trans->name }}
                                    </td>
                                    <td style="text-align:center">
                                        {{ $trans->created_at }}
                                    </td>
                                    <td style="text-align:center">
                                        @if ($trans->status == 'kembali') 
                                            {{ $trans->updated_at }}
                                        @elseif ($trans->status == 'pinjam')
                                            <form method="POST" action="{{ route('operator.transactions.update', $trans->id) }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="_method" value="PUT">
                                                <input type="hidden" name="status" value="kembali">
                                                <input type="hidden" name="book_id" value="{{ $trans->book_id }}">
                                                <button type="submit" class="btn btn-success"><i class='fa fa-exchange'></i> Return</button>
                                            </form>
                                        @endif
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