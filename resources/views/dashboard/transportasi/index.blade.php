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
                                <h1>Transportasi</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                                    <li class="breadcrumb-item active">Transportasi</li>
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

                                        @if (session('sameTransportasi'))
                                        <div class="alert alert-danger">
                                            {{ session('sameTransportasi') }}
                                        </div>
                                        @endif

                                        <div class="row mb-2">
                                            <div class="col-sm-6">
                                                <h3 class="card-title">Data Transportasi</h3>
                                            </div>
                                            @can('isAdmin')
                                            <div class="col-sm-6">
                                                <button class="btn btn-warning btn-sm float-sm-right" type="button"
                                                    data-toggle="modal" data-target="#modal-tambah-transportasi"
                                                    id="button-tambah-harga">Tambah Transportasi
                                                </button>

                                                <div class="modal fade" id="modal-tambah-transportasi">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Form Tambah Transportasi
                                                                </h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <form action="/transportasi" method="POST">
                                                                @csrf
                                                                @method('POST')

                                                                <div class="modal-body">
                                                                    <div class="form-group row">
                                                                        <label for="transportasi_id"
                                                                            class="col-sm-2 col-form-label">Transportasi</label>
                                                                        <input type="text"
                                                                            class="col-sm-10 form-control" name="name"
                                                                            placeholder="Masukkan Nama Transportasi">
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="transportasi_id"
                                                                            class="col-sm-2 col-form-label">Kode</label>
                                                                        <input type="text"
                                                                            class="col-sm-10 form-control" name="kode"
                                                                            placeholder="Masukkan Kode">
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
                                                    <!-- <th>ID</th> -->
                                                    <th>Nama Transportasi</th>
                                                    <th>Kode</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($transportasi as $transportasis)
                                                <tr>
                                                    <td>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <!-- <td>
                                                        @isset($transportasis->id)
                                                        {{ $transportasis->id }}
                                                        @endisset
                                                    </td> -->
                                                    <td>
                                                        @isset($transportasis->name)
                                                        {{ $transportasis->name }}
                                                        @endisset
                                                    </td>
                                                    <td>
                                                        @isset($transportasis->kode)
                                                        {{ $transportasis->kode }}
                                                        @endisset
                                                    </td>
                                                    <td>
                                                        <a class='btn btn-primary btn-xs mx-1' data-toggle="modal"
                                                            data-target="#modal-ubah-{{ $transportasis->id }}">Ubah</a>
                                                        <form action="/transportasi/{{ $transportasis->id }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Yakin ingin menghapus?');">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button class='btn btn-danger btn-xs mx-1'>Delete</button>
                                                        </form>
                                                        
                                                    </td>
                                                    <td class='flex space-x-3'>
                                                        <a class='inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900' data-toggle="modal"
                                                            data-target="#modal-ubah-{{ $track->id }}">Ubah</a>
                                                        
                                                        <form onsubmit="return confirmHapus(event)"
                                                                    action="/tracks/{{ $track->id }}" method="POST">
                                                                    @csrf @method('DELETE')
                                                                    <button type="submit"
                                                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path fill-rule="evenodd"
                                                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                                clip-rule="evenodd"></path>
                                                                        </svg>
                                                                        HAPUS
                                                                    </button>
                                                                </form>
                                                    </td>
                                                    <div class="modal fade" id="modal-ubah-{{ $transportasis->id }}">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Form Ubah Data
                                                                        Transportasi</h4>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form action="/transportasi/{{ $transportasis->id }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')

                                                                    <div class="modal-body">
                                                                        <div class="form-group row">
                                                                            <label for="transportasi_id"
                                                                                class="col-sm-2 col-form-label">Transportasi</label>
                                                                            <input type="text"
                                                                                class="col-sm-10 form-control"
                                                                                name="name"
                                                                                placeholder="Masukkan Nama Transportasi"
                                                                                value="{{ old('name', $transportasis->name) }}">
                                                                        </div>

                                                                        <div class="form-group row">
                                                                            <label for="transportasi_id"
                                                                                class="col-sm-2 col-form-label">Kode</label>
                                                                            <input type="text"
                                                                                class="col-sm-10 form-control"
                                                                                name="kode" placeholder="Masukkan Kode"
                                                                                value="{{ old('kode', $transportasis->kode) }}">
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

        </div>
    </div>

</x-app-layout>