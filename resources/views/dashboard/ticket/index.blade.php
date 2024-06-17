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
                        <h1>Harga</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Harga</li>
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
                                @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                                @endif
                                @if (session('sameTicket'))
                                <div class="alert alert-danger">
                                    {{ session('sameTicket') }}
                                </div>
                                @endif
                                @if (session('delete'))
                                <div class="alert alert-success">
                                    {{ session('delete') }}
                                </div>
                                @endif
                                @if (session('update'))
                                <div class="alert alert-success">
                                    {{ session('update') }}
                                </div>
                                @endif

                                <div class="mb-2 row">
                                    <div class="col-sm-6">
                                        <h3 class="card-title">Data Harga Tiket</h3>
                                    </div>
                                    @can('isAdmin')
                                    <div class="col-sm-6">
                                        <button class="btn btn-warning btn-sm float-sm-right" type="button"
                                            data-toggle="modal" data-target="#modal-lgharga"
                                            id="button-tambah-harga">Tambah Tiket
                                        </button>

                                        <div class="modal fade" id="modal-lgharga">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Form Tambah Tiket</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <form action="/tickets" method="POST">
                                                        @csrf
                                                        @method('POST')

                                                        <div class="modal-body">
                                                            <div class="form-group row">
                                                                <label for="transportasi_id"
                                                                    class="col-sm-2 col-form-label">Transportasi</label>
                                                                <select name="transportasi_id" id="transportasi_id"
                                                                    class="form-control col-sm-10" required>
                                                                    <option selected value="" disabled>Pilih
                                                                        Transportasi
                                                                    </option>
                                                                    @foreach ($transportasi as $transportasis)
                                                                    @if (old('transportasi_id') == $transportasis->id)
                                                                    <option value="{{ $transportasi->id }}" selected>
                                                                        {{ $transportasi->name }}</option>
                                                                    @else
                                                                    <option value="{{ $transportasis->id }}">
                                                                        {{ $transportasis->name }}</option>
                                                                    @endif
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="inputName2"
                                                                    class="col-sm-2 col-form-label">Kode Bus</label>
                                                                <input type="number" class="form-control col-sm-10"
                                                                    placeholder="Kode Bus" name='kode_bus' id='kode_bus'
                                                                    min="0" required>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="type_id"
                                                                    class="col-sm-2 col-form-label">Jenis</label>
                                                                <select name="type_id" id="type_id"
                                                                    class="form-control col-sm-10" required>
                                                                    <option selected value="" disabled>Pilih
                                                                        Jenis
                                                                    </option>
                                                                    @foreach ($types as $type)
                                                                    <option value="{{ old('type_id', $type->id) }}">
                                                                        {{ $type->name }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="track_id"
                                                                    class="col-sm-2 col-form-label">Rute</label>
                                                                <select name="track_id" id="track_id"
                                                                    class="form-control col-sm-10" 0
                                                                    onchange="getSelectValue(this.value);" required>
                                                                    <option selected value="" disabled>Pilih
                                                                        Rute
                                                                    </option>
                                                                    @foreach ($tracks as $track)
                                                                    <option value="{{ old('track_id', $track->id) }}">
                                                                        {{ $track->from_route }} -
                                                                        {{ $track->to_route }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <script type="text/javascript">
                                                                function getSelectValue(pergi) {
                                                                    if (pergi != '') {
                                                                        $("#pulang option[value='" + pergi + "']").hide();
                                                                        $("#pulang option[value!='" + pergi + "']").show();
                                                                    }
                                                                }

                                                                function getSecondValue(pulang) {
                                                                    if (pulang != '') {
                                                                        $("#pergi option[value='" + pulang + "']").hide();
                                                                        $("#pergi option[value!='" + pulang + "']").show();
                                                                    }
                                                                }
                                                            </script>

                                                            <div class="form-group row">
                                                                <label for="inputName2"
                                                                    class="col-sm-2 col-form-label">Harga</label>
                                                                <input type="number" class="form-control col-sm-10"
                                                                    placeholder="Harga Baru" name='price' id='hargaadd'
                                                                    min="0" required>
                                                            </div>

                                                            @if (session('sameTicket'))
                                                            <div class="alert alert-danger">
                                                                {{ session('sameTicket') }}
                                                            </div>
                                                            @endif
                                                        </div>


                                                        <div class="modal-footer">

                                                            <input type="submit" class="btn btn-success" name="submit"
                                                                value="Submit" />

                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    @endcan
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Transportasi</th>
                                            <th>Pergi dari</th>
                                            <th>Tujuan ke</th>
                                            <th>Jenis</th>
                                            <th>Jumlah Harga</th>
                                            @can('isAdmin')
                                            <th>Action</th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tickets as $ticket)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                @isset($ticket->transportasi->name)
                                                {{ $ticket->transportasi->name }}
                                                @else
                                                Tidak dapat ditampilkan
                                                @endisset
                                            </td>
                                            <td>
                                                @isset($ticket->track->from_route)
                                                {{ $ticket->track->from_route }}
                                                @else
                                                Tidak dapat ditampilkan
                                                @endisset
                                            </td>
                                            <td>
                                                @isset($ticket->track->to_route)
                                                {{ $ticket->track->to_route }}
                                                @else
                                                Tidak dapat ditampilkan
                                                @endisset
                                            </td>
                                            <td>
                                                @isset($ticket->type->name)
                                                {{ $ticket->type->name }}
                                                @else
                                                Tidak dapat ditampilkan
                                                @endisset
                                            </td>
                                            <td>
                                                @isset($ticket->price->price)
                                                Rp {{ $ticket->price->price }}
                                                @else
                                                Belum di set
                                                @endisset
                                            </td>
                                            @can('isAdmin')
                                            <td>
                                                <div class="flex-row mb-3 d-flex bd-highlight">
                                                    <a class='mx-1 btn btn-primary btn-sm' data-toggle="modal"
                                                    data-target="#modal-{{ $ticket->id }}"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                        fill="currentColor" class="bi bi-pencil-square"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                        <path fill-rule="evenodd"
                                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                    </svg>Ubah Harga</a>
                                                    <form onsubmit="return confirmHapus(event)"
                                                    action="/tracks/{{ $ticket->id  }}" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <svg class="bi bi-trash-fill" width="1em" height="1em"
                                                            fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                        HAPUS
                                                    </button>
                                                </form>
                                       
                                                </div>
                                            </td>
                                            @endcan
                                            <div class="modal fade" id="modal-{{ $ticket->id }}">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Form Ubah Harga</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <form action="/prices/{{ $ticket->price->id }}"
                                                                method="POST">
                                                                @method('PUT')
                                                                @csrf
                                                                <div class="form-group row">
                                                                    <label for="inputName2"
                                                                        class="col-sm-2 col-form-label">Harga
                                                                        Lama</label>

                                                                    <label for="inputName2"
                                                                        class="col-sm-2 col-form-label">
                                                                        @if ($ticket->price->price)
                                                                        {{ $ticket->price->price }}
                                                                        @else
                                                                        Not Set Yet
                                                                        @endif
                                                                    </label>
                                                                </div>


                                                                <div class="form-group row">
                                                                    <label for="inputName2"
                                                                        class="col-sm-2 col-form-label">Harga
                                                                        Baru</label>
                                                                    <input type="number"
                                                                        class="col-sm-3 form-control col-sm-10"
                                                                        placeholder="Harga Baru" name='price'
                                                                        id='hargaadd' required>
                                                                </div>

                                                                <input type="submit" class="btn btn-success" />

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
@endsection