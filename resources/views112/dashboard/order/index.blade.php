@extends('layouts.front')
<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 content-wrapper">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <!-- Content Wrapper. Contains page content -->

                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <h1>Riwayat Pesanan</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="/">Home</a></li>
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
                                                            <button
                                                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:ring-green-300 dark:focus:ring-green-900"
                                                                type="button">Wa</button>
                                                        </a>
                                                    </td>
                                                    @endcan
                                                    @can('isKaryawan')
                                                    <td>

                                                        <a href="https://wa.me/62{{ $order->user->no_hp}}"
                                                            target="_blank">
                                                            <button
                                                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-800 focus:ring-4 focus:ring-green-300 dark:focus:ring-green-900"
                                                                type="button">Wa</button>
                                                        </a>
                                                    </td>
                                                    @endcan
                                                    <td class='flex-row items-center space-y-3'>
                                                        @can('isAdmin')
                                                        <a href="/print?order={{ $order->order_code }}" target="_blank">
                                                            <button
                                                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900"
                                                                type="button">Cetak</button>
                                                        </a>
                                                        @else
                                                        @if ($order->transaction->status == 'paid')
                                                        <a href="/print?order={{ $order->order_code }}" target="_blank">
                                                            <button
                                                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900"
                                                                type="button">Cetak</button>
                                                        </a>
                                                        @endif
                                                        @endcan

                                                        @can('isCustomer')
                                                        @if ($order->transaction->status == false)
                                                        <form onsubmit="return confirmHapus(event)"
                                                            action="orders/{{ $order->id }}" method="POST">
                                                            @csrf @method('DELETE')
                                                            <button type="submit"
                                                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                                                <svg class="w-4 h-4 mr-2" fill="currentColor"
                                                                    viewBox="0 0 20 20"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd"
                                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                        clip-rule="evenodd"></path>
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
                                                        <form onsubmit="return confirmHapus(event)"
                                                            action="orders/{{ $order->id }}" method="POST">
                                                            @csrf @method('DELETE')
                                                            <button type="submit"
                                                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                                                <svg class="w-4 h-4 mr-2" fill="currentColor"
                                                                    viewBox="0 0 20 20"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd"
                                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                        clip-rule="evenodd"></path>
                                                                </svg>
                                                                @can('is_admin')
                                                                Hapus
                                                                @else
                                                                Batal
                                                                @endcan
                                                            </button>
                                                        </form>
                                                        @endcan


                                                        <button
                                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-yellow-400 rounded-lg hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 dark:focus:ring-yellow-900"
                                                            type="button" data-toggle="modal"
                                                            data-target="#modal-lapor-{{ $order->id }}"
                                                            id="button-{{ $order->id }}">Lapor


                                                            @can('isCustomer')
                                                            @if ($order->complaints->where('seenForAdmin', 0)->count()
                                                            != 0)
                                                            <span
                                                                class="top-0 position-absolute start-100 translate-middle badge rounded-pill bg-danger">
                                                                {{ $order->complaints->where('seenForAdmin', 0)->count()
                                                                }}
                                                            </span>
                                                            @endif
                                                            @else
                                                            @if ($order->complaints->where('seen', 0)->count() != 0)
                                                            <span
                                                                class="top-0 position-absolute start-100 translate-middle badge rounded-pill bg-danger">
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
        </div>
    </div>
    <script>
        function confirmHapus(event) {
            event.preventDefault(); // Menghentikan form dari pengiriman langsung

            Swal.fire({
                title: 'Yakin Hapus Data?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                theme: 'dark',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
            }).then((willDelete) => {
                if (willDelete.isConfirmed) {
                    event.target.submit(); // Melanjutkan pengiriman form
                } else {
                    swal('Your imaginary file is safe!');
                }
            });
        }
    </script>
</x-app-layout>