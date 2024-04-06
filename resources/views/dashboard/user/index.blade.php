<x-app-layout>
    @extends('layouts.front')
    <div class="py-12">
        <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8 content-wrapper">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Content Wrapper. Contains page content -->
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>User</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                                    <li class="breadcrumb-item active">User</li>
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
                                                        @isset($user->profile_photo_path)
                                                        <img class="h-10 w-10 rounded-full object-cover"
                                                            src="{{ $user->profile_photo_url }}"
                                                            alt="{{ $user->name }}" />
                                                        @else
                                                        Belum di set
                                                        @endisset
                                                    </td>
                                                    <td>
                                                        @isset($user->role)
                                                        {{ $user->role }}
                                                        @endisset
                                                    </td>
                                                    <td class="p-4 space-x-2 whitespace-nowrap max-w-sm">
                                                        <div
                                                            class="text-sm text-gray-900 dark:text-white h-full inline-flex justify-between items-baseline space-x-2">
                                                            <!-- Tampilkan peran pengguna -->
                                                            <span
                                                                class="text-xs bg-gray-200 text-gray-800 px-2 py-1 rounded-md">{{ $user->role }}</span>
                    
                                                            <!-- Tampilkan tombol Edit, Hapus, Up, dan Down sesuai dengan peran pengguna -->
                                                            @if($user->role == 'admin')
                                                            <!-- Jika peran adalah admin, tidak ada tombol -->
                                                            <div
                                                                class="text-sm text-gray-900 dark:text-white h-full inline-flex justify-between items-baseline space-x-2">
                                                                <span class="text-sm font-medium text-gray-500">Tidak ada aksi yang
                                                                    tersedia</span>
                                                            </div>
                                                            @elseif($user->role == 'karyawan')
                                                            <!-- Jika peran adalah karyawan, tampilkan tombol Edit, Hapus, dan Down -->
                                                            <div
                                                                class="text-sm text-gray-900 dark:text-white h-full inline-flex justify-between items-baseline space-x-2">
                                                                
                                                                <form onsubmit="return confirmHapus(event)"
                                                                    action="/users/{{ $user->id }}" method="POST">
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
                                                                <form id="form-downrole-{{ $user->id }}" action="/downrole/{{ $user->id }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <button type="button" onclick="confirmDown({{ $user->id }})"
                                                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                                                                        <svg class="w-4 h-4 text-gray-800 dark:text-white"
                                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                            fill="none" viewBox="0 0 24 24">
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
                                                            <div
                                                                class="text-sm text-gray-900 dark:text-white h-full inline-flex justify-between items-baseline space-x-2">
                                                                <form id="form-uprole-{{ $user->id }}" action="/uprole/{{ $user->id }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <button type="button" onclick="confirmUp({{$user->id}})"
                                                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-yellow-600 rounded-lg hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 dark:focus:ring-yellow-900">
                                                                        <svg class="w-4 h-4 text-gray-800 dark:text-white"
                                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                            fill="none" viewBox="0 0 24 24">
                                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="2"
                                                                                d="m16 17-4-4-4 4m8-6-4-4-4 4" />
                                                                        </svg>
                                                                        Up
                                                                    </button>
                                                                </form>
                    
                                                                <a href="{{$user->id }}"
                                                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z">
                                                                        </path>
                                                                        <path fill-rule="evenodd"
                                                                            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                                            clip-rule="evenodd"></path>
                                                                    </svg>EDIT</a>
                    
                                                                <form onsubmit="return confirmHapus(event)"
                                                                    action="/users/{{  $user->id }}" method="POST">
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
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </td>


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

</x-app-layout>