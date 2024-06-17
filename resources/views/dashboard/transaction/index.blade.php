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
            <img src="{{ asset('dist/img/TicBusLogo1.png') }}"width="50" alt="ticbus Logo">
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
                        <h1>Riwayat Transaksi</h1>
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
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">DATA RIWAYAT TRANSAKSI</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID Booking</th>
                                            <th>Nama</th>
                                            <th>Total Pembayaran</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $transaction)
                                        <tr>
                                            <td>
                                                @isset($transaction->order->order_code)
                                                {{ $transaction->order->order_code }}
                                                @else
                                                ID Booking tidak dapat ditemukan (kemungkinan dikarenakan
                                                dihapusnya order)
                                                @endisset
                                            </td>
                                            <td>
                                                @isset($transaction->order->user->name)
                                                {{ $transaction->order->user->name }}
                                                @endisset
                                            </td>
                                            <td>
                                                @isset($transaction->total)
                                                {{ $transaction->total }}
                                                @endisset
                                            </td>
                                       
                                            <td>
                                                @if ($transaction->status == 'unpaid')
                                                Belum Bayar
                                                @else
                                                Sudah Bayar
                                                @endif
                                            </td>
                                            <td>
                                                @can('isAdmin')
                                                    @if ($transaction->status == 'unpaid')
                                                        <button class="btn btn-primary" type="button" data-toggle="modal"
                                                            data-target="#modal-transaction-{{ $transaction->id }}">Perbaharui Status
                                                        </button>
                                                    @else
                                                        Sudah Bayar
                                                    @endif
                                                @endcan
                                                @can('isKaryawan')
                                                    @if ($transaction->status == 'unpaid')
                                                        <button class="btn btn-primary btn-xs" type="button" data-toggle="modal"
                                                            data-target="#modal-transaction-{{ $transaction->id }}">Perbaharui Status
                                                        </button>
                                                    @else
                                                        Sudah Bayar
                                                    @endif
                                                @endcan
                                                @if (!Gate::allows('isAdmin') && !Gate::allows('isKaryawan'))
                                                @if ($transaction->status == 'unpaid')
                                                    <a href='pay1/{{$transaction->id }}'>bayar</a>
                                                @else
                                                    Sudah Bayar
                                                @endif
                                            @endunless
                                            </td>

                                            <div class="modal fade" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLongTitle" aria-hidden="true"
                                            id="modal-transaction-{{ $transaction->id }}">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Update Status Transaksi
                                                            dengan
                                                            <strong>Booking ID
                                                                {{ $transaction->order->order_code }}</strong>
                                                        </h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="/transactions/{{ $transaction->id }}" method="POST">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="modal-body">
                                                            <div class="card card-body">
                                                                <h5 style="font-weight: 700">Data Penumpang</h5>
                                                                <ol>
                                                                    @foreach ($transaction->order->passengers as $passenger)
                                                                    <li class="mb-4">
                                                                        <ul>
                                                                            <li>
                                                                                <div class="d-flex">
                                                                                    <div
                                                                                        style="width: 130px; font-weight: 700">
                                                                                        Nama
                                                                                    </div>
                                                                                    <div style="width: 20px">
                                                                                        :</div>
                                                                                    <div>
                                                                                        @isset($passenger->name)
                                                                                        {{ $passenger->name }}
                                                                                        @else
                                                                                        Tidak dapat
                                                                                        ditampilkan
                                                                                        @endisset
                                                                                    </div>
                                                                                </div>

                                                                            </li>
                                                                            <li>
                                                                                <div class="d-flex">
                                                                                    <div
                                                                                        style="width: 130px; font-weight: 700">
                                                                                        NIK
                                                                                    </div>
                                                                                    <div style="width: 20px">
                                                                                        :</div>
                                                                                    <div>
                                                                                        @isset($passenger->id_number)
                                                                                        {{ $passenger->id_number }}
                                                                                        @else
                                                                                        Tidak dapat
                                                                                        ditampilkan
                                                                                        @endisset
                                                                                    </div>
                                                                                </div>

                                                                            </li>
                                                                            <li>
                                                                                <div class="d-flex">
                                                                                    <div
                                                                                        style="width: 130px; font-weight: 700">
                                                                                        Jenis Kelamin
                                                                                    </div>
                                                                                    <div style="width: 20px">
                                                                                        :</div>
                                                                                    <div>
                                                                                        @isset($passenger->gender)
                                                                                        @if ($passenger->gender == true)
                                                                                        Laki-laki
                                                                                        @else
                                                                                        Perempuan
                                                                                        @endif
                                                                                        @else
                                                                                        Tidak dapat
                                                                                        ditampilkan
                                                                                        @endisset
                                                                                    </div>
                                                                                </div>

                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                    @endforeach
                                                                </ol>
                                                            </div>


                                                            <div class="input-group w-100">

                                                                <div class="input-group-text">

                                                                    @if ($transaction->status == true)
                                                                    <input type="checkbox" id="status" name="status"
                                                                        checked>
                                                                    @else
                                                                    <input type="checkbox" id="status" name="status">
                                                                    @endif

                                                                </div>
                                                                <label type="text"
                                                                    class="form-control">Konfirmasi/setujui
                                                                    transaksi dengan Booking ID
                                                                    {{ $transaction->order->order_code }}
                                                                    ?</label>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>

                                            <div class="modal fade" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLongTitle" aria-hidden="true"
                                                id="modal-upload-{{ $transaction->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Unggah Bukti Pembayaran
                                                            </h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="/transactions/{{ $transaction->id }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                @isset($transaction->image)
                                                                <div class="form-group row">
                                                                    <img src="{{ asset($transaction->image) }}"
                                                                        alt="{{ $transaction->image }}"
                                                                        style="width: 100px; height: 100px"
                                                                        class="border rounded">
                                                                </div>
                                                                @endisset

                                                                <div class="form-group row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group">
                                                                                    <label for="formFile"
                                                                                        class="form-label">Unggah
                                                                                        foto bukti
                                                                                        pembayaran</label>
                                                                                    <div class="input-group">
                                                                                        <div class="custom-file">
                                                                                            <input type="file"
                                                                                                class="custom-file-input"
                                                                                                id="exampleInputFile"
                                                                                                name="image">
                                                                                            <label
                                                                                                class="custom-file-label"
                                                                                                for="exampleInputFile">Choose
                                                                                                file</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Save</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    @can('isAdmin')
                                    <tfooter>
                                       <tr>
                                           <th>Total Sudah Di bayar</th>
                                           <td></td>
                                           <td>{{ 'Rp ' . number_format($totalPembayaranPaid, 0, ',', '.') }}</td>
                                           <td></td>
                                           <td></td>
                                       </tr>
                                       <tr>
                                           <th>Total Belum Dibayar</th>
                                           <td></td>
                                           <td>{{ 'Rp ' . number_format($totalPembayaranUnpaid, 0, ',', '.') }}</td>
                                           <td></td>
                                           <td></td>
                                       </tr>
                                   </tfooter>
                                   @endcan
                                </table>
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