@extends('layouts.main')

@section('title')

    Order

@endsection

@section('navbar')

<ul class="nav navbar-nav side-nav">
    <li><a href="{{ url('operator') }}"><i class="fa fa-bar-chart"></i> Dashboard</a></li>
    <li><a href="{{ url('operator/users') }}"><i class="fa fa-user"></i></i> Users</a></li>
    <li><a href="{{ url('operator/borrow') }}"><i class="fa fa-book"></i> Borrow</a></li>
    <li><a href="{{ url('operator/transactions') }}"><i class="fa fa-exchange"></i> Transactions</a></li>
    <li class="active"><a href="#"><i class="fa fa-inbox"></i> Order</a></li>
</ul>

@endsection

@section('content')
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1><i class="fa fa-inbox"></i></i> Order Book <small>Order Book Management</small></h1>
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
                            <h3 class="panel-title"><i class="fa fa-table"></i> Order Data</h3>
                        </div>
                        <div class="panel-body">
                            <table class="cell-border hover stripe dataTable" id="table2">
                                <thead>
                                    <tr>
                                        <th>Book Title</th>
                                        <th>Orderer</th>
                                        <th>Order Date</th>
                                        <th>Action</th>
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
                                        @if ($trans->status == 'pinjam') 
                                            {{ $trans->updated_at }}
                                        @elseif ($trans->status == 'pesan')
                                            <a href="{{ url('operator/order') }}/{{ $trans->id }}" class="btn btn-success">
                                                <i class="fa fa-exchange"></i> Borrow
                                            </a>
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