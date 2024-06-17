@extends('layouts.front')


@section('front')
<div class="wrapper">
    <!-- Navbar -->
    <x-front-dashboard-navbar></x-front-dashboard-navbar>
    <!-- /.Navbar -->
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/dashboard" class="brand-link">
            <img src="{{ asset('dist/img/TicBusLogo1.png') }}" width="50" alt="ticbus Logo">
        </a>
        <!-- Sidebar Menu -->
        <x-front-sidemenu></x-front-sidemenu>
        <!-- /.sidebar Menu -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="mb-2 row">
                    <div class="col-sm-6">
                        <h1>Detail TRANSAKSI</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Detail TRANSAKSI</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">


                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered">

                                    <div>
                                        <p>ID Transaksi: {{ $transaction->order->order_code}}</p>
                                        <p>ID Order: {{ $transaction->order_id }}</p>
                                        <p>nama User: {{Auth::user()->name}}</p>
                                        <p>Email User: {{Auth::user()->email}}</p>
                                        <p>Nomor Hp: {{Auth::user()->no_hp}}</p>

                                        <p>Total: {{ $transaction->total }}</p>
                                        <p>Status:
                                            @if ($transaction->status == 'unpaid')
                                            Belum Bayar
                                            @else
                                            Sudah Bayar
                                            @endif
                                        </p>
                                        <!-- Anda bisa menampilkan data lainnya sesuai kebutuhan -->
                                    </div>
                                </table>
                                <button id="pay-button" type="button" class="btn btn-primary">Bayar</button>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
</div>
</div>
<script type="text/javascript">
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
        window.snap.pay('{{$snapToken}}',
            {
                onSuccess: function (result) {
                    /* You may add your own implementation here */
                    alert("payment success!"); 
                    console.log(result);
                },
                onPending: function (result) {
                    /* You may add your own implementation here */
                    alert("wating your payment!"); console.log(result);
                },
                onError: function (result) {
                    /* You may add your own implementation here */
                    alert("payment failed!"); console.log(result);
                },
                onClose: function () {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            }
        );
    });
</script>

</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
    <span class='dark:text-white'>
        Copyright &copy;
        @if (date('Y') != '2020')
        {{ date('Y') }}
        @endif
        &nbsp; All rights reserved • by
        <a href="" target="_blank">Saryoni</a>.
    </span>
    <div class="float-right d-none d-sm-inline-block">
    </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@endsection