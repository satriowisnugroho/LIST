@extends('layouts.main')

@section('title')

    Users

@endsection

@section('head')

    <script>
        $(document).ready(function () {
            $('#loading').hide();
        });
    </script>

@endsection

@section('navbar')

    @if ($user->role == 'admin')
        <ul class="nav navbar-nav side-nav">
            <li><a href="{{ url('admin') }}"><i class="fa fa-bar-chart"></i> Dashboard</a></li>
            <li class="active"><a href="#"><i class="fa fa-user"></i></i> Users</a></li>
            <li><a href="{{ url('admin/books') }}"><i class="fa fa-book"></i> Books</a></li>
        </ul>
    @else
        <ul class="nav navbar-nav side-nav">
            <li><a href="{{ url('operator') }}"><i class="fa fa-bar-chart"></i> Dashboard</a></li>
            <li class="active"><a href="#"><i class="fa fa-user"></i></i> Users</a></li>
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
                <h1><i class="fa fa-user"></i></i> Users
                    <small>Users Management</small>
                </h1>
            </div>
        </div>
        <div class="space"></div>

        @if ($user->role == 'admin')
            <a href="{{ route('admin.users.create') }}"><button class="btn btn-info">Add User</button></a><br><br>
        @else
            <a href="{{ route('operator.users.create') }}"><button class="btn btn-info">Add User</button></a><br><br>
        @endif

        @if (Session::has('errorMessage'))
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('errorMessage') }}
            </div>
        @endif

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-table"></i> Users Data</h3>
                    </div>
                    <div class="panel-body" id="loading">
                        <h3 style="text-align: center;margin: 100px 0">Silahkan menunggu, sistem sedang mengirim password reset ke email user...</h3>
                    </div>
                    <div class="panel-body" id="table-panel">
                        <table class="cell-border hover stripe dataTable" id="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                @if($user->role == 'admin')
                                    <th>Role</th>
                                @endif
                                <th>Date Register</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $userData)
                                <tr>
                                    <td>
                                        {{ $userData->name }}
                                    </td>
                                    <td>
                                        {{ $userData->email }}
                                    </td>
                                    @if($user->role == 'admin')
                                        <td>
                                            {{ $userData->role }}
                                        </td>
                                    @endif
                                    <td style="text-align:center">
                                        {{ $userData->created_at }}
                                    </td>
                                    <td style="text-align:center">
                                        @if ($user->role == 'admin')
                                            <a href="{{ url('admin/users') }}/{{$userData->id}}/edit"
                                               class="btn btn-success">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-warning reset-action"
                                               data-url="{{ url('admin/users') }}/reset/{{$userData->id}}">
                                                <i class="fa fa-key"></i>
                                            </a>

                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="button" class="btn btn-danger delete-action"
                                                    data-url="{{ route('admin.users.destroy', $userData->id) }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        @else
                                            <a href="{{ url('operator/users') }}/{{$userData->id}}/edit"
                                               class="btn btn-success">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-warning reset-action"
                                               data-url="{{ url('operator/users') }}/reset/{{$userData->id}}">
                                                <i class="fa fa-key"></i>
                                            </a>

                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="button" class="btn btn-danger delete-action"
                                                    data-url="{{ route('operator.users.destroy', $userData->id) }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
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

@section('script')

    <script>

        $('.delete-action').click(function () {
            var url = $(this).data('url');
            swal({
                title: "Apakah anda yakin?",
                text: "Anda akan menghapus user ini!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: true
            }, function () {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _method: $('[name=_method]').val(),
                        _token: $('[name=_token]').val()
                    },
                    success: function (result) {
                        swal({
                            title: "Berhasil!",
                            text: result.message,
                            type: "success"
                        }, function (isConfirm) {
                            window.location.reload();
                        });
                    },
                    error: function (result) {
                        swal({
                            title: "Gagal!",
                            text: "User tidak dapat dihapus",
                            type: "warning"
                        });
                    }
                });
            });
        });

        $('.reset-action').click(function () {
            var url = $(this).data('url');
            console.log(url);
            swal({
                title: "Apakah anda yakin?",
                text: "Anda akan mereset password?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#F4AA41",
                confirmButtonText: "Yes, reset it!",
                closeOnConfirm: true
            }, function () {
                $('#table-panel').hide();
                $('#loading').show();
                $.ajax({
                    url: url,
                    success: function (result) {
                        $('#loading').hide();
                        $('#table-panel').show();
                        swal(
                                "Berhasil!", "Berhasil mereset password", "success"
                        );
                    }
                });
            });
        });

        @if (Session::has('successMessage'))
        swal(
                "Berhasil!", "{{ Session::get('successMessage') }}", "success"
        );
        @endif

    </script>

@endsection