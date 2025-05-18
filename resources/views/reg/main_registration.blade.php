<!DOCTYPE html>
<html lang="en">
<head>
    <title>HSTU-RDPC Registrations</title>
    @include('home.css')
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    @include('home.navigation')

    <!-- Registration Hero Section -->
    <div class="registration-hero">
        <div class="container">
            <div class="hero-content text-center">
                <h1 class="display-4 mb-3">Choose Your Event</h1>
                <p class="lead">Participate in our exciting competitions and showcase your talents</p>
            </div>
        </div>
    </div>

    <!-- Registration Options Grid -->
    <div class="container my-5 py-5">
        <div class="row justify-content-center">
            <!-- HSTU RDPC -->
            <div class="col-12 col-sm-6 col-lg-4 mb-4">
                <a href="{{url('/registration')}}" class="card option-card bg-primary text-white">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-trophy fa-4x mb-4"></i>
                        <h3 class="card-title mb-3">HSTU RDPC</h3>
                        <p class="card-text">Join the flagship programming competition</p>
                    </div>
                </a>
            </div>

            <!-- Project Showcasing -->
            <div class="col-12 col-sm-6 col-lg-4 mb-4">
                <a href="{{url('project-showcase')}}" class="card option-card bg-success text-white">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-laptop-code fa-4x mb-4"></i>
                        <h3 class="card-title mb-3">Project Showcasing</h3>
                        <p class="card-text">Present your innovative projects</p>
                    </div>
                </a>
            </div>

            <!-- Gaming Contest -->
            <div class="col-12 col-sm-6 col-lg-4 mb-4">
                <a href="{{url('gaming-contest')}}" class="card option-card bg-danger text-white">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-gamepad fa-4x mb-4"></i>
                        <h3 class="card-title mb-3">Gaming Contest</h3>
                        <p class="card-text">Compete in thrilling gaming battles</p>
                    </div>
                </a>
            </div>

            <!-- Poster Presentation -->
            <div class="col-12 col-sm-6 col-lg-4 mb-4">
                <a href="{{url('poster-presentation')}}" class="card option-card bg-info text-white">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-palette fa-4x mb-4"></i>
                        <h3 class="card-title mb-3">Poster Presentation</h3>
                        <p class="card-text">Showcase your creative designs</p>
                    </div>
                </a>
            </div>

            <!-- IT Quiz -->
            <div class="col-12 col-sm-6 col-lg-4 mb-4">
                <a href="{{url('itquiz')}}" class="card option-card bg-warning text-dark">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-brain fa-4x mb-4"></i>
                        <h3 class="card-title mb-3">IT Quiz</h3>
                        <p class="card-text">Test your tech knowledge</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    @include('home.footer')
    @include('home.jss')

    <style>
    .registration-hero {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        padding: 60px 0 40px 0;
        color: white;
        margin-top: 0px; /* Keep this for fixed navbar */
        position: relative;
        overflow: hidden;
    }

    .registration-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: repeating-linear-gradient(
            45deg,
            rgba(255,255,255,0.05) 0px,
            rgba(255,255,255,0.05) 20px,
            transparent 20px,
            transparent 40px
        );
    }

    .hero-title {
        font-size: 2.5rem;
        font-weight: 700;
        letter-spacing: -0.5px;
        text-transform: uppercase;
        position: relative;
        display: inline-block;
        padding-bottom: 10px;
    }

    .hero-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: rgba(255,255,255,0.3);
        transition: width 0.3s ease;
    }

    .hero-title:hover::after {
        width: 100px;
    }

    .hero-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto;
    }

    @media (max-width: 768px) {
        .registration-hero {
            padding: 40px 0 30px 0;
        }
        
        .hero-title {
            font-size: 2rem;
        }
        
        .hero-subtitle {
            font-size: 1rem;
            padding: 0 15px;
        }
    }
</style>
</body>
</html>