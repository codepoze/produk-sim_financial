<header id="site-header" class="header">
    <div id="header-wrap">
        <div class="container">
            <div class="row">
                <div class="col">
                    <!-- Navbar -->
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand logo" href="index.html">
                            <span>Sof</span>ten.
                        </a>
                        <button class="navbar-toggler ht-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <svg width="100" height="100" viewBox="0 0 100 100">
                                <path class="line line1" d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058">
                                </path>
                                <path class="line line2" d="M 20,50 H 80"></path>
                                <path class="line line3" d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942">
                                </path>
                            </svg>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <!-- Left nav -->
                            <ul class="nav navbar-nav mx-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('home') }}">{{ __('menu.home') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('about') }}">{{ __('menu.about') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('auth.login') }}">Login</a>
                                </li>
                            </ul>
                        </div>
                        <a class="themeht-btn dark-btn" href="#">Buy Now</a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>