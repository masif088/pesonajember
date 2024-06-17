<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.png?2') }}"/>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        #section1 {
            height: 100vh;
            background: url('front/background.png');
            background-repeat: no-repeat;
            background-size: cover
        }

        #section4 {
            background: url('front/background-2.png');
            background-repeat: no-repeat;
            background-size: cover;
        }

        #section3 {
            background: #f5f5f5;
        }

        #footer {
            background: url('front/background-footer.png');
            background-repeat: no-repeat;
            background-size: cover;
        }


    </style>
    <link rel="stylesheet" href="{{asset('assets/icons-webfont/tabler-icons.min.css')}}">
    {{--    @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
    <link rel="stylesheet" href="{{ asset('build/assets/app-BNv0_hJj.css') }}">
    <script src="{{ asset('build/assets/app-D2jpX1vH.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<section id="section1">
    <div class="container">
        <div class="lg:grid grid-cols-12">
            <div class="col-span-5">
                <div class="text-center mt-3">
                    <h1 style="font-size: 36px" class=" font-bold text-white text-center">Wishka Company</h1>
                </div>
                <div style="display: table; overflow: hidden;" class="lg:h-[90vh] p-5">
                    <div style="display: table-cell; vertical-align: middle;" class="text-white">
                        <div>
                            <h2 style="line-height: 2.4em">
                                <font style="font-size: 4em; font-weight: 900">Craft</font>
                                <br>
                                <font style="font-size: 3em; font-weight: 700">With Pride</font>
                            </h2>
                            <p style="line-height: 2em;" class="mt-5">
                                <font style="font-size: 2em">BAG VENDOR CUSTOM</font> <br>
                            </p>
                            <p style="line-height: 1.5em">
                                Pilihan terbaik untuk setiap kebutuhan tas dengan logo dan design mu sendiri. Dengan
                                harga yang
                                jauh lebih murah kamu bisa bangun brand kamu dan mendapatkan tas dengan kualitas
                                terbaik.
                            </p>

                            <br><br>
                            <div class="text-3xl text-white">
                                Percayakan Brand <br>
                                Tas mu Bersama Wishka!
                            </div>
                            <br><br>
                            <button class="btn bg-wishka-200 text-wishka-500 text-3xl py-2 px-5 "
                                    style="border-radius: 10px">Hubungi Kami
                            </button>
                        </div>
                    </div>
                </div>


            </div>
            <div class="col-span-7 text-center" style=" text-align: center">
                <img src="{{ asset('front/bag-1.png') }}" alt=""
                     class="text-center m-auto lg:absolute lg:top-1/4 lg:h-[500px] h-[300px]">
            </div>
        </div>
    </div>

</section>

<section id="section2">
    <div class="">
        <div class="lg:grid grid-cols-12">
            <div class="col-span-5">
                <img src="{{ asset('front/image-20.png') }}" alt="" style="width: 100%"
                     class="">
            </div>
            <div class="col-span-5 ml-12">
                <div class="">
                    <br><br><br>
                    <h2 class="text-3xl text-wishka-500" style="font-weight: 700">
                        DIPERCAYA OLEH <br>
                        1000++ CUSTOMER
                    </h2> <br>
                    <p class="text-xl">
                        Wishka mampu memproduksi tas sesuai dengan kebutuhan dan keinginan customer. Wishka selalu
                        update dengan
                        trend dan perkembangan kompetensi dalam pembuatan tas untuk menghasilkan tas yang terbaik.
                    </p>
                </div>
            </div>
            <div class="col-span-2 ml-12"></div>
            <div class="col-span-12 bg-gray-200" style="height: 3px; "></div>
            <div class="col-span-1 ml-12"></div>
            <div class="col-span-5 ml-12">
                <div>
                    <br><br><br>
                    <h2 class="text-3xl text-wishka-500" style="font-weight: 700">
                        DIPERCAYA OLEH <br>
                        1000++ CUSTOMER
                    </h2> <br>
                    <p class="text-xl">
                        Wishka mampu memproduksi tas sesuai dengan kebutuhan dan keinginan customer. Wishka selalu
                        update dengan
                        trend dan perkembangan kompetensi dalam pembuatan tas untuk menghasilkan tas yang terbaik.
                    </p>
                    <br><br><br>
                </div>
            </div>
            <div class="col-span-1 ml-12"></div>
            <div class="col-span-5">
                <img src="{{ asset('front/image-21.png') }}" alt="" style="width: 100%;">
            </div>
        </div>
    </div>
</section>

<section id="section3" style="padding: 30px 0 70px 0">
    <div class="container">
        <br><br>
        <div class="text-center">
            Percayakan kebutuhan tas custom untuk Brand anda
            <h2 class="text-3xl text-wishka-500 " style="font-weight: 600">BERSAMA WISHKA</h2>
        </div>
        <br>
        <div class="">
            <div class="lg:grid grid-cols-12">
                <div class="col-span-2"></div>
                <div class="lg:grid grid-cols-12 col-span-8 gap-10 text-center">
                    <div class="col-span-6">
                        <img src="{{ asset('front/image_14.png') }}" alt="" style="width: 100%;">
                        <h3 class="text-left text-xl" style="font-weight: 600; margin-top: 10px; margin-bottom: 8px">
                            MINIMAL ORDER CUSTOM RENDAH
                        </h3>
                        <p style="text-align: justify">
                            Minimal order custom yakni 24 pcs yang rendah memudahkan usaha skala kecil untuk dapat
                            mengembangkan brandnya melalui produk tas
                        </p>
                    </div>
                    <div class="col-span-6">
                        <img src="{{ asset('front/image_15.png') }}" alt="" style="width: 100%;">
                        <h3 class="text-left text-xl" style="font-weight: 600; margin-top: 10px; margin-bottom: 8px">
                            DESIGN KREATIF
                        </h3>
                        <p style="text-align: justify">
                            Kami terus mengikuti trend dan menciptakan desain yang menarik dan fungsionalitas sehingga
                            bisa memenuhi kebutuhan serta menghasilkan desain yang ekslusif untuk kebutuhan anda.
                        </p>
                    </div>
                    <div class="col-span-6">
                        <img src="{{ asset('front/image_16.png') }}" alt="" style="width: 100%;">
                        <h3 class="text-left text-xl" style="font-weight: 600; margin-top: 10px; margin-bottom: 8px">
                            MAMPU PRODUKSI SKALA BESAR
                        </h3>
                        <p style="text-align: justify">
                            Mampu menyelesaikan kebutuhan skala besar sesuai kebutuhan brand dan kegiatanmu.
                        </p>
                    </div>
                    <div class="col-span-6">
                        <img src="{{ asset('front/image_17.png') }}" alt="" style="width: 100%;">
                        <h3 class="text-left text-xl" style="font-weight: 600; margin-top: 10px; margin-bottom: 8px">
                            HARGA KOMPETITIF
                        </h3>
                        <p style="text-align: justify">
                            Kami merupaya untuk memberikan harga yang lebih rendah dibandingkan pasaran guna memberikan
                            value pada brand dan saling menguntungkan.
                        </p>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>
<section id="section4" style="padding: 60px 0 0 0;">
    <div class="container " style="margin-bottom: 60px">
        <h2 style="font-size: 36px" class=" font-bold text-white text-center">PORTOFOLIO WISHKA</h2>
        <div class="my-5">
            <livewire:portofolio-wishka/>
        </div>
    </div>
    <div class="lg:grid grid-cols-12">
        <div class="col-span-5">
            <img src="{{ asset('front/workspace.png') }}" alt="" style="width: 100%"
                 class="">
        </div>
        <div class="col-span-5 ml-12">
            <div class="">
                <br>
                <h2 class="text-3xl text-wishka-400" style="font-weight: 700">
                    DAPATKAN PENAWARAN TERBAIK
                </h2> <br>
                <p class="text-lg">
                    Menghasilkan tas yang berkualitas dan mewujudkan dream bag anda adalah salah satu misi kami untuk
                    menjadi salah satu vendor tas terbaik di Indonesia. Melalui Wishka anda bisa mendapatkan keuntungan
                    seperti:
                </p>
                @php($check=['Free Sampel produk','Free Design Custom','Quality Control Setiap Tahap Produksi','Kemampuan Produksi dengan Kapasitas Besar','Garansi Produk'])
                <ul class="mt-3">
                    @foreach($check as $c)
                        <li class="mb-2">
                            <i class="ti ti-check bg-wishka-400 text-white p-0.5 rounded-2xl mr-2"></i>{{ $c }}
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
</section>


<section id="footer">
    <div class="container py-[60px] text-white">
        <div class="lg:grid grid-cols-12 gap-10">
            <div class="col-span-4">
                <div class="text-3xl mb-5 font-bold">
                    WISHKA COMPANY
                </div>
                <p style="text-align: justify">
                    Merupakan vendor tas di Kota Malang yang mampu memberikan pelayanan tas custom dengan kualitas
                    material dan hasil yang memuaskan. Telah bekerjasama dengan 1000++ klien brand lokal di Indonesia.
                </p>
                <br>
                <div style="font-size: 24px;" class="flex gap-5">
                    <i class="fa-brands fa-facebook-f"></i>
                    <i class="fa-brands fa-instagram"></i>
                    <i class="fa-brands fa-tiktok"></i>
                    <i class="fa-brands fa-youtube"></i>
                </div>
            </div>
            <div class="col-span-1"></div>
            <div class="col-span-3">
                <div class="text-3xl mb-5 font-bold">
                PRODUK KAMI
                </div>
                @foreach(\App\Models\ProductCategory::get() as $category)
                    <div style="line-height: 40px" class="text-lg">{{ $category->title }}</div>
                @endforeach
            </div>
            <div class="col-span-4">
                <div class="text-3xl mb-5 font-bold">
                    KONTAK KAMI
                </div>
                <p style="text-align: justify; line-height: 30px">
                    <b>Workshop</b>: Jl Gempol No 02, RT.03, rw 03 Sukun, Kota Malang <br>
                    <b>WhatsApp</b>: +62 812‑5268‑7268 <br>
                    <b>Email</b>: official@wishkacompany.id
                </p>
            </div>
        </div>
    </div>
</section>

</body>
</html>
