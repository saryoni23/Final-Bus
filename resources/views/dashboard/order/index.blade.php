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
                        <h1>Riwayat Pesanan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Riwayat Pesanan</li>
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
                        @if (session('hapus'))
                        <div class="alert alert-success" role="alert">
                            {{ session('hapus') }}
                        </div>
                        @endif

                        @if (session('lapor'))
                        <div class="alert alert-success" role="alert">
                            {{ session('lapor') }}
                        </div>
                        @endif

                        @if (session('paymentCheckFailed'))
                        <div class="alert alert-warning" role="alert">
                            {{ session('paymentCheckFailed') }}
                        </div>
                        @endif

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Riwayat Pesanan</h3>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>

                                        <tr>
                                            <th>No</th>
                                            <th>ID Booking</th>
                                            <th>Nama</th>
                                            <th>Transportasi</th>
                                            <th>Kelas Transportasi</th>
                                            <th>Rute</th>
                                            <th>Jumlah Tiket</th>
                                            <!-- <th>Pulang-Pergi</th> -->
                                            <th>Tanggal</th>
                                            @can('isAdmin')
                                            <th>Wa</th>
                                            @endcan
                                            @can('isKaryawan')
                                            <th>Wa</th>
                                            @endcan
                                            <th>Action</th>
                                        </tr>


                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                @isset($order->order_code)
                                                {{ $order->order_code }}
                                                @else
                                                Tidak dapat ditampilkan
                                                @endisset
                                            </td>
                                            <td>
                                                @isset($order->user->name)
                                                {{ $order->user->name }}
                                                @else
                                                Tidak dapat ditampilkan
                                                @endisset

                                            </td>
                                            <td>
                                                @isset($order->ticket->transportasi->name)
                                                {{ $order->ticket->transportasi->name }}
                                                @else
                                                Tidak dapat ditampilkan
                                                @endisset

                                            </td>
                                            <td>
                                                @isset($order->ticket->type->name)
                                                {{ $order->ticket->type->name }}
                                                @else
                                                Tidak dapat ditampilkan
                                                @endisset

                                            </td>
                                            <td>
                                                @isset($order->ticket->track->from_route)
                                                @isset($order->ticket->track->to_route)
                                                {{ $order->ticket->track->from_route }} -
                                                {{ $order->ticket->track->to_route }}
                                                @endisset
                                                @else
                                                Tidak dapat ditampilkan
                                                @endisset

                                            </td>
                                            <td>
                                                @isset($order->amount)
                                                {{ $order->amount }}
                                                @else
                                                Tidak dapat ditampilkan
                                                @endisset

                                            </td>
                                            <!-- <td>
                                                @isset($order->round_trip)
                                                Tidak
                                                @else
                                                Ya
                                                @endisset

                                            </td> -->
                                            <td>
                                                @isset($order->updated_at)
                                                {{ $order->updated_at }}
                                                @else
                                                Tidak dapat ditampilkan
                                                @endisset

                                            </td>
                                            @can('isAdmin')
                                            <td>

                                                <a href="https://wa.me/62{{ $order->user->no_hp}}"
                                                    target="_blank">
                                                    <button class="btn btn-success btn-sm" type="button">Wa</button>

                                                </a>
                                            </td>
                                            @endcan
                                            @can('isKaryawan')
                                            <td>

                                                <a href="https://wa.me/62{{ $order->user->no_hp}}"
                                                    target="_blank">
                                                    <button class="btn btn-success btn-sm" type="button">Wa</button>

                                                </a>
                                            </td>
                                            @endcan
                                            <td class='flex-row items-center space-y-3'>
                                                @can('isAdmin')
                                                <a href="/print?order={{ $order->order_code }}" target="_blank">
                                                    <button class="btn btn-primary btn-sm" type="button">Cetak</button>

                                                </a>
                                                @else
                                                @if ($order->transaction->status == 'paid')
                                                <a href="/print?order={{ $order->order_code }}" target="_blank">
                                                    <button class="btn btn-primary btn-sm" type="button">Cetak</button>

                                                </a>
                                                @endif
                                                @endcan

                                                @can('isCustomer')
                                                @if ($order->transaction->status == false)
                                                    <form onsubmit="return confirmHapus(event)" action="orders/{{ $order->id }}" method="POST">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm d-inline-flex align-items-center">
                                                            <svg class="mr-2 bi bi-trash" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M5.5 5.5a.5.5 0 01.5-.5H10a.5.5 0 01.5.5V6h3a.5.5 0 010 1h-1v9a2 2 0 01-2 2H6a2 2 0 01-2-2V7H3a.5.5 0 010-1h3v-.5zM7 8a.5.5 0 011 0v6a.5.5 0 01-1 0V8zm4 0a.5.5 0 011 0v6a.5.5 0 01-1 0V8zM4.5 2a.5.5 0 00-.5.5V3H2.5a.5.5 0 000 1H3v1h10V4h.5a.5.5 0 000-1H12v-.5a.5.5 0 00-.5-.5H4.5zm3 1a.5.5 0 000 1h1a.5.5 0 000-1h-1z" fill-rule="evenodd"></path>
                                                            </svg>
                                                            @can('is_admin')
                                                                Hapus
                                                            @else
                                                                Batal
                                                            @endcan
                                                        </button>
                                                    </form>
                                                @endif
                                            @else
                                                <form onsubmit="return confirmHapus(event)" action="orders/{{ $order->id }}" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm d-inline-flex align-items-center">
                                                        <svg class="mr-2 bi bi-trash" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M5.5 5.5a.5.5 0 01.5-.5H10a.5.5 0 01.5.5V6h3a.5.5 0 010 1h-1v9a2 2 0 01-2 2H6a2 2 0 01-2-2V7H3a.5.5 0 010-1h3v-.5zM7 8a.5.5 0 011 0v6a.5.5 0 01-1 0V8zm4 0a.5.5 0 011 0v6a.5.5 0 01-1 0V8zM4.5 2a.5.5 0 00-.5.5V3H2.5a.5.5 0 000 1H3v1h10V4h.5a.5.5 0 000-1H12v-.5a.5.5 0 00-.5-.5H4.5zm3 1a.5.5 0 000 1h1a.5.5 0 000-1h-1z" fill-rule="evenodd"></path>
                                                        </svg>
                                                        @can('is_admin')
                                                            Hapus
                                                        @else
                                                            Batal
                                                        @endcan
                                                    </button>
                                                </form>
                                            @endcan
                                            

                                                <style>
                                                    .btn-custom-yellow {
                                                        background-color: #facc15; /* Tailwind bg-yellow-400 */
                                                        border-color: #facc15;
                                                        color: white;
                                                    }
                                                    .btn-custom-yellow:hover {
                                                        background-color: #854d0e; /* Tailwind hover:bg-yellow-800 */
                                                        border-color: #854d0e;
                                                    }
                                                    .btn-custom-yellow:focus {
                                                        box-shadow: 0 0 0 0.2rem rgba(250, 204, 21, 0.5); /* Tailwind focus:ring-yellow-300 */
                                                    }
                                                    .btn-custom-yellow-dark:focus {
                                                        box-shadow: 0 0 0 0.2rem rgba(133, 77, 14, 0.5); /* Tailwind dark:focus:ring-yellow-900 */
                                                    }
                                                </style>
                                                
                                                <button
                                                    class="btn btn-custom-yellow btn-sm position-relative"
                                                    type="button"
                                                    data-toggle="modal"
                                                    data-target="#modal-lapor-{{ $order->id }}"
                                                    id="button-{{ $order->id }}">Lapor
                                                
                                                    @can('isCustomer')
                                                        @if ($order->complaints->where('seenForAdmin', 0)->count() != 0)
                                                            <span class="top-0 position-absolute start-100 translate-middle badge rounded-pill bg-danger">
                                                                {{ $order->complaints->where('seenForAdmin', 0)->count() }}
                                                            </span>
                                                        @endif
                                                    @else
                                                        @if ($order->complaints->where('seen', 0)->count() != 0)
                                                            <span class="top-0 position-absolute start-100 translate-middle badge rounded-pill bg-danger">
                                                                {{ $order->complaints->where('seen', 0)->count() }}
                                                            </span>
                                                        @endif
                                                    @endcan
                                                </button>
                                                


                                                <div class="modal fade" id="modal-lapor-{{ $order->id }}">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Form Pengaduan</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body d-flex flex-column">
                                                                @foreach ($order->complaints as $complaint)
                                                                <div
                                                                    class="d-flex flex-row align-items-center mb-2 
                                                                    @if ($complaint->user->id == Auth::id()) justify-content-end @endif">
                                                                    <!-- <img src="{{ $complaint->user->profile_photo_path }}"
                                                                        alt="{{ $complaint->user->name }}"
                                                                        style="max-width: 30px; max-height: 30px"
                                                                        class="mx-2 rounded-circle"> -->
                                                                    <label class="my-1">{{
                                                                        $complaint->user->name }}</label>
                                                                </div>
                                                                <p
                                                                    class="p-2 mx-2 mb-4 border rounded fw-normal">
                                                                    {{ $complaint->body }}</p>
                                                                @endforeach
                                                            </div>

                                                            <form action="/complaints" method="POST">
                                                                @csrf
                                                                @method('POST')

                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <label for="phone_number"
                                                                            class="col-sm-3 col-form-label">Kirim
                                                                            pesan
                                                                            baru: </label>
                                                                        <input type="text"
                                                                            class="form-control col-sm-7"
                                                                            name="body" required>
                                                                        <input type="hidden" value={{ $order->id
                                                                        }}
                                                                        name="order_id">
                                                                        <input type="submit"
                                                                            class="btn btn-success col-sm-2"
                                                                            name="submit" value="Submit" />
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
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