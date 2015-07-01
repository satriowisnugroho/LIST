@extends('layouts.main')

@section('title')

    Books

@endsection

@section('navbar')

<ul class="nav navbar-nav side-nav">
    <li><a href="{{ url('admin') }}"><i class="fa fa-bar-chart"></i> Dashboard</a></li>
    <li><a href="{{ url('admin/users') }}"><i class="fa fa-user"></i></i> Users</a></li>                    
    <li class="active"><a href="{{ url('admin/books') }}"><i class="fa fa-book"></i> Books</a></li>
</ul>

@endsection

@section('content')
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1><i class="fa fa-book"></i></i> Books <small>Books Management</small></h1>                    
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
                            <form method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Author</label>
                                        <input type="text" name="author" class="form-control" value="{{ old('author') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Publisher</label>
                                        <input type="text" name="publisher" class="form-control" value="{{ old('publisher') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select name="category" class="form-control">
                                            <option value="Computing & Internet" {{ old('category') == 'Computing & Internet' ? 'selected' : '' }}>Computing & Internet</option>
                                            <option value="Cooking" {{ old('category') == 'Cooking' ? 'selected' : '' }}>Cooking</option>
                                            <option value="Education" {{ old('category') == 'Education' ? 'selected' : '' }}>Education</option>
                                            <option value="Health" {{ old('category') == 'Health' ? 'selected' : '' }}>Health</option>
                                            <option value="Medical" {{ old('category') == 'Medical' ? 'selected' : '' }}>Medical</option>
                                            <option value="Novel" {{ old('category') == 'Novel' ? 'selected' : '' }}>Novel</option>
                                            <option value="Photography" {{ old('category') == 'Photography' ? 'selected' : '' }}>Photography</option>
                                            <option value="Religion" {{ old('category') == 'Religion' ? 'selected' : '' }}>Religion</option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <select name="date" class="form-control">
                                            @for( $i = date("Y"); $i >= 1994; $i-- )
                                            <option value="{{ $i }}" {{ old('date') == '$i' ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Stock</label>
                                        <input type="number" name="stock" class="form-control" value="{{ old('stock') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Cover</label>
                                        <input type="file" name="cover" class="filestyle" data-buttonBefore="true" value="{{ old('cover') }}">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Create</button>
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