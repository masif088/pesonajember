<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">

    <title>Wishka</title>
    <!--

    TemplateMo 558 Klassy Cafe

    https://templatemo.com/tm-558-klassy-cafe

    -->
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

    <link rel="stylesheet" href="{{ asset('front/css/templatemo-klassy-cafe.css')}}">

    <link rel="stylesheet" href="{{ asset('front/css/owl-carousel.css')}}">

    <link rel="stylesheet" href="{{ asset('front/css/lightbox.css')}}">

</head>

<body>

<!-- ***** Preloader Start ***** -->
<div id="preloader">
    <div class="jumper">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
<!-- ***** Preloader End ***** -->


<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="#" class="logo">
                        <img src="{{ asset('front/images/logo-wishka.png')}}" align="logo">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
                        <li class="scroll-to-section"><a href="#about">About</a></li>

                        <!--
                            <li class="submenu">
                                <a href="javascript:;">Drop Down</a>
                                <ul>
                                    <li><a href="#">Drop Down Page 1</a></li>
                                    <li><a href="#">Drop Down Page 2</a></li>
                                    <li><a href="#">Drop Down Page 3</a></li>
                                </ul>
                            </li>
                        -->
                        <li class="scroll-to-section"><a href="#menu">Portfolio</a></li>
                        <li class="scroll-to-section"><a href="#chefs">Keunggulan</a></li>
                        <!-- <li class="submenu">
                            <a href="javascript:;">Features</a>
                            <ul>
                                <li><a href="#">Features Page 1</a></li>
                                <li><a href="#">Features Page 2</a></li>
                                <li><a href="#">Features Page 3</a></li>
                                <li><a href="#">Features Page 4</a></li>
                            </ul>
                        </li> -->
                        <!-- <li class=""><a rel="sponsored" href="https://templatemo.com" target="_blank">External URL</a></li> -->
                        <li class="scroll-to-section"><a href="#reservation">Hubungi Kami</a></li>
                        <li class="scroll-to-section"><a href="{{ route('login') }}">Login</a></li>
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ***** Header Area End ***** -->

<!-- ***** Main Banner Area Start ***** -->
<div id="top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="left-content">
                    <div class="inner-content">
                        <h3>CRAFT WITH PRIDE</h3>
                        <h5>Bag Vendor Custom</h5>
                        <p>Pilihan terbaik untuk setiap kebutuhan tas dengan logo dan design mu sendiri. Dengan harga yang jauh lebih murah kamu bisa bangun brand kamu dan mendapatkan tas dengan kualitas terbaik. </p>
                        <div class="main-white-button scroll-to-section">
                            <a href="#reservation">Hubungi Kami</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="main-banner header-text">
                    <div class="Modern-Slider">
                        <!-- Item -->
                        <div class="item">
                            <div class="img-fill">
                                <img src="{{ asset('front/images/slider-1.jpg')}}" alt="">
                            </div>
                        </div>
                        <!-- // Item -->
                        <!-- Item -->
                        <div class="item">
                            <div class="img-fill">
                                <img src="{{ asset('front/images/slider-2.jpg')}}" alt="">
                            </div>
                        </div>
                        <!-- // Item -->
                        <!-- Item -->
                        <div class="item">
                            <div class="img-fill">
                                <img src="{{ asset('front/images/slider-3.jpg')}}" alt="">
                            </div>
                        </div>
                        <!-- // Item -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***** Main Banner Area End ***** -->

<!-- ***** About Area Starts ***** -->
<section class="section" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="left-text-content">
                    <div class="section-heading">
                        <h6>Tentang Kami</h6>
                        <h2>SEJAK 2014 TELAH MENJADI DISTRIBUTOR TAS BRAND LOKAL</h2>
                    </div>
                    <p>Sejak tahun 2014 wishka telah memproduksi tas custom untuk memenuhi kebutuhan brand di seluruh Indonesia. Tim Wishka selalu memprioritaskan kualitas dan kebutuhan customer. Kami mengupayakan layanan terbaik dengan produksi yang mampu menghasilkan output yang mirip dengan custom design anda.</p>
                    <div class="row">
                        <div class="col-4">
                            <img src="{{ asset('front/images/about-thum-1.png')}}" alt="">
                        </div>
                        <div class="col-4">
                            <img src="{{ asset('front/images/about-thum-2.png')}}" alt="">
                        </div>
                        <div class="col-4">
                            <img src="{{ asset('front/images/about-thum-3.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="right-content">
                    <div class="thumb">
                        <a rel="nofollow" href="https://www.instagram.com/reel/C8CMJfbSjpJ/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA=="><i class="fa fa-play"></i></a>
                        <img src="{{ asset('front/images/about-video-bg.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** About Area Ends ***** -->

