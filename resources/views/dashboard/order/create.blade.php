@php
$routeFrom = [];
$routeTo = [];

foreach ($routes as $route) {
array_push($routeFrom, $route->from_route);
array_push($routeTo, $route->to_route);
}

$routeFrom = array_unique($routeFrom);
$routeTo = array_unique($routeTo);

@endphp

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
                                <h1>Pesanan</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                                    <li class="breadcrumb-item active">Pesanan</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-12">
                                @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                                @endif

                                @if (session('ticketNotFound1'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('ticketNotFound1') }}
                                </div>
                                @endif

                                @if (session('ticketNotFound2'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('ticketNotFound2') }}
                                </div>
                                @endif
                                <!-- Pesanan elements disabled -->
                                <div class="card card-warning">
                                    <div class="card-header">
                                        <h3 class="card-title">Form Pesanan</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <form action="/orders" method="POST">
                                        @csrf
                                        @method('POST')
                                        <div class="card-body">
                                            <h4>Data Tiket</h4>

                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Rute :</label>
                                                <div class="col-sm-5">
                                                    <select class="form-control" id="keberangkatan"
                                                        onchange="getSelectValue(this.value);" name="from_route"
                                                        required>
                                                        @if (old('from_route'))
                                                        <option value="{{ old('from_route') }}">
                                                            {{ old('from_route') }}
                                                        </option>
                                                        @else
                                                        <option disabled selected>-- Pilih Keberangkatan --
                                                        </option>
                                                        @endif

                                                        @foreach ($routeFrom as $rf)
                                                        @if ($rf != old('from_route'))
                                                        <option value="{{ $rf }}">
                                                            {{ ucfirst($rf) }}
                                                        </option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('from_route'))
                                                    <div class="invalid-feedback">
                                                        Pilih lokasi berangkat dengan benar!
                                                    </div>
                                                    @endif

                                                </div>
                                                <div class="col-sm-5">
                                                    <select class="form-control" id="tujuan"
                                                        onchange="getSecondValue(this.value);" name="to_route" required>
                                                        @if (old('to_route'))
                                                        <option value="{{ old('to_route') }}">
                                                            {{ old('to_route') }}
                                                        </option>
                                                        @else
                                                        <option disabled selected>-- Pilih Tujuan --</option>
                                                        @endif

                                                        @foreach ($routeTo as $rt)
                                                        @if ($rf != old('to_route'))
                                                        <option value="{{ $rt }}">
                                                            {{ ucfirst($rt) }}
                                                        </option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('to_route'))
                                                    <div class="invalid-feedback">
                                                        Pilih lokasi tujuan dengan benar!
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <script type="text/javascript">
                                                function getSelectValue(keberangkatan) {
                                                    if (keberangkatan != '') {
                                                        $("#tujuan option[value='" + keberangkatan + "']").hide();
                                                        $("#tujuan option[value!='" + keberangkatan + "']").show();
                                                    }
                                                }

                                                function getSecondValue(tujuan) {
                                                    if (tujuan != '') {
                                                        $("#keberangkatan option[value='" + tujuan + "']").hide();
                                                        $("#keberangkatan option[value!='" + tujuan + "']").show();
                                                    }
                                                }
                                            </script>
                                            <div class="form-group row">
                                                <label for="transportasi_id" class="col-sm-2 col-form-label">Transportasi
                                                    :</label>
                                                <div class="col-sm-5">
                                                    <select class="form-control" id="transportasi"
                                                        name="transportasi_id" required>
                                                        @if (old('transportasi_id'))
                                                        <option value={{ old('transportasi_id') }}>
                                                            {{ $transportasis->where('id',
                                                            old('transportasi_id'))->first()->name }}
                                                        </option>
                                                        @else
                                                        <option disabled selected>-- Pilih Transportasi --</option>
                                                        @endif
                                                        @foreach ($transportasis as $transportasi)
                                                        @if ($transportasi->id != old('transportasi_id'))
                                                        <option value={{ $transportasi->id }}>
                                                            {{ ucfirst($transportasi->name) }}
                                                        </option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('transportasi_id'))
                                                    <div class="invalid-feedback">
                                                        Pilih transportasi dengan benar!
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="form-group">
                                                        <select name="type_id" class="form-control"
                                                            id="transportasi_class" required>
                                                            @if (old('type_id'))
                                                            <option value={{ old('type_id') }}>
                                                                {{ $types->where('id', old('type_id'))->first()->name }}
                                                            </option>
                                                            @else
                                                            <option selected value="">-- Pilih Jenis Transportasi --
                                                            </option>
                                                            @endif

                                                            @foreach ($types as $type)
                                                            @if ($type->id != old('type_id'))
                                                            <option value={{ $type->id }}>
                                                                {{ ucfirst($type->name) }}
                                                            </option>
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('transportasi_id'))
                                                        <div class="invalid-feedback">
                                                            Pilih jenis transportasi dengan benar!
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis :</label>

                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input" id="pergi-check"
                                                                type="radio" name="round_trip" 
                                                                @if(old('round_trip')==true) 
                                                                @else checked @endif
                                                                value="false">
                                                            <label class="form-check-label">Sekali Jalan</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input" id="pergi-pulang-check"
                                                                type="radio" name="round_trip" value="true" 
                                                                @if (old('round_trip')==true) checked @else @endif>
                                                            <label class=" form-check-label">Pulang-Pergi</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <label for="inputEmail3" class="col-sm-1 col-form-label">Jumlah
                                                    :</label>
                                                <div class="col-sm-2">
                                                    <select class="form-control" id="jumlah-penumpang" name="amount">
                                                        @for ($i = 1; $i <= 5; $i++) @if ($i==old('amount')) <option
                                                            value={{ $i }} selected>{{ $i }}
                                                            </option>
                                                            @else
                                                            <option value={{ $i }}>{{ $i }}</option>
                                                            @endif
                                                            @endfor
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Pergi :</label>

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <input type="date" class="form-control" id="tanggalpergi"
                                                            min="<?php echo date('Y-m-d'); ?>" placeholder="hh/bb/tttt"
                                                            name="go_date" required value="{{ old('go_date') }}">
                                                    </div>
                                                </div>

                                                @if ($errors->has('go_date'))
                                                <div class="invalid-feedback">
                                                    Pilih tanggal pergi dengan benar!
                                                </div>
                                                @endif

                                                <label for="inputEmail3"
                                                    class="col-sm-1 col-form-label pulang-toogle">Pulang
                                                    :</label>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <input type="date" class="form-control pulang-toogle"
                                                            id="tanggalpulang" min="<?php echo date('Y-m-d'); ?>"
                                                            placeholder="hh/bb/tttt" name="return_date">
                                                    </div>
                                                </div>

                                                @if ($errors->has('return_date'))
                                                <div class="invalid-feedback">
                                                    Pilih tanggal pulang dengan benar!
                                                </div>
                                                @endif

                                            </div>


                                            <div class="form-group row">
                                                <div class="col-lg-2 col-sm-12 align-items-start mb-2">
                                                    <button type="button" class="btn btn-primary"
                                                        id="checkTicketButton">Cek Harga Tiket Berangkat</button>
                                                </div>
                                                <div class="col-lg-4 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="form-control">
                                                            <p id="tickets_shelf">Klik tombol untuk cek harga tiket</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-12">
                                                    <div class="badge bg-success">
                                                        Dalam Bentuk Rupiah
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row pulang-toogle">
                                                <div class="col-lg-2 col-sm-12 align-items-start mb-2">
                                                    <button type="button" class="btn btn-primary"
                                                        id="checkTicketButton2">Cek
                                                        Harga
                                                        Tiket Pulang</button>
                                                </div>
                                                <div class="col-lg-4 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="form-control">
                                                            <p id="tickets_shelf2">Klik tombol untuk mengecek harga
                                                                tiket
                                                                Pulang</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-12">
                                                    <div class="badge bg-success">
                                                        Dalam Bentuk Rupiah
                                                    </div>
                                                </div>
                                            </div>

                                            <h4>Data Penumpang :</h4>

                                            <div class="form-group row" id="penumpang-1">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Penumpang
                                                    1:</label>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <input type="text"
                                                            class="form-control @error('nama_penumpang_1') is-invalid @enderror"
                                                            id="inputEmail3" placeholder="Nama" name="nama_penumpang_1"
                                                            required value="{{ old('nama_penumpang_1') }}">
                                                        @error('nama_penumpang_1')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <label for="inputEmail3" class="col-sm-1 col-form-label">KTP :</label>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="inputEmail3"
                                                            placeholder="KTP" name="nik_penumpang_1" required
                                                            value="{{ old('nik_penumpang_1') }}">
                                                    </div>
                                                </div>
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis
                                                    Kelamin:</label>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <select class="form-control" name="jenis_penumpang_1" required>
                                                            <option disabled selected>-- Kelamin --</option>

                                                            <option value="true" @if (old('jenis_penumpang_1')=='true' )
                                                                selected @else @endif>
                                                                Laki-Laki</option>
                                                            <option value="false" @if (old('jenis_penumpang_1')=='false'
                                                                ) selected @else @endif>
                                                                Perempuan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row" id="penumpang-2">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Penumpang
                                                    2:</label>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="inputEmail3"
                                                            placeholder="Nama" name="nama_penumpang_2"
                                                            value="{{ old('nama_penumpang_2') }}">
                                                    </div>
                                                </div>
                                                <label for="inputEmail3" class="col-sm-1 col-form-label">KTP :</label>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="inputEmail3"
                                                            placeholder="KTP" name="nik_penumpang_2"
                                                            value="{{ old('nik_penumpang_2') }}">
                                                    </div>
                                                </div>
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis
                                                    Kelamin:</label>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <select class="form-control" name="jenis_penumpang_2">
                                                            <option disabled selected>-- Kelamin --</option>

                                                            <option value="true" @if (old('jenis_penumpang_2')=='true' )
                                                                selected @else @endif>
                                                                Laki-Laki</option>
                                                            <option value="false" @if (old('jenis_penumpang_2')=='false'
                                                                ) selected @else @endif>
                                                                Perempuan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row" id="penumpang-3">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Penumpang
                                                    3:</label>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="inputEmail3"
                                                            placeholder="Nama" name="nama_penumpang_3"
                                                            value="{{ old('nama_penumpang_3') }}">
                                                    </div>
                                                </div>
                                                <label for="inputEmail3" class="col-sm-1 col-form-label">KTP :</label>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="inputEmail3"
                                                            placeholder="KTP" name="nik_penumpang_3"
                                                            value="{{ old('nik_penumpang_3') }}">
                                                    </div>
                                                </div>
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis
                                                    Kelamin:</label>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <select class="form-control" name="jenis_penumpang_3">
                                                            <option disabled selected>-- Kelamin --</option>

                                                            <option value="true" @if (old('jenis_penumpang_3')=='true' )
                                                                selected @else @endif>
                                                                Laki-Laki</option>
                                                            <option value="false" @if (old('jenis_penumpang_3')=='false'
                                                                ) selected @else @endif>
                                                                Perempuan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row" id="penumpang-4">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Penumpang
                                                    4:</label>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="inputEmail3"
                                                            placeholder="Nama" name="nama_penumpang_4"
                                                            value="{{ old('nama_penumpang_4') }}">
                                                    </div>
                                                </div>
                                                <label for="inputEmail3" class="col-sm-1 col-form-label">KTP :</label>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="inputEmail3"
                                                            placeholder="KTP" name="nik_penumpang_4"
                                                            value="{{ old('nik_penumpang_4') }}">
                                                    </div>
                                                </div>
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis
                                                    Kelamin:</label>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <select class="form-control" name="jenis_penumpang_4">
                                                            <option disabled selected>-- Kelamin --</option>

                                                            <option value="true" @if (old('jenis_penumpang_4')=='true' )
                                                                selected @else @endif>
                                                                Laki-Laki</option>
                                                            <option value="false" @if (old('jenis_penumpang_4')=='false'
                                                                ) selected @else @endif>
                                                                Perempuan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row" id="penumpang-5">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Penumpang
                                                    5:</label>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="inputEmail3"
                                                            placeholder="Nama" name="nama_penumpang_5"
                                                            value="{{ old('nama_penumpang_5') }}">
                                                    </div>
                                                </div>
                                                <label for="inputEmail3" class="col-sm-1 col-form-label">KTP :</label>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="inputEmail3"
                                                            placeholder="KTP" name="nik_penumpang_5"
                                                            value="{{ old('nik_penumpang_5') }}">
                                                    </div>
                                                </div>
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis
                                                    Kelamin:</label>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <select class="form-control" name="jenis_penumpang_5">
                                                            <option disabled selected>-- Kelamin --</option>

                                                            <option value="true" @if (old('jenis_penumpang_5')=='true' )
                                                                selected @else @endif>
                                                                Laki-Laki</option>
                                                            <option value="false" @if (old('jenis_penumpang_5')=='false'
                                                                ) selected @else @endif>
                                                                Perempuan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- <h4>Data Pembayaran</h4>

                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Metode
                                                    Pembayaran:</label>
                                                <div class="col-lg-2 col-sm-12">
                                                    <div class="form-group">
                                                        <select class="form-control" id="method_id" name="method_id">
                                                            @if (old('method_id'))
                                                            <option value={{ old('method_id') }}>
                                                                {{ $methods->where('id',
                                                                old('method_id'))->first()->method }}
                                                            </option>
                                                            @else
                                                            <option disabled selected>-- Metode Pembayaran --</option>
                                                            @endif
                                                            @foreach ($methods as $method)
                                                            @if ($method->id != old('method_id'))
                                                            <option value="{{ $method->id }}">{{ $method->method }}
                                                            </option>
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <label for="inputEmail3" class="col-sm-1 col-form-label">Atas
                                                    Nama:</label>
                                                <div class="col-lg-3 col-sm-12">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="name_account"
                                                            id="name_account" placeholder="Nama Lengkap" required
                                                            value="{{ old('name_account') }}">
                                                        <small class="text-muted">Nama lengkap pada rekening</small>
                                                    </div>
                                                </div>

                                                <label for="inputEmail3" class="col-sm-1 col-form-label">Nomor:</label>
                                                <div class="col-lg-3 col-sm-12">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="from_account"
                                                            id="name_account" placeholder="Nomor Lengkap" required
                                                            value="{{ old('from_account') }}">
                                                        <small class="text-muted">Nomor lengkap pada rekening</small>
                                                    </div>
                                                </div>
                                            </div> -->

                                            <div class="form-group row">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>

                                            <!-- <label for="inputEmail3" class="col-sm-1 col-form-label">Jumlah
                                                :</label>
                                            <div class="col-sm-2">
                                                <select class="form-control" id="jumlah-penumpang" name="amount">
                                                    <option value= selected>bayar </option>
                                                    <option value= selected>bayar diloket</option>

                                            
                                                </select>
                                            </div> -->
                                        </div>

                                    </form>
                                    <!-- /.card-body -->
                                </div>
                            </div>

                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->

            </div>
        </div>
    </div>
</x-app-layout>

<script>
    window.onload = init;

    function init() {
        const checkPriceButton = document.getElementById("checkPriceButton");
        const pickup = document.getElementById("keberangkatan");
        const destination = document.getElementById("tujuan");
        const transportasi = document.getElementById("transportasi");
        const transportasi_class = document.getElementById("transportasi_class");
        const checkTicketButton = document.getElementById('checkTicketButton');
        const ticketsShelf = document.getElementById('tickets_shelf');
        const checkTicketButton2 = document.getElementById('checkTicketButton2');
        const ticketsShelf2 = document.getElementById('tickets_shelf2');

        checkTicketButton.addEventListener('click', function () {
            fetch(
                `/checkprice?transportasi_id=${transportasi.value}&type_id=${transportasi_class.value}&from_route=${pickup.value}&to_route=${destination.value}`
            )
                .then(response => {
                    return response.json();
                })
                .then(res => {
                    ticketsShelf.innerHTML = res.price;
                })
                .catch(res => {
                    ticketsShelf.innerHTML = "Harga tiket tidak dapat ditampilkan";
                })
        });

        checkTicketButton2.addEventListener('click', function () {
            fetch(
                `/checkprice?transportasi_id=${transportasi.value}&type_id=${transportasi_class.value}&from_route=${destination.value}&to_route=${pickup.value}`
            )
                .then(response => {
                    return response.json();
                })
                .then(res => {
                    ticketsShelf2.innerHTML = res.price;
                })
                .catch(res => {
                    ticketsShelf2.innerHTML = "Harga tiket tidak dapat ditampilkan";
                })
        });
    }
</script>