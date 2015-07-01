@extends('layouts.main')

@section('title')

    Dashboard

@endsection

@section('navbar')

    <ul class="nav navbar-nav side-nav">
        <li class="active"><a href="#"><i class="fa fa-bar-chart"></i> Dashboard</a></li>
        <li><a href="{{ url('admin/users') }}"><i class="fa fa-user"></i></i> Users</a></li>
        <li><a href="{{ url('admin/books') }}"><i class="fa fa-book"></i> Books</a></li>
    </ul>

@endsection

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1><i class="fa fa-bar-chart"></i></i> Dashboard
                    <small>Home</small>
                </h1>
            </div>
        </div>
        <div class="space"></div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Books Data</h3>
                    </div>
                    <div class="panel-body">
                        <div id="morris-bar-chart"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
@endsection

@section('script')

    <!-- MORRIS CHART SCRIPTS -->
    <script src="{{ asset('js/morris/raphael-2.1.0.min.js') }}"></script>
    <script src="{{ asset('js/morris/morris.js') }}"></script>

    <script type="text/javascript">
        $(function () {
            /*====================================
             MORRIS BAR CHART
             ======================================*/
            Morris.Bar({
                element: 'morris-bar-chart',
                data: [{
                    y: "Computing",
                    a: {{ $comp->count() }}
                }, {
                    y: "Cooking",
                    a: {{ $cooking->count() }}
                }, {
                    y: 'Education',
                    a: {{ $education->count() }}
                }, {
                    y: 'Health',
                    a: {{ $health->count() }}
                }, {
                    y: 'Medical',
                    a: {{ $medical->count() }}
                }, {
                    y: 'Novel',
                    a: {{ $novel->count() }}
                }, {
                    y: 'Photography',
                    a: {{ $photography->count() }}
                }, {
                    y: 'Religion',
                    a: {{ $religion->count() }}
                }],
                xkey: 'y',
                ykeys: ['a'],
                labels: ['Banyak '],
                hideHover: 'auto',
                resize: true
            });
        });

        @if (Session::has('successMessage'))
        swal(
                "Berhasil!", "{{ Session::get('successMessage') }}", "success"
        );
        @endif
    </script>

@endsection