@extends('layouts.main')

@section('title')
    Books
@endsection

@section('navbar')

    <ul class="nav navbar-nav side-nav">
        <li><a href="{{ url('admin') }}"><i class="fa fa-bar-chart"></i> Dashboard</a></li>
        <li><a href="{{ url('admin/users') }}"><i class="fa fa-user"></i></i> Users</a></li>
        <li class="active"><a href="#"><i class="fa fa-book"></i> Books</a></li>
    </ul>

@endsection

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1><i class="fa fa-book"></i></i> Books
                    <small>Books Management</small>
                </h1>
            </div>
        </div>
        <div class="space"></div>
        <a href="{{ route('admin.books.create') }}">
            <button class="btn btn-info">Add Book</button>
        </a><br><br>
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
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <a href="{{ url('admin/books') }}/{{ $book->id }}" class="btn btn-info">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ url('admin/books') }}/{{$book->id}}/edit" class="btn btn-success">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger delete-action"
                                                data-url="{{ route('admin.books.destroy', [$book->id]) }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
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
                text: "Anda akan menghapus buku ini!",
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
                    error: function () {
                        swal({
                            title: "Gagal!",
                            text: "Buku tidak dapat dihapus",
                            type: "warning"
                        });
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