<!-- ***** Menu Area Starts ***** -->
<section class="section" id="menu">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="section-heading">
                    <h6>Portfolio</h6>
                    <h2>Hasil Karya Kami untuk Brand Lokal Indonesia</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="menu-item-carousel">
        <div class="col-lg-12">
            <div class="owl-menu-item owl-carousel">
                <div class="item">
                    <div class='card card1'>
                        <!-- <div class="price"><h6>Totebag</h6></div> -->
                        <div class='info'>
                            <h1 class='title'>BLOOM TOTEBAG</h1>
                            <p class='description'>Totebag Non Zipper Webbing Katun. Memiliki hasil yang simple dan elegan dengan ukuran 40x30x15 cm atau custom</p>
                            <div class="main-text-button">
                                <div class="scroll-to-section"><a href="#reservation">Make Reservation <i class="fa fa-angle-down"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class='card card2'>
                        <!-- <div class="price"><h6>$22</h6></div> -->
                        <div class='info'>
                            <h1 class='title'>INTERLUDEMOOD</h1>
                            <p class='description'>Totebag dilengkapi dengan zipper dan berbahan kanvas, memiliki ciri khas tersendiri untuk produkmu </p>
                            <div class="main-text-button">
                                <div class="scroll-to-section"><a href="#reservation">Make Reservation <i class="fa fa-angle-down"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class='card card3'>
                        <!-- <div class="price"><h6>$18</h6></div> -->
                        <div class='info'>
                            <h1 class='title'>PLEASURE CULTURE</h1>
                            <p class='description'>Totebag dengan pouch kecil sebagai pemanis dibelakangnya menambah fungsionalitas totebag kamu</p>
                            <div class="main-text-button">
                                <div class="scroll-to-section"><a href="#reservation">Make Reservation <i class="fa fa-angle-down"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class='card card4'>
                        <!-- <div class="price"><h6>$10</h6></div> -->
                        <div class='info'>
                            <h1 class='title'>EMOTIONAL</h1>
                            <p class='description'>Berbahan kanvas dengan totebag yang lebih kokoh dan muat banyak barang</p>
                            <div class="main-text-button">
                                <div class="scroll-to-section"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class='card card5'>
                        <!-- <div class="price"><h6>$8.50</h6></div> -->
                        <div class='info'>
                            <h1 class='title'>CARRES</h1>
                            <p class='description'>Terdiri dari totebag dan pouch yang bisa dengan dua tali yang menjadikan tas kamu semakin kekinian</p>
                            <div class="main-text-button">
                                <div class="scroll-to-section"><a href="#reservation">Make Reservation <i class="fa fa-angle-down"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class='card card6'>
                        <!-- <div class="price"><h6>$7.25</h6></div> -->
                        <div class='info'>
                            <h1 class='title'>TODAY NICE DAY</h1>
                            <p class='description'>Berbahan Corduroy/kanvas dengan kualitas premium dan kuat sehingga bisa menjadi tas yang kamu bawa kemanapun</p>
                            <div class="main-text-button">
                                <div class="scroll-to-section"><a href="#reservation">Make Reservation <i class="fa fa-angle-down"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class='card card7'>
                        <!-- <div class="price"><h6>$7.25</h6></div> -->
                        <div class='info'>
                            <h1 class='title'>MINION X</h1>
                            <p class='description'>Slingbag yang bisa kamu bawa kemana-mana untuk kamu yang suka simpel, praktis dan ekspresikan aktivitasmu/p>
                            <div class="main-text-button">
                                <div class="scroll-to-section"><a href="#reservation">Make Reservation <i class="fa fa-angle-down"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class='card card8'>
                        <!-- <div class="price"><h6>$7.25</h6></div> -->
                        <div class='info'>
                            <h1 class='title'>TODAY NICE DAY</h1>
                            <p class='description'>Berbahan Corduroy/kanvas dengan kualitas premium dan kuat sehingga bisa menjadi tas yang kamu bawa kemanapun</p>
                            <div class="main-text-button">
                                <div class="scroll-to-section"><a href="#reservation">Make Reservation <i class="fa fa-angle-down"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Menu Area Ends ***** -->

