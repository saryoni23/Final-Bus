@extends('layouts.front')

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 content-wrapper">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Content Wrapper. Contains page content -->
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Kelas Transportasi</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                                    <li class="breadcrumb-item active">Kelas Transportasi</li>
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

                                        <div class="row mb-2">
                                            <div class="col-sm-6">
                                                <h3 class="card-title">Data Kelas Transportasi</h3>
                                            </div>
                                            @can('isAdmin')
                                            <div class="col-sm-6">
                                                <button class="btn btn-warning btn-sm float-sm-right" type="button"
                                                    data-toggle="modal" data-target="#modal-tambah-type"
                                                    id="button-tambah-harga">Tambah Kelas Transportasi
                                                </button>

                                                <div class="modal fade" id="modal-tambah-type">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Form Tambah Kelas Transportasi
                                                                </h4>
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
                                                                            Transportasi</label>
                                                                        <input type="text"
                                                                            class="col-sm-10 form-control" name="name"
                                                                            placeholder="Masukkan Kelas Transportasi">
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label class="col-sm-2 col-form-label">Jam
                                                                            Berangkat</label>
                                                                        <input type="text"
                                                                            class="col-sm-10 form-control"
                                                                            name="flight_at"
                                                                            placeholder="Masukkan Jam Berangkat (Jam:Menit:Detik)">
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <input type="submit" class="btn btn-success"
                                                                        name="submit" value="Submit" />
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
                                                    <th>Kelas Transportasi</th>
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
                                                        <a class='btn btn-primary btn-xs mx-1' data-toggle="modal"
                                                            data-target="#modal-ubah-{{ $type->id }}">Ubah</a>
                                                        <form action="/types/{{ $type->id }}" method="POST"
                                                            onsubmit="return confirm('Yakin ingin menghapus?');">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button class='btn btn-danger btn-xs mx-1'>Delete</button>
                                                        </form>
                                                    </td>
                                                    <div class="modal fade" id="modal-ubah-{{ $type->id }}">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Form Ubah Data Transportasi
                                                                    </h4>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form action="/types/{{ $type->id }}" method="POST">
                                                                    @csrf
                                                                    @method('PUT')

                                                                    <div class="modal-body">
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-2 col-form-label">Kelas
                                                                                Transportasi</label>
                                                                            <input type="text"
                                                                                class="col-sm-10 form-control"
                                                                                name="name"
                                                                                placeholder="Masukkan Kelas Transportasi"
                                                                                value="{{ old('name', $type->name) }}">
                                                                        </div>

                                                                        <div class="form-group row">
                                                                            <label class="col-sm-2 col-form-label">Jam
                                                                                Berangkat</label>
                                                                            <input type="date"
                                                                                class="col-sm-10 form-control"
                                                                                name="flight_at"
                                                                                placeholder="Masukkan Jam Berangkat (HH:MM:SS)"
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

        </div>
    </div>

</x-app-layout>