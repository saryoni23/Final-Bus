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
                        <h1>Kelas transportasi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Kelas transportasi</li>
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
                                @if (session('update'))
                                <div class="alert alert-success">
                                    {{ session('update') }}
                                </div>
                                @endif

                                @if (session('delete'))
                                <div class="alert alert-success">
                                    {{ session('delete') }}
                                </div>
                                @endif

                                @if (session('store'))
                                <div class="alert alert-success">
                                    {{ session('store') }}
                                </div>
                                @endif

                                @if (session('sameType'))
                                <div class="alert alert-danger">
                                    {{ session('sameType') }}
                                </div>
                                @endif

                                <div class="mb-2 row">
                                    <div class="col-sm-6">
                                        <h3 class="card-title">Data Kelas transportasi</h3>
                                    </div>
                                    @can('isAdmin')
                                    <div class="col-sm-6">
                                        <button class="btn btn-warning btn-sm float-sm-right" type="button"
                                            data-toggle="modal" data-target="#modal-tambah-type"
                                            id="button-tambah-harga">Tambah Kelas transportasi
                                        </button>

                                        <div class="modal fade" id="modal-tambah-type">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Form Tambah Kelas transportasi</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <form action="/types" method="POST">
                                                        @csrf
                                                        @method('POST')

                                                        <div class="modal-body">
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Kelas
                                                                    transportasi</label>
                                                                <input type="text" class="col-sm-10 form-control"
                                                                    name="name"
                                                                    placeholder="Masukkan Kelas transportasi">
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Jam Berangkat</label>
                                                                <input type="text" class="col-sm-10 form-control"
                                                                    name="flight_at"
                                                                    placeholder="Masukkan jam berangkat (HH:MM:SS)">
                                                            </div>
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
                                            <th>ID</th>
                                            <th>Kelas transportasi</th>
                                            <th>Jam Berangkat</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($types as $type)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                @isset($type->id)
                                                {{ $type->id }}
                                                @endisset
                                            </td>
                                            <td>
                                                @isset($type->name)
                                                {{ $type->name }}
                                                @endisset
                                            </td>
                                            <td>
                                                @isset($type->flight_at)
                                                {{ $type->flight_at }}
                                                @endisset
                                            </td>
                                            <td>
                                                <a class='mx-1 btn btn-primary btn-xs' data-toggle="modal"
                                                    data-target="#modal-ubah-{{ $type->id }}">Ubah</a>
                                                <form action="/types/{{ $type->id }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus?');">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class='mx-1 btn btn-danger btn-xs'>Delete</button>
                                                </form>
                                            </td>
                                            <div class="modal fade" id="modal-ubah-{{ $type->id }}">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Form Ubah Data transportasi</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="/types/{{ $type->id }}" method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="modal-body">
                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">Kelas
                                                                        transportasi</label>
                                                                    <input type="text" class="col-sm-10 form-control"
                                                                        name="name"
                                                                        placeholder="Masukkan Kelas transportasi"
                                                                        value="{{ old('name', $type->name) }}">
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">Jam
                                                                        Terbang</label>
                                                                    <input type="text" class="col-sm-10 form-control"
                                                                        name="flight_at"
                                                                        placeholder="Masukkan jam berangkat (HH:MM:SS)"
                                                                        value="{{ old('flight_at', $type->flight_at) }}">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="submit" class="btn btn-success"
                                                                    name="submit" />
                                                            </div>
                                                        </form>
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