<!-- ***** Chefs Area Starts ***** -->

<section class="section" id="chefs">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 offset-lg-12 text-center">
                <div class="section-heading">
                    <h6>Dipercaya Oleh 1000++ Konsumen Wishka</h6>
                    <h4>Wishka mampu memproduksi tas sesuai dengan kebutuhan dan keinginan customer. Wishka selalu update dengan trend dan  perkembangan kompetensi dalam pembuatan tas untuk menghasilkan tas yang terbaik.</h4>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="chef-item">
                    <div class="thumb">
                        <!-- <div class="overlay"></div>
                        <ul class="social-icons">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        </ul> -->
                        <img src="{{ asset('front/images/benefit-1.png')}}" alt="Chef #1">
                    </div>
                    <div class="down-content">
                        <h4>MINIMAL ORDER CUSTOM RENDAH</h4>
                        <span>Minimal order custom yakni 24 pcs yang  rendah memudahkan usaha skala kecil untuk dapat mengembangkan brandnya melalui produk tas</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="chef-item">
                    <div class="thumb">
                        <!-- <div class="overlay"></div>
                        <ul class="social-icons">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-behance"></i></a></li>
                        </ul> -->
                        <img src="{{ asset('front/images/benefit-2.png')}}" alt="Chef #2">
                    </div>
                    <div class="down-content">
                        <h4>DESIGN KREATIF</h4>
                        <span>Kami terus mengikuti trend dan menciptakan desain yang menarik dan fungsionalitas sehingga bisa memenuhi kebutuhan serta menghasilkan desain yang ekslusif untuk kebutuhan anda.</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="chef-item">
                    <div class="thumb">
                        <!-- <div class="overlay"></div>
                        <ul class="social-icons">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google"></i></a></li>
                        </ul> -->
                        <img src="{{ asset('front/images/benefit-3.png')}}" alt="Chef #3">
                    </div>
                    <div class="down-content">
                        <h4>MAMPU PRODUKSI SKALA BESAR</h4>
                        <span>Mampu menyelesaikan kebutuhan skala besar sesuai kebutuhan brand dan kegiatanmu.</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="chef-item">
                    <div class="thumb">
                        <!-- <div class="overlay"></div>
                        <ul class="social-icons">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-behance"></i></a></li>
                        </ul> -->
                        <img src="{{ asset('front/images/benefit-4.png')}}" alt="Chef #2">
                    </div>
                    <div class="down-content">
                        <h4>HARGA KOMPETITIF</h4>
                        <span>Kami merupaya untuk memberikan harga yang lebih rendah dibandingkan pasaran guna memberikan value pada brand dan saling menguntungkan.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Chefs Area Ends ***** -->

