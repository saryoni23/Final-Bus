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
                        <h1>Users</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Users</li>
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

                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12 d-flex justify-content-between">
                                        <h3 class="card-title">Data Seluruh User</h3>
                                    </div>
                                </div>


                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <!-- <th>Email Verifikasi</th> -->
                                            <th>Nomor Telepon</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Foto Profil</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                @isset($user->name)
                                                {{ $user->name }}
                                                @endisset
                                            </td>
                                            <td>
                                                @isset($user->email)
                                                {{ $user->email }}
                                                @endisset
                                            </td>
                                            <!-- <td>
                                                @isset($user->email_verified_at)
                                                {{ $user->email_verified_at }}
                                                @else
                                                Belum terverifikasi
                                                @endisset
                                            </td> -->
                                            <td>
                                                @isset($user->no_hp)
                                                {{ $user->no_hp }}
                                                @else
                                                Belum di set
                                                @endisset

                                            </td>
                                            <td>
                                                @isset($user->gender)
                                                {{ $user->gender }}
                                                @else
                                                Belum di set
                                                @endisset
                                            </td>
                                            <td>
                                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())

                                                <img class="object-cover rounded-full" width='200px'
                                                    src="{{ $user->profile_photo_url }}"
                                                    alt="{{ $user->name }}" />

                                                @else
                                                <span class="inline-flex rounded-md">
                                                    {{  $user->name }}
                                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                    </svg>
                                                    </button>
                                                </span>
                                                @endif
                                            </td>
                                            <td>

                                                @isset($user->role)
                                                <span class="badge bg-secondary">{{ $user->role }}</span>
                                                @endisset
                                            </td>
                                            <td class="max-w-sm p-4 space-x-2 whitespace-nowrap">
                                                <div class="d-flex justify-content-between align-items-baseline">
                                                    <!-- Tampilkan peran pengguna -->
                                                  

                                                    <!-- Tampilkan tombol Edit, Hapus, Up, dan Down sesuai dengan peran pengguna -->
                                                    @if($user->role == 'admin')
                                                    <!-- Jika peran adalah admin, tidak ada tombol -->
                                                    <div class="text-muted">Tidak ada aksi yang tersedia</div>
                                                    @elseif($user->role == 'karyawan')
                                                    <!-- Jika peran adalah karyawan, tampilkan tombol Edit, Hapus, dan Down -->

                                                        <div class="flex-row mb-3 d-flex bd-highlight">
                                                        <form onsubmit="return confirmHapus(event)"
                                                            action="/users/{{ $user->id }}" method="POST">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <svg class="bi bi-trash-fill" width="1em" height="1em"
                                                                    fill="currentColor"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd"
                                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                        clip-rule="evenodd"></path>
                                                                </svg>
                                                                HAPUS
                                                            </button>
                                                        </form>
                                                        <form id="form-downrole-{{ $user->id }}"
                                                            action="/downrole/{{ $user->id }}" method="POST">
                                                            @csrf
                                                            <button type="button" onclick="confirmDown({{ $user->id }})"
                                                                class="btn btn-primary btn-sm">
                                                                <svg class="bi bi-arrow-down" width="1em" height="1em"
                                                                    fill="currentColor"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke="currentColor" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="m16 7-4 4-4-4m8 6-4 4-4-4" />
                                                                </svg>
                                                                Down
                                                            </button>
                                                        </form>
                                                    </div>
                                                    @else
                                                    <!-- Jika peran adalah user, tampilkan tombol Up, Edit, dan Hapus -->
                                                    <div class="d-flex justify-content-between align-items-baseline">
                                                        <form id="form-uprole-{{ $user->id }}"
                                                            action="/uprole/{{ $user->id }}" method="POST">
                                                            @csrf
                                                            <button type="button" onclick="confirmUp({{$user->id}})"
                                                                class="btn btn-warning btn-sm">
                                                                <svg class="bi bi-arrow-up" width="1em" height="1em"
                                                                    fill="currentColor"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke="currentColor" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="m16 17-4-4-4 4m8-6-4-4-4 4" />
                                                                </svg>
                                                                Up
                                                            </button>
                                                        </form>

                                                        <!-- <a href="users/{{$user->id }}" class="btn btn-primary btn-sm">
                                                            <svg class="bi bi-pencil-fill" width="1em" height="1em"
                                                                fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 0 20 20">
                                                                <path
                                                                    d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z">
                                                                </path>
                                                                <path fill-rule="evenodd"
                                                                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                            EDIT
                                                        </a> -->

                                                        <form onsubmit="return confirmHapus(event)"
                                                            action="/users/{{ $user->id }}" method="POST">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <svg class="bi bi-trash-fill" width="1em" height="1em"
                                                                    fill="currentColor"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd"
                                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                        clip-rule="evenodd"></path>
                                                                </svg>
                                                                HAPUS
                                                            </button>
                                                        </form>
                                                    </div>
                                                    @endif
                                                </div>
                                            </td>



                                            <!-- <div class="modal fade" id="modal-user-{{ $user->id }}">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Form Ubah Data User</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <form action="/users/{{ $user->id }}" method="POST"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="modal-body">
                                                                <div class="form-group row">
                                                                    <label for="name"
                                                                        class="col-sm-2 col-form-label">Nama:</label>
                                                                    <input type="text" class="form-control1"
                                                                        value="{{ old('name', $user->name) }}"
                                                                        name="name" required>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label for="email"
                                                                        class="col-sm-2 col-form-label">Email:</label>
                                                                    <input type="email" class="form-control1"
                                                                        value="{{ old('email', $user->email) }}"
                                                                        disabled>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label for="no_hp"
                                                                        class="col-sm-2 col-form-label">Nomor
                                                                        Telepon:</label>
                                                                    <input type="text" class="form-control1"
                                                                        value="{{ old('no_hp', $user->no_hp) }}"
                                                                        name="no_hp" required>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label for="gender"
                                                                        class="col-sm-2 col-form-label">Jenis:</label>
                                                                    <select name="gender" id="gender"
                                                                        class="form-control1" required>
                                                                        <option selected value="" disabled>
                                                                            Pilih Jenis
                                                                        </option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group column">
                                                                    <label for="image"
                                                                        class="col-sm-2 col-form-label">Poto
                                                                        Profil:</label>

                                                                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())

                                                                        <img class="object-cover w-8 h-8 rounded-full"
                                                                            src="{{ Auth::user()->profile_photo_url }}"
                                                                            alt="{{ Auth::user()->name }}" />
                        
                                                                        @else
                                                                        <span class="inline-flex rounded-md">
                                                                            {{ Auth::user()->name }}
                                                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                                                stroke="currentColor">
                                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                                            </svg>
                                                                            </button>
                                                                        </span>
                                                                        @endif
                                                                    <input type="file" class="form-control1"
                                                                        name="image">
                                                                </div>
                                                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="submit" class="btn btn-success" />
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </tr>
                                        @endforeach
                                    </tbody>
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

    function confirmUp(itemId) {
        Swal.fire({
            title: 'Yakin ingin Mengangkat User Menjadi Karyawan?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-uprole-' + itemId)
                    .submit(); // Submit form jika pengguna menekan "Ya"
            }
        });
    }

    function confirmDown(itemId) {
    Swal.fire({
        title: 'Yakin ingin Menurunkan Karyawan Menjadi Customer?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('form-downrole-' + itemId)
                .submit(); // Submit form jika pengguna menekan "Ya"
        }
    });
}


</script>
@endsection