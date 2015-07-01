@extends('layouts.main')

@section('title')

    Dashboard

@endsection

@section('navbar')

<ul class="nav navbar-nav side-nav">
    <li class="active"><a href="#"><i class="fa fa-bar-chart"></i> Dashboard</a></li>
    <li><a href="{{ url('operator/users') }}"><i class="fa fa-user"></i></i> Users</a></li>          
    <li><a href="{{ url('operator/borrow') }}"><i class="fa fa-book"></i> Borrow</a></li>
    <li><a href="{{ url('operator/transactions') }}"><i class="fa fa-exchange"></i> Transactions</a></li>
    <li><a href="{{ url('operator/order') }}"><i class="fa fa-inbox"></i> Order</a></li>
</ul>

@endsection

@section('content')
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1><i class="fa fa-bar-chart"></i></i> Dashboard <small>Home</small></h1>
                </div>
            </div>
            <div class="space"></div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Dashboard</h3>
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

    <script>
        $(function(){
            /*====================================
             MORRIS BAR CHART
             ======================================*/
            Morris.Bar({
                element: 'morris-bar-chart',
                data: [{
                    y: "Pinjam",
                    a: '{{ $pinjam->count() }}'
                }, {
                    y: "Kembali",
                    a: '{{ $kembali->count() }}'
                }, {
                    y: 'Pesan',
                    a: '{{ $pesan->count() }}'
                }],
                xkey: 'y',
                ykeys: ['a'],
                labels: ['Banyak '],
                hideHover: 'auto',
                resize: true
            });
        });
    </script>

@endsection