<!-- ***** Reservation Us Area Starts ***** -->
<section class="section" id="reservation">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <div class="left-text-content">
                    <div class="section-heading">
                        <h6>Hubungi Kami</h6>
                        <h2>Dapatkan Penawaran Terbaik Bersama Wishka</h2>
                    </div>
                    <p style="margin: 0;"> Menghasilkan tas yang berkualitas dan mewujudkan dream bag anda adalah salah satu misi kami untuk menjadi salah satu vendor tas terbaik di Indonesia. Melalui Wishka anda bisa mendapatkan keuntungan seperti:
                    <ul class="text-white" style="font-size: small;">
                        <li>- Free Sampel Produk</li>
                        <li>- Free Design Custom</li>
                        <li>- Quality Control Setiap Tahap Produksi</li>
                        <li>- Kemampuan Produksi Kapasitas Besar</li>
                        <li>- Garansi Produk</li>
                    </ul>
                    </p>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="phone">
                                <i class="fa fa-phone"></i>
                                <h4>Phone Number</h4>
                                <span><a href="#">0812-5268-7268</a></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="message">
                                <i class="fa fa-envelope"></i>
                                <h4>Email</h4>
                                <span><a href="#">official@wishka.id</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="contact-form">
                    <form id="contact" action="" method="post">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4>Konsultasi Pemesanan</h4>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <fieldset>
                                    <input name="name" type="text" id="name" placeholder="Nama Kamu*" required="">
                                </fieldset>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <fieldset>
                                    <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*" placeholder="Masukkan Email" required="">
                                </fieldset>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <fieldset>
                                    <input name="phone" type="text" id="phone" placeholder="Nomer WhatsApp*" required="">
                                </fieldset>
                            </div>
                            <!-- <div class="col-md-6 col-sm-12">
                              <fieldset>
                                <select value="number-guests" name="number-guests" id="number-guests">
                                    <option value="number-guests">Number Of Guests</option>
                                    <option name="1" id="1">1</option>
                                    <option name="2" id="2">2</option>
                                    <option name="3" id="3">3</option>
                                    <option name="4" id="4">4</option>
                                    <option name="5" id="5">5</option>
                                    <option name="6" id="6">6</option>
                                    <option name="7" id="7">7</option>
                                    <option name="8" id="8">8</option>
                                    <option name="9" id="9">9</option>
                                    <option name="10" id="10">10</option>
                                    <option name="11" id="11">11</option>
                                    <option name="12" id="12">12</option>
                                </select>
                              </fieldset>
                            </div> -->
                            <!-- <div class="col-lg-6">
                                <div id="filterDate2">
                                  <div class="input-group date" data-date-format="dd/mm/yyyy">
                                    <input  name="date" id="date" type="text" class="form-control" placeholder="dd/mm/yyyy">
                                    <div class="input-group-addon" >
                                      <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                  </div>
                                </div>
                            </div> -->
                            <div class="col-lg-6 col-sm-12">
                                <fieldset>
                                    <input type="text" id="order" placeholder="Perkiraan Jumlah Order*" required="">
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <textarea name="message" rows="6" id="message" placeholder="Message" required=""></textarea>
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <button type="submit" id="form-submit" class="main-button-icon">Kirim Pesan</button>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Reservation Area Ends ***** -->

