<nav class="custom-navbar navbar navbar-expand-lg navbar-dark fixed-top shadow-sm">
    <div class="container-fluid px-lg-5 d-flex align-items-center justify-content-between">
        <!-- Left Logo & Title -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('user_view/images/bdgovt.png') }}" alt="Govt Logo" class="logo-img me-2">
            <span class="fw-bold">জনগনের দরবার</span>
        </a>

        <!-- Toggle Button for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Nav Items -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarContent">
            <ul class="navbar-nav text-center text-lg-start">
                <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home') }}">হোম</a>
                </li>
                <li class="nav-item {{ request()->is('ovijogs') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('ovijogs') }}">অভিযোগ</a>
                </li>
                <li class="nav-item {{ request()->routeIs('main_registration') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('main_registration') }}">অভিযোগ ট্র্যাকিং</a>
                </li>
                <li class="nav-item {{ request()->routeIs('emergency.create') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('emergency.create') }}">জরুরি সেবা</a>
                </li>
                <li class="nav-item {{ request()->routeIs('chat.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('chat.index') }}">লাইভ চ্যাট</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        লগ আউট
                    </a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                @else
                <li class="nav-item {{ request()->routeIs('login') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('login') }}">লগইন</a>
                </li>
                <li class="nav-item {{ request()->routeIs('register') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('register') }}">রেজিস্টার</a>
                </li>
                @endauth
            </ul>
        </div>

        <!-- Right Logo (Desktop only) -->
        <a class="navbar-brand d-none d-lg-flex" href="{{ route('home') }}">
            <img src="{{ asset('user_view/images/bdgovt.png') }}" alt="Govt Logo" class="logo-img">
        </a>
    </div>
</nav>
<style>
    .custom-navbar {
        background: linear-gradient(45deg, #0d47a1, #1976d2, #2196f3);
        padding: 0.75rem 1rem;
        z-index: 1050;
        transition: all 0.3s ease-in-out;
    }

    .custom-navbar .logo-img {
        height: 40px;
        width: auto;
    }

    .custom-navbar .navbar-brand span {
        font-size: 1.25rem;
        color: #fff;
    }

    .custom-navbar .nav-link {
        color: rgba(255, 255, 255, 0.85);
        font-size: 0.95rem;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        transition: all 0.2s ease-in-out;
    }

    .custom-navbar .nav-link:hover,
    .custom-navbar .nav-item.active .nav-link {
        background-color: rgba(255, 255, 255, 0.25);
        color: #fff;
    }

    .navbar-toggler {
        border: none;
        outline: none;
    }

    /* Prevent overlap with fixed navbar */
    body {
        padding-top: 70px;
    }

    @media (max-width: 991px) {
        .custom-navbar .navbar-collapse {
            background-color: rgba(0, 0, 0, 0.95);
            padding: 1rem;
            border-radius: 0.5rem;
            margin-top: 0.5rem;
        }

        .custom-navbar .navbar-nav {
            flex-direction: column;
            gap: 0.5rem;
        }

        .custom-navbar .navbar-brand.d-none.d-lg-flex {
            display: none !important;
        }

        .custom-navbar .navbar-brand span {
            font-size: 1.1rem;
        }
    }
</style>