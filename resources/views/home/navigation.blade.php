<nav class="custom-navbar navbar navbar-expand-lg navbar-dark shadow-sm fixed-top">
    <div class="container d-flex align-items-center justify-content-between">
        <!-- Left Logo & Title -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('user_view/images/bdgovt.png') }}" alt="Government of Bangladesh Logo" class="logo-img">
            <span class="ms-2 fw-bold">Jonogoner Dorbar</span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="ftco-nav">
            <ul class="navbar-nav" role="navigation" aria-label="Main navigation">
                <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item {{ request()->is('ovijogs') ? 'active' : '' }}">
                    <a href="{{ url('ovijogs') }}" class="nav-link">অভিযোগ</a>
                </li>
                <li class="nav-item {{ request()->routeIs('main_registration') ? 'active' : '' }}">
                    <a href="{{ route('main_registration') }}" class="nav-link">অভিযোগ ট্র্যাকিং</a>
                </li>
                <li class="nav-item {{ request()->routeIs('payment_create') ? 'active' : '' }}">
                    <a href="{{ route('payment_create') }}" class="nav-link">জরুরি সেবা</a>
                </li>
                <li class="nav-item {{ request()->routeIs('chat.index') ? 'active' : '' }}">
                    <a href="{{ route('chat.index') }}" class="nav-link">লাইভ চ্যাট</a>
                </li>
                @auth
                <li class="nav-item">
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="nav-link">Logout</a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                @else
                <li class="nav-item {{ request()->routeIs('login') ? 'active' : '' }}">
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                </li>
                <li class="nav-item {{ request()->routeIs('register') ? 'active' : '' }}">
                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                </li>
                @endauth
            </ul>
        </div>
        <a class="navbar-brand d-none d-lg-block" href="{{ route('home') }}">
            <img src="{{ asset('user_view/images/bdgovt.png') }}" alt="Government of Bangladesh Logo" class="logo-img">
        </a>
    </div>
</nav>

<style>
    /* Custom Navbar Styling */
    .custom-navbar {
        background: linear-gradient(45deg, #0d47a1, #1976d2, #2196f3);
        padding: 0.75rem 0;
        transition: background 0.3s ease-in-out;
    }

    .custom-navbar .logo-img {
        height: 2.5rem;
        /* 40px */
        width: auto;
    }

    .custom-navbar .navbar-brand span {
        font-size: 1.25rem;
        /* 20px */
        font-weight: 700;
        color: #fff;
    }

    .custom-navbar .navbar-nav .nav-item {
        margin: 0 0.5rem;
    }

    .custom-navbar .nav-link {
        font-size: 0.95rem;
        /* 15px */
        color: rgba(255, 255, 255, 0.85);
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        transition: background 0.2s ease, color 0.2s ease;
    }

    .custom-navbar .nav-link:hover,
    .custom-navbar .nav-item.active .nav-link {
        background: rgba(255, 255, 255, 0.25);
        color: #fff;
    }

    .custom-navbar .navbar-toggler {
        border: none;
        outline: none;
    }

    /* Prevent content overlap */
    body {
        padding-top: 4.5rem;
        /* Match navbar height */
    }

    /* Mobile View */
    @media (max-width: 991px) {
        .custom-navbar .navbar-nav {
            text-align: center;
            background: rgba(0, 0, 0, 0.95);
            padding: 1rem;
            border-radius: 0.5rem;
            margin-top: 0.5rem;
        }

        .custom-navbar .navbar-brand.d-none.d-lg-block {
            display: none !important;
        }
    }
</style>