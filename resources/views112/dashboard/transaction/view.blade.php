@extends('layouts.front')

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 content-wrapper">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1></h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                                    <li class="breadcrumb-item active">Riwayat Transaksi</li>
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
                                    <div class="card-header">
                                        <h3 class="card-title">Detail TRANSAKSI</h3>
                                    </div>
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
                                        <x-button id="pay-button">bayar</x-button>
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
                        // alert("payment success!"); 
                        window.location.href= '/print?order={{ $transaction->order->order_code}}'
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


</x-app-layout>