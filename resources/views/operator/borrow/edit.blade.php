@extends('layouts.main')

@section('title')

    Books

@endsection

@section('navbar')

    <ul class="nav navbar-nav side-nav">
        <li><a href="{{ url('operator') }}"><i class="fa fa-bar-chart"></i> Dashboard</a></li>
        <li><a href="{{ url('operator/users') }}"><i class="fa fa-user"></i></i> Users</a></li>
        <li class="active"><a href="{{ url('operator/borrow') }}"><i class="fa fa-book"></i> Borrow</a></li>
        <li><a href="{{ url('operator/transactions') }}"><i class="fa fa-exchange"></i> Transactions</a></li>
        <li><a href="{{ url('operator/order') }}"><i class="fa fa-inbox"></i> Order</a></li>
    </ul>

@endsection

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1><i class="fa fa-exchange"></i></i> Borrow</h1>
            </div>
        </div>
        <div class="space"></div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-table"></i> Borrow Data</h3>
                    </div>
                    <div class="panel-body">
                        @if(count($errors))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('operator.borrow.update', $book_id) }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PUT">

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-lg-4">
                                        <label>User</label>
                                        <select name="user_id" class="form-control">
                                            @foreach ($dataUser as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px">
                                <div class="form-group">
                                    <div class="col-lg-4">
                                        <button type="submit" class="btn btn-success">Borrow</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
@endsection