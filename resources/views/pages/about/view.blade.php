<x-pages-layout title="{{ $title }}">
    <!-- begin:: css local -->
    @push('css')
    @endpush
    <!-- end:: css local -->

    <section class="page-title">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-md-12">
                    <h1>
                        <span>About</span> Us
                    </h1>
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.html">
                                    <i class="bi bi-house-door me-1"></i>Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Pages</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">About Us</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="wave-shape">
            <svg width="100%" height="150px" fill="none">
                <path fill="white">
                    <animate repeatCount="indefinite" fill="freeze" attributeName="d" dur="10s" values="
          M0 25.9086C277 84.5821 433 65.736 720 25.9086C934.818 -3.9019 1214.06 -5.23669 1442 8.06597C2079 45.2421 2208 63.5007 2560 25.9088V171.91L0 171.91V25.9086Z;
          M0 86.3149C316 86.315 444 159.155 884 51.1554C1324 -56.8446 1320.29 34.1214 1538 70.4063C1814 116.407 2156 188.408 2560 86.315V232.317L0 232.316V86.3149Z;
          M0 53.6584C158 11.0001 213 0 363 0C513 0 855.555 115.001 1154 115.001C1440 115.001 1626 -38.0004 2560 53.6585V199.66L0 199.66V53.6584Z;
          M0 25.9086C277 84.5821 433 65.736 720 25.9086C934.818 -3.9019 1214.06 -5.23669 1442 8.06597C2079 45.2421 2208 63.5007 2560 25.9088V171.91L0 171.91V25.9086Z"></animate>
                </path>
            </svg>
        </div>
    </section>

    <div class="page-content">
        <section>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <img class="img-fluid" src="{{ asset_pages('images/about/03.png') }}" alt="">
                    </div>
                    <div class="col-lg-6 col-md-12 mt-6 mt-lg-0 ps-lg-10">
                        <div class="theme-title mb-4">
                            <h6>About Us</h6>
                            <h2>We're Best In Software Development</h2>
                        </div>
                        <p class="mb-5">Scale your software operations through a custom engineering team. Meet the
                            demand of your
                            company’s operations with a high-performing nearshore team skilled in the technologies you
                            need.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="overflow-hidden p-0">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col">
                        <div class="marquee-wrap">
                            <div class="marquee-text">
                                <span>A Smart Software Application</span>
                                <i class="bi bi-dot"></i>
                                <span>Sass Landing Page</span>
                                <i class="bi bi-dot"></i>
                                <span>Build Software For Business</span>
                                <i class="bi bi-dot"></i>
                                <span>Startup Business</span>
                                <i class="bi bi-dot"></i>
                                <span>Creative Design</span>
                                <i class="bi bi-dot"></i>
                                <span>Software & Sass Landing Page</span>
                                <i class="bi bi-dot"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="featured-item style-1">
                            <div class="featured-icon">
                                <img class="img-fluid" src="{{ asset_pages('images/feature/01.png') }}" alt="">
                            </div>
                            <div class="featured-title">
                                <h5>Digital Design</h5>
                            </div>
                            <div class="featured-desc">
                                <p>See your authentic mission, and values come to life with a unique brand image.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mt-6">
                        <div class="featured-item style-1">
                            <div class="featured-icon">
                                <img class="img-fluid" src="{{ asset_pages('images/feature/02.png') }}" alt="">
                            </div>
                            <div class="featured-title">
                                <h5>New Brands</h5>
                            </div>
                            <div class="featured-desc">
                                <p>See your authentic mission, and values come to life with a unique brand image.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mt-6 mt-lg-0">
                        <div class="featured-item style-1">
                            <div class="featured-icon">
                                <img class="img-fluid" src="{{ asset_pages('images/feature/03.png') }}" alt="">
                            </div>
                            <div class="featured-title">
                                <h5>User Experience</h5>
                            </div>
                            <div class="featured-desc">
                                <p>See your authentic mission, and values come to life with a unique brand image.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mt-6">
                        <div class="featured-item style-1">
                            <div class="featured-icon">
                                <img class="img-fluid" src="{{ asset_pages('images/feature/04.png') }}" alt="">
                            </div>
                            <div class="featured-title">
                                <h5>Helping Support</h5>
                            </div>
                            <div class="featured-desc">
                                <p>See your authentic mission, and values come to life with a unique brand image.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="light-bg" data-bg-img="{{ asset_pages('images/bg/02.png') }}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="theme-title">
                            <h6>Pricing Plan</h6>
                            <h2>Choose Affordable Prices</h2>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-md-12">
                                <div class="price-table">
                                    <div class="price-header">
                                        <div>
                                            <h3 class="price-title">Basic</h3>
                                            <div class="price-value">
                                                <h2>
                                                    <sup>$</sup>34
                                                </h2>
                                                <span>/Month</span>
                                            </div>
                                        </div>
                                        <div class="price-icon">
                                            <img class="img-fluid" src="{{ asset_pages('images/price-icon/01') }}.png" alt="">
                                        </div>
                                    </div>
                                    <p>Our plans come with a 100% free 14 day trial. No credit card needed.</p>
                                    <div class="price-list">
                                        <ul class="list-unstyled">
                                            <li>
                                                <i class="bi bi-check-lg"></i>50 Gb Bandwidth
                                            </li>
                                            <li>
                                                <i class="bi bi-check-lg"></i>Unlimited Site licenses
                                            </li>
                                            <li>
                                                <i class="bi bi-check-lg"></i>10 Free Optimization
                                            </li>
                                            <li>
                                                <i class="bi bi-check-lg"></i>24/7 Hours Support
                                            </li>
                                        </ul>
                                    </div>
                                    <a class="themeht-btn mt-5" href="#">Purchase Now</a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 mt-6 mt-lg-0">
                                <div class="price-table">
                                    <div class="price-header">
                                        <div>
                                            <h3 class="price-title">Standard</h3>
                                            <div class="price-value">
                                                <h2>
                                                    <sup>$</sup>49
                                                </h2>
                                                <span>/Month</span>
                                            </div>
                                        </div>
                                        <div class="price-icon">
                                            <img class="img-fluid" src="{{ asset_pages('images/price-icon/02') }}.png" alt="">
                                        </div>
                                    </div>
                                    <p>Our plans come with a 100% free 14 day trial. No credit card needed.</p>
                                    <div class="price-list">
                                        <ul class="list-unstyled">
                                            <li>
                                                <i class="bi bi-check-lg"></i>50 Gb Bandwidth
                                            </li>
                                            <li>
                                                <i class="bi bi-check-lg"></i>Unlimited Site licenses
                                            </li>
                                            <li>
                                                <i class="bi bi-check-lg"></i>10 Free Optimization
                                            </li>
                                            <li>
                                                <i class="bi bi-check-lg"></i>24/7 Hours Support
                                            </li>
                                        </ul>
                                    </div>
                                    <a class="themeht-btn mt-5" href="#">Purchase Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="overflow-hidden">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="main-timeline position-relative">
                            <div class="timeline_item">
                                <div class="date-content timeline-order-1b">
                                    <div class="date">
                                        2020
                                    </div>
                                </div>
                                <div class="timeline-icon timeline-order-2b">
                                    <i class="flaticon flaticon-art"></i>
                                </div>
                                <div class="timeline-content timeline-order-3b col-md">
                                    <h4>Unlimited Colors</h4>
                                    <p>A seamless UI experience: Lorem Ipsum is simply of the printing typesetting has
                                        been the industry’s
                                        standard dummy text. Employ global development standards: Lorem ipsum dolorcon
                                        sectetur adipiscing
                                        elitut.</p>
                                </div>
                            </div>
                            <div class="timeline_item">
                                <div class="date-content timeline-order-1">
                                    <div class="date">
                                        2021
                                    </div>
                                </div>
                                <div class="timeline-icon timeline-order-2">
                                    <i class="flaticon flaticon-jigsaw"></i>
                                </div>
                                <div class="timeline-content timeline-order-3 col-md">
                                    <h4>Unique Features</h4>
                                    <p>A seamless UI experience: Lorem Ipsum is simply of the printing typesetting has
                                        been the industry’s
                                        standard dummy text. Employ global development standards: Lorem ipsum dolorcon
                                        sectetur adipiscing
                                        elitut.</p>
                                </div>
                            </div>
                            <div class="timeline_item">
                                <div class="date-content timeline-order-1b">
                                    <div class="date">
                                        2022
                                    </div>
                                </div>
                                <div class="timeline-icon timeline-order-2b">
                                    <i class="flaticon flaticon-layouts"></i>
                                </div>
                                <div class="timeline-content timeline-order-3b col-md">
                                    <h4>Layout Option</h4>
                                    <p>A seamless UI experience: Lorem Ipsum is simply of the printing typesetting has
                                        been the industry’s
                                        standard dummy text. Employ global development standards: Lorem ipsum dolorcon
                                        sectetur adipiscing
                                        elitut.</p>
                                </div>
                            </div>
                            <div class="timeline_item">
                                <div class="date-content timeline-order-1">
                                    <div class="date">
                                        2023
                                    </div>
                                </div>
                                <div class="timeline-icon timeline-order-2">
                                    <i class="flaticon flaticon-web-design"></i>
                                </div>
                                <div class="timeline-content timeline-order-3 col-md">
                                    <h4>Fully Responsive</h4>
                                    <p>A seamless UI experience: Lorem Ipsum is simply of the printing typesetting has
                                        been the industry’s
                                        standard dummy text. Employ global development standards: Lorem ipsum dolorcon
                                        sectetur adipiscing
                                        elitut.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- begin:: js local -->
    @push('js')
    @endpush
    <!-- end:: js local -->
</x-pages-layout>