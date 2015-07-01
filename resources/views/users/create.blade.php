@extends('layouts.main')

@section('title')

    Users

@endsection

@section('navbar')

    @if ($user->role == 'admin')
    <ul class="nav navbar-nav side-nav">
        <li><a href="{{ url('admin') }}"><i class="fa fa-bar-chart"></i> Dashboard</a></li>
        <li class="active"><a href="{{ url('admin/users') }}"><i class="fa fa-user"></i></i> Users</a></li>                    
        <li><a href="{{ url('admin/books') }}"><i class="fa fa-book"></i> Books</a></li>
    </ul>
    @else
    <ul class="nav navbar-nav side-nav">
        <li><a href="{{ url('operator') }}"><i class="fa fa-bar-chart"></i> Dashboard</a></li>
        <li class="active"><a href="{{ url('operator/users') }}"><i class="fa fa-user"></i></i> Users</a></li>            
        <li><a href="{{ url('operator/borrow') }}"><i class="fa fa-book"></i> Borrow</a></li>
        <li><a href="{{ url('operator/transactions') }}"><i class="fa fa-exchange"></i> Transactions</a></li>
        <li><a href="{{ url('operator/order') }}"><i class="fa fa-inbox"></i> Order</a></li>
    </ul>
    @endif

@endsection

@section('content')
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1><i class="fa fa-user"></i></i> Users <small>Users Management</small></h1>                  
                </div>
            </div>
            <div class="space"></div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-table"></i> Users Data</h3>
                        </div>
                        <div class="panel-body">
                            @if(count($errors))
                            <div class="alert alert-warning alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            </div>
                            @endif

                            @if ($user->role == 'admin')
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.users.store') }}">
                            @else
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('operator.users.store') }}">
                            @endif    
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Name</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">E-Mail Address</label>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                    </div>
                                </div>
                                
                                @if ($user->role == 'admin')
                                <div class="form-group">
                                    <label class="col-md-4 control-label">role</label>
                                    <div class="col-md-6">
                                        <select name="role" class="form-control">
                                            <option value="member" {{ old('role') == 'member' ? 'selected' : '' }}>Member</option>
                                            <option value="operator" {{ old('role') == 'operator' ? 'selected' : '' }}>Operator</option>
                                        </select>
                                    </div>
                                </div>                                
                                @else
                                <input type="hidden" name="role" value="member">
                                @endif

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-success">
                                            Register
                                        </button>
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