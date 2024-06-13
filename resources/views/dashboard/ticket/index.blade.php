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
                                                <a class='mx-1 btn btn-primary btn-xs' data-toggle="modal"
                                                    data-target="#modal-{{ $ticket->id }}">Ubah Harga</a>
                                                <form action="/tickets/{{ $ticket->id }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus?');">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class='mx-1 btn btn-danger btn-xs'>Delete</button>
                                                </form>
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
@endsection