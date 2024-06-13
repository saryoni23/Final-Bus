@extends('layouts.main')

@section('front-end')
<x-front-navbar></x-front-navbar>

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_1.jpg');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i
                                class="fa fa-chevron-right"></i></a></span> <span>Contact us <i
                            class="fa fa-chevron-right"></i></span></p>
                <h1 class="mb-0 bread">Contact us</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-no-pb contact-section mb-4">
    <div class="container">
        <div class="row d-flex contact-info">
            <div class="col-md-3 d-flex">
                <div class="align-self-stretch box p-4 text-center">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="fa fa-map-marker"></span>
                    </div>
                    <h3 class="mb-2">Address</h3>
                    <p> Jl. Sisingamangaraja KM 7,5 No.61, Harjosari II, Kec. Medan Amplas, Kota Medan, Sumatera Utara
                        20148</p>
                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="align-self-stretch box p-4 text-center">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="fa fa-phone"></span>
                    </div>
                    <h3 class="mb-2">Contact Number</h3>
                    <p><a href="https://wa.me/6281384002161?text=Ingin%20Melaporkan%20Masalah">0822-7777-3672 Admin
                            1</a></p>

                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="align-self-stretch box p-4 text-center">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="fa fa-facebook"></span>
                    </div>
                    <h3 class="mb-2">Facebook</h3>
                    <p><a href="https://facebook.com/groups/414528939515226">TicBustiket@gmail.com</a></p>
                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="align-self-stretch box p-4 text-center">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="fa fa-globe"></span>
                    </div>
                    <h3 class="mb-2">Website</h3>
                    <p><a href="https://TicBus"></a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section contact-section ftco-no-pt mt-2">
    <div class="container">
        <div class="row block-9">
            <div class="col-md-12 d-flex justify-content-center">
                <iframe src="https://www.google.com/maps/d/embed?mid=1ARHiN2Nok5_wz3BwDkeH_9mkXIrRUds&ehbc=2E312F"
                    width="640" height="480"></iframe>
            </div>
        </div>
    </div>
</section>


<footer class="ftco-footer bg-bottom ftco-no-pt" style="background-image: url(images/bg_3.jpg);">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md pt-5">
                <div class="ftco-footer-widget pt-md-5 mb-4">
                    <h2 class="ftco-heading-2">About</h2>
                    <p>TicBus berasal dari Tiket dan Bus dimaan kata tesesbut saya singkat dan di gabungkan dan membuat
                        Ticbus sehingga saya berharap dapat menjadi jembatan untuk mempersatukan dari Pengguna dan
                        penyedia layanan.</p>
                    <ul class="ftco-footer-social list-unstyled float-md-left float-lft">
                        <li class="ftco-animate"><a href="https://twitter.com/TicBusTM" target="_blank"><span
                                    class="fa fa-twitter"></span></a></li>
                        <li class="ftco-animate"><a href="https://www.instagram.com/TicBustm/?hl=id"
                                target="_blank"><span class="fa fa-facebook"></span></a></li>
                        <li class="ftco-animate"><a href="#" target="_blank"><span class="fa fa-instagram"></span></a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md pt-5 border-left">
                <div class="ftco-footer-widget pt-md-5 mb-4">
                    <h2 class="ftco-heading-2">Ada Pertanyaan ?</h2>
                    <div class="block-23 mb-3">
                        <ul>
                            <li><span class="icon fa fa-map-marker"></span><span class="text">Alamat: Jl.
                                    Sisingamangaraja KM 7,5 No.61, Harjosari II, Kec. Medan Amplas, Kota Medan, Sumatera
                                    Utara 20148</span></li>
                            <li><a href="https://wa.me/6281384002161?text=Ingin%20Melaporkan%20Masalah"><span
                                        class="icon fa fa-whatsapp"></span><span class="text">0822-7777-3672 Admin
                                        1</span></a></li>

                            <li><a href="#"><span class="icon fa fa-paper-plane"></span><span class="text">TicBus
                                        Moria</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">

                <p>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    TicBus &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>
        </div>
    </div>
</footer>



<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
            stroke="#F96D00" />
    </svg></div>
@endsection