<!-- ***** Menu Area Starts ***** -->
<section class="section" id="offers">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4 text-center">
                <div class="section-heading">
                    <h6>Jenis Tas</h6>
                    <h2>Kamu bisa memilih Sesuai Kebutuhanmu atau Custom</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row" id="tabs">
                    <div class="col-lg-12">
                        <div class="heading-tabs">
                            <div class="row">
                                <div class="col-lg-6 offset-lg-3">
                                    <ul>
                                        <li><a href='#tabs-1'><img src="{{ asset('front/images/totebag-logo.png')}}" alt="">Totebag</a></li>
                                        <li><a href='#tabs-2'><img src="{{ asset('front/images/slingbag-logo.png')}}" alt="">Slingbag</a></li>
                                        <li><a href='#tabs-3'><img src="{{ asset('front/images/waistbag-logo.png')}}" alt="">Waistbag</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <section class='tabs-content'>
                            <article id='tabs-1'>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="left-list">
                                                <div class="col-lg-12">
                                                    <div class="tab-item">
                                                        <img src="{{ asset('front/images/totebag-1.png')}}" alt="">
                                                        <h4>COMMONDAYS</h4>
                                                        <p>Ukuran 40x30x15, Bahan Kanvas, Tanpa Furing, Bordir/Sablon</p>
                                                        <!-- <div class="price">
                                                            <h6>$10.50</h6>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="tab-item">
                                                        <img src="{{ asset('front/images/totebag-4.png')}}" alt="">
                                                        <h4>EMOTIONAL</h4>
                                                        <p>Ukuran 40x30x15, Bahan Kanvas, Tanpa Furing, Bordir/Sablon</p>
                                                        <!-- <div class="price">
                                                            <h6>$8.50</h6>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="tab-item">
                                                        <img src="{{ asset('front/images/totebag-5.png')}}" alt="">
                                                        <h4>META</h4>
                                                        <p>Ukuran 40x30x15, Bahan Kanvas, Tanpa Furing, Bordir/Sablon</p>
                                                        <!-- <div class="price">
                                                            <h6>$9.90</h6>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="tab-item">
                                                        <img src="{{ asset('front/images/totebag-10.png')}}" alt="">
                                                        <h4>CARRES SHOPING BAG</h4>
                                                        <p>Ukuran 40x30x15, Bahan Parasit/Peles, Bordir/Sablon</p>
                                                        <!-- <div class="price">
                                                            <h6>$4.10</h6>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="tab-item">
                                                        <img src="{{ asset('front/images/totebag-11.png')}}" alt="">
                                                        <h4>JURNAL ESENTIAL</h4>
                                                        <p>Ukuran 50x30x20, Bahan Kanvas, Bordir/Sablon</p>
                                                        <!-- <div class="price">
                                                            <h6>$4.10</h6>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="right-list">
                                                <div class="col-lg-12">
                                                    <div class="tab-item">
                                                        <img src="{{ asset('front/images/totebag-6.png')}}" alt="">
                                                        <h4>SUCEAN</h4>
                                                        <p>Ukuran 40x30x15, Bahan Kanvas, Tanpa Furing, Bordir/Sablon.</p>
                                                        <!-- <div class="price">
                                                            <h6>$6.50</h6>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="tab-item">
                                                        <img src="{{ asset('front/images/totebag-7.png')}}" alt="">
                                                        <h4>EUROPHIA</h4>
                                                        <p>Ukuran 40x30x15, Bahan Kanvas, Tanpa Furing, Bordir/Sablon</p>
                                                        <!-- <div class="price">
                                                            <h6>$5.00</h6>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="tab-item">
                                                        <img src="{{ asset('front/images/totebag-8.png')}}" alt="">
                                                        <h4>INTERLUDEMOOD</h4>
                                                        <p>Ukuran 40x30x15, Bahan Kanvas, Tanpa Furing, Bordir/Sablon</p>
                                                        <!-- <div class="price">
                                                            <h6>$4.10</h6>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="tab-item">
                                                        <img src="{{ asset('front/images/totebag-9.png')}}" alt="">
                                                        <h4>CARRES PUFFY</h4>
                                                        <p>Ukuran 40x30x15, Bahan Scoot Puma, Furing, Bordir/Sablon</p>
                                                        <!-- <div class="price">
                                                            <h6>$4.10</h6>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="tab-item">
                                                        <img src="{{ asset('front/images/totebag-12.png')}}" alt="">
                                                        <h4>LEFT HAND</h4>
                                                        <p>Ukuran 40x30x15, Bahan Scoot Puma, Webbing KRB, Bordir/Sablon</p>
                                                        <!-- <div class="price">
                                                            <h6>$4.10</h6>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article id='tabs-2'>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="left-list">
                                                <div class="col-lg-12">
                                                    <div class="tab-item">
                                                        <img src="{{ asset('front/images/slingbag-2.png')}}" alt="">
                                                        <h4>BREKLES</h4>
                                                        <p>Ukuran 25x20x8, Bahan Corduroy/Kanvas, furing, Bordir/Sablon</p>
                                                        <!-- <div class="price">
                                                            <h6>$14</h6>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="tab-item">
                                                        <img src="{{ asset('front/images/slingbag-3.png')}}" alt="">
                                                        <h4>CARRES</h4>
                                                        <p>Ukuran 20x20, Bahan Kanvas, Bordir/Sablon</p>
                                                        <!-- <div class="price">
                                                            <h6>$18</h6>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="tab-item">
                                                        <img src="{{ asset('front/images/slingbag-4.png')}}" alt="">
                                                        <h4>MUSTACE</h4>
                                                        <p>Ukuran 20x15x7, Bahan Cordura, furing, Bordir/Sablon</p>
                                                        <!-- <div class="price">
                                                            <h6>$22</h6>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="tab-item">
                                                        <img src="{{ asset('front/images/slingbag-5.png')}}" alt="">
                                                        <h4>LUMAKU</h4>
                                                        <p>Ukuran 35x25x10, Bahan Cordura, furing, Bordir/Sablon</p>
                                                        <!-- <div class="price">
                                                            <h6>$22</h6>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="right-list">
                                                <div class="col-lg-12">
                                                    <div class="tab-item">
                                                        <img src="{{ asset('front/images/slingbag-6.png')}}" alt="">
                                                        <h4>MINION X</h4>
                                                        <p>Ukuran 20x15x7, Bahan Cordura, furing, Bordir/Sablon</p>
                                                        <!-- <div class="price">
                                                            <h6>$10</h6>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="tab-item">
                                                        <img src="{{ asset('front/images/slingbag-7.png')}}" alt="">
                                                        <h4>NELSON</h4>
                                                        <p>Ukuran 20x15x7, Bahan Cordura, furing, Bordir/Sablon</p>
                                                        <!-- <div class="price">
                                                            <h6>$20</h6>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="tab-item">
                                                        <img src="{{ asset('front/images/slingbag-8.png')}}" alt="">
                                                        <h4>KAMBING GUNUNG</h4>
                                                        <p>Ukuran 20x30x7, Bahan Cordura, furing, Bordir/Sablon</p>
                                                        <!-- <div class="price">
                                                            <h6>$30</h6>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article id='tabs-3'>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="left-list">
                                                <div class="col-lg-12">
                                                    <div class="tab-item">
                                                        <img src="{{ asset('front/images/waistbag-1.png')}}" alt="">
                                                        <h4>TODAY NICE DAY</h4>
                                                        <p>Ukuran 40x30x15, Bahan Cordura/Corduroy/Canvas, Bordir/Sablon</p>
                                                        <!-- <div class="price">
                                                            <h6>$14</h6>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="right-list">
                                                <div class="col-lg-12">
                                                    <div class="tab-item">
                                                        <img src="{{ asset('front/images/waistbag-2.png')}}" alt="">
                                                        <h4>TODAY NOCE DAY</h4>
                                                        <p>Ukuran 40x30x15, Bahan Cordura/Corduroy/Canvas, Bordir/Sablon</p>
                                                        <!-- <div class="price">
                                                            <h6>$8.50</h6>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Chefs Area Ends ***** -->

<!-- ***** Footer Start ***** -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-xs-12">
                <div class="right-text-content">
                    <ul class="social-icons">
                        <li><a href="https://www.instagram.com/wishka_/"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="logo">
                    <h1 style="color: aliceblue;">Wishka.co</h1>
                    <!-- <a href="#"><img src="{{ asset('front/images/white-logo.png')}}" alt=""></a> -->
                </div>
            </div>
            <div class="col-lg-4 col-xs-12">
                <div class="left-text-content">
                    <p>© Copyright Wishka.co<br>Develop: Rateup.id</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- jQuery -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
<!-- Plugins -->
<script src="{{ asset('front/js/owl-carousel.js')}}"></script>
<script src="{{ asset('front/js/accordions.js')}}"></script>
<script src="{{ asset('front/js/datepicker.js')}}"></script>
<script src="{{ asset('front/js/scrollreveal.min.js')}}"></script>
<script src="{{ asset('front/js/waypoints.min.js')}}"></script>
<script src="{{ asset('front/js/jquery.counterup.min.js')}}"></script>
<script src="{{ asset('front/js/imgfix.min.js')}}"></script>
<script src="{{ asset('front/js/slick.js')}}"></script>
<script src="{{ asset('front/js/lightbox.js')}}"></script>
<script src="{{ asset('front/js/isotope.js')}}"></script>

<!-- Global Init -->
<script src="{{ asset('front/js/custom.js')}}"></script>
<script>

    $(function() {
        var selectedClass = "";
        $("p").click(function(){
            selectedClass = $(this).attr("data-rel");
            $("#portfolio").fadeTo(50, 0.1);
            $("#portfolio div").not("."+selectedClass).fadeOut();
            setTimeout(function() {
                $("."+selectedClass).fadeIn();
                $("#portfolio").fadeTo(50, 1);
            }, 500);

        });
    });

</script>
</body>
</html>
