<nav class="navbar navbar-expand-lg navbar-dark shadow-sm fixed-top">
    <div class="container d-flex align-items-center justify-content-between">
        <!-- Left Logo & Title -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('user_view/images/pac_logo.png') }}" alt="Logo 1" class="logo-img">
            <span class="ml-2 fw-bold">Jonogoner Dorbar</span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="ftco-nav">
            <ul class="navbar-nav">
                <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item {{ request()->is('schedule') ? 'active' : '' }}">
                    <a href="{{url('schedule')}}" class="nav-link">অভিযোগ</a>
                </li>
                <li class="nav-item {{ request()->routeIs('main_registration') ? 'active' : '' }}">
                    <a href="{{ route('main_registration') }}" class="nav-link">অভিযোগ ট্র্যাকিং</a>
                </li>
                <li class="nav-item {{ request()->routeIs('payment_create') ? 'active' : '' }}">
                    <a href="{{ route('payment_create') }}" class="nav-link">জরুরি সেবা</a>
                </li>
                <li class="nav-item {{ request()->routeIs('registration_list') ? 'active' : '' }}">
                    <a href="{{ route('registration_list') }}" class="nav-link">লাইভ চ্যাট</a>
                </li>
                <!-- <li class="nav-item {{ request()->routeIs('approve_list') ? 'active' : '' }}">
                    <a href="{{ route('approve_list') }}" class="nav-link">Approved Teams</a>
                </li>
                <li class="nav-item {{ request()->is('gellary') ? 'active' : '' }}">
                    <a href="{{url('gellary')}}" class="nav-link">Gallery</a>
                </li>
                <li class="nav-item {{ request()->is('contact') ? 'active' : '' }}">
                    <a href="{{url('contact')}}" class="nav-link">Contact</a>
                </li> -->
                <!-- <li class="nav-item {{ request()->routeIs('project_showcase') ? 'active' : '' }}">
                    <a href="{{url('project-showcase')}}" class="nav-link">project_showcase</a>

                <li class="nav-item {{ request()->is('contact') ? 'active' : '' }}">
                    <a href="{{route('showForm') }}" class="nav-link">Message</a>
                </li> -->
            </ul>
        </div>


        <a class="navbar-brand d-none d-lg-block" href="{{ route('home') }}">
            <img src="{{ asset('user_view/images/hstu logo.jpg') }}" alt="Logo 2" class="logo-img">
        </a>
    </div>
</nav>

<style>
    /* Adjust body padding to avoid navbar overlap */
    body {
        padding-top: 80px;
        /* Adjust this value based on navbar height */
    }

    /* Navbar Styling */
    .navbar {
        background: linear-gradient(45deg, #0d47a1, #1976d2, #2196f3);
        /* Gradient effect */
        padding: 12px 0;
        transition: all 0.3s ease-in-out;
    }

    .logo-img {
        height: 45px;
        width: auto;
    }

    .navbar-brand span {
        font-size: 1.3rem;
        font-weight: bold;
        color: #fff;
        transition: color 0.3s ease-in-out;
    }

    .navbar-nav .nav-item {
        margin: 0 8px;
    }

    /* Navigation Links */
    .nav-link {
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.8);
        transition: all 0.3s ease-in-out;
        padding: 8px 15px;
        border-radius: 8px;
    }

    .nav-link:hover,
    .nav-item.active .nav-link {
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
    }

    /* Mobile View */
    @media (max-width: 991px) {
        .navbar-nav {
            text-align: center;
            background: rgba(0, 0, 0, 0.9);
            padding: 15px 0;
            border-radius: 8px;
        }

        .navbar-brand.d-none.d-lg-block {
            display: none !important;
        }

        .navbar-toggler {
            border: none;
            outline: none;
        }
    }
</style>