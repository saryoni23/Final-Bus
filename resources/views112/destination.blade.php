@extends('layouts.main')

@section('front-end')
<x-front-navbar></x-front-navbar>

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_1.jpg');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i
                                class="fa fa-chevron-right"></i></a></span> <span>Destination <i
                            class="fa fa-chevron-right"></i></span></p>
                <h1 class="mb-0 bread">Destination</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4 ftco-animate">
                <div class="project-wrap">
                    <a href="#" class="img" style="background-image: url(images/destinasi_1.jpg);">
                    </a>
                    <div class="text p-4">
                        <h3><a>Danau Toba</a></h3>
                        <p class="location"></span> Danau Toba adalah danau alami berukuran besar di Indonesia yang terletak di kaldera gunung supervulkan. Danau ini memiliki panjang 100 kilometer, lebar 30 kilometer, dan kedalaman 508 meter. Danau ini terletak di tengah pulau Sumatra bagian utara dengan ketinggian permukaan sekitar 900 meter</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ftco-animate">
                <div class="project-wrap">
                    <a href="#" class="img" style="background-image: url(images/destinasi_2.jpg);">
                    </a>
                    <div class="text p-4">
                        <h3><a>Air Terjun Sipiso Piso</a></h3>
                        <p class="location"><span class="fa fa-map-marker"></span> Pengambaten, Kec. Merek, Kabupaten Karo, Sumatera Utara 22173</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ftco-animate">
                <div class="project-wrap">
                    <a href="#" class="img" style="background-image: url(images/destinasi_3.jpg);">
                    </a>
                    <div class="text p-4">
                        <h3><a>Bukit Holbung</a></h3>
                        <p class="location">Bukit Holbung adalah salah satu tempat wisata di Danau Toba yang terletak perbukitan di Desa Holbung, Kecamatan Sitiotio, Kabupaten Samosir, Sumatera Utara. Rangkaian perbukitan Bukit Holbung ini sudah ada sejak 200 tahun yang lalu.</p>
                    </div>
                </div>
            </div>


        </div>
        <div class="row mt-5">
            <div class="col text-center">
                <div class="block-27">
                </div>
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
                    <p>TicBus berasal dari Tiket dan Bus dimaan  kata tesesbut saya singkat dan di gabungkan dan membuat Ticbus sehingga saya berharap dapat menjadi jembatan untuk mempersatukan dari Pengguna dan penyedia layanan.</p>
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
                            <li><span class="icon fa fa-map-marker"></span><span class="text">Alamat: Jl. Sisingamangaraja KM 7,5 No.61, Harjosari II, Kec. Medan Amplas, Kota Medan, Sumatera Utara 20148</span></li>
                            <li><a href="https://wa.me/6281384002161?text=Ingin%20Melaporkan%20Masalah"><span
                                        class="icon fa fa-whatsapp"></span><span class="text">0822-7777-3672 Admin
                                        1</span></a></li>
                           
                            <li><a href="#"><span class="icon fa fa-paper-plane"></span><span
                                        class="text">TicBus Moria</span></a></li>
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