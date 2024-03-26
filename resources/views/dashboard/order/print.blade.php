@extends('layouts.front')

@section('front')
<a href="/orders">Kembali</a>
<div class="wrapper">
   
    <!-- Main content -->
    <section class="invoice" style="margin: 30px; border: none">
        <!-- title row -->
        
        <div class="row">
            <div class="col-12">
                <h2 class="page-header">
                    <img src="{{ asset('dist/img/LogoTicBus.png') }}" alt="TicBus Logo" width="220">
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                <br>
                <br>
                <address>
                    <strong>TicBus</strong><br>
                    Jl. Sisingamangaraja KM 7,5 No.61,<br>
                    Harjosari II, Kec. Medan Amplas, <br>
                    Kota Medan, Sumatera Utara 20148<br>
                    Phone: 082277773672<br>
                    Email:
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">

                <br>
                <br>
                <address>
                    @isset($order->user->no_hp)
                    <strong>{{ $order->user->name }}</strong>
                    @endisset

                    @isset($order->user->no_hp)
                    <br> No Hp: {{ $order->user->no_hp }}
                    @endisset

                    @isset($order->user->email)
                    <br> Email: {{ $order->user->email }}
                    @endisset

                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <br>
                <br>
                <b>Invoice #{{ $order->order_code }}</b><br>
                <br>
                {!! DNS1D::getBarcodeHTML($order->order_code, "C128", 1.2, 45) !!}
                <br>
                <b>Order ID:</b> {{ $order->order_code }}<br>
                @isset($order->transaction->method->method)
                <b>Metode Pembayaran :</b> {{ $order->transaction->method->method }}
                <br>
                @endisset


            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <br>
        <!-- Table row -->
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Transportasi</th>
                            <th>Kelas</th>
                            <th>Rute</th>
                            <th>Kode Bus</th>
                            <th>Tanggal Pergi</th>
                            <th>Jam Berangkat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->passengers as $passenger)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->ticket->transportasi->name }}</td>
                            <td>{{ $order->ticket->type->name }}</td>
                            <td>{{ $order->ticket->track->from_route }} - {{ $order->ticket->track->to_route }}
                            </td>
                            <td>{{ $order->ticket->price->kode_bus }}</td>
                            <td>{{ $order->go_date }}</td>
                            <td>{{ $order->ticket->type->flight_at }} WIB</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-6">

            </div>
            <!-- /.col -->
            <div class="col-6">

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Total:</th>
                            <td style="font-weight: bold">Rp {{ $order->transaction->total }}</td>
                        </tr>
                    </table>
                </div>
                <p class="lead">Pembayaran Anda Berhasil &nbsp; &nbsp;<i class="fas fa-check"></i> <br></p>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<!-- ./wrapper -->
@endsection

<script type="text/javascript">
    < !-
        window.print();
    //
    ->
</script>
<script src="{{ asset('js/qrcode.js') }}"></script>
<script>
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        width: 100,
        height: 100
    });

    function makeCode() {
        var elText = "{{ $order->order_code}}";

        qrcode.makeCode(elText);

    }

    makeCode();
</script>|