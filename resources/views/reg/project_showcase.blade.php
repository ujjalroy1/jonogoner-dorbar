<!DOCTYPE html>
<html lang="en">
  <head>
  <title>project showcasing Registration</title>
  @include('home.css')
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Space+Mono&display=swap" rel="stylesheet">
  </head>
  <body>
    
     <!-- navbar -->
	  @include('home.navigation')
	  <!-- endnavbar -->
    
      <style>
    .registration-container {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 2rem;
        background: linear-gradient(135deg, #6366f1 0%, #a855f7 50%, #ec4899 100%);
        position: relative;
        overflow: hidden;
    }

    .registration-container::before {
        content: '';
        position: absolute;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
        transform: rotate(45deg);
    }

    .registration-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        padding: 3rem;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 640px;
        position: relative;
        z-index: 1;
        transition: transform 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .section-title {
        color: #1e293b;
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        font-family: 'Inter', sans-serif;
        text-align: center;
        background: linear-gradient(45deg, #6366f1, #ec4899);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .countdown-container {
        margin: 2rem 0;
        text-align: center;
    }

    .countdown-box {
        display: flex;
        justify-content: center;
        gap: 1.5rem;
        padding: 2rem;
        background: rgba(99, 102, 241, 0.1);
        border-radius: 16px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        margin: 2rem 0;
    }

    .countdown-item {
        text-align: center;
        position: relative;
    }

    .countdown-item:not(:last-child)::after {
        content: ":";
        position: absolute;
        right: -1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #6366f1;
        font-size: 2rem;
        font-weight: bold;
    }

    .countdown-number {
        font-size: 2.5rem;
        font-weight: 700;
        font-family: 'Space Mono', monospace;
        color: #1e293b;
        line-height: 1;
    }

    .countdown-label {
        font-size: 0.9rem;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-top: 0.5rem;
    }

    .qr-container {
        margin: 2rem auto;
        padding: 1rem;
        background: white;
        border-radius: 16px;
        display: inline-block;
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .qr-container:hover {
        transform: translateY(-5px);
    }

    .qr-code {
        width: 220px;
        height: auto;
        border-radius: 12px;
    }

    .google-form-btn {
        display: inline-flex;
        align-items: center;
        padding: 1rem 2rem;
        background: linear-gradient(45deg, #6366f1, #8b5cf6);
        color: white !important;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        margin-top: 1.5rem;
        border: none;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .google-form-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(99, 102, 241, 0.4);
        background: linear-gradient(45deg, #8b5cf6, #6366f1);
    }

    .expired-message {
        color: #ef4444;
        font-size: 2rem;
        font-weight: 700;
        padding: 2rem;
        border-radius: 16px;
        background: rgba(239, 68, 68, 0.1);
        text-align: center;
        animation: pulse 2s infinite;
        border: 2px solid #ef4444;
    }

    .instruction-text {
        color: #475569;
        font-size: 1.1rem;
        line-height: 1.6;
        margin: 1.5rem 0;
        text-align: center;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.02); opacity: 0.9; }
    }

    @media (max-width: 768px) {
        .registration-card {
            padding: 2rem;
            margin: 1rem;
        }

        .countdown-box {
            gap: 0.8rem;
            padding: 1.5rem;
        }

        .countdown-number {
            font-size: 1.8rem;
        }

        .countdown-label {
            font-size: 0.7rem;
        }

        .countdown-item:not(:last-child)::after {
            right: -0.8rem;
            font-size: 1.5rem;
        }
    }

    @media (max-width: 480px) {
        .countdown-box {
            gap: 0.5rem;
            padding: 1rem;
        }

        .countdown-number {
            font-size: 1.5rem;
        }

        .countdown-label {
            font-size: 0.6rem;
        }

        .countdown-item:not(:last-child)::after {
            right: -0.6rem;
            font-size: 1.2rem;
        }
    }

    /* Status Colors */
    .status-pending .countdown-box {
        background: rgba(249, 115, 22, 0.1);
        border-color: rgba(249, 115, 22, 0.2);
    }

    .status-open .countdown-box {
        background: rgba(16, 185, 129, 0.1);
        border-color: rgba(16, 185, 129, 0.2);
    }

    /* Animation Enhancements */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .registration-card {
        animation: fadeInUp 0.6s cubic-bezier(0.23, 1, 0.32, 1);
    }
</style>

<div class="registration-container">
    <div class="registration-card status-{{ $registrationStatus }}">
        <h1 class="section-title">HSTU RDPC Registration</h1>

        @if($registrationStatus === 'pending')
            <div class="countdown-container">
                <div class="countdown-box">
                    <div class="countdown-item">
                        <div class="countdown-number" id="days">00</div>
                        <div class="countdown-label">Days</div>
                    </div>
                    <div class="countdown-item">
                        <div class="countdown-number" id="hours">00</div>
                        <div class="countdown-label">Hours</div>
                    </div>
                    <div class="countdown-item">
                        <div class="countdown-number" id="minutes">00</div>
                        <div class="countdown-label">Minutes</div>
                    </div>
                    <div class="countdown-item">
                        <div class="countdown-number" id="seconds">00</div>
                        <div class="countdown-label">Seconds</div>
                    </div>
                </div>
                <p class="instruction-text">
                    Registration opens on {{ $startDate->format('F j, Y \a\t H:i') }}
                </p>
            </div>

        @elseif($registrationStatus === 'open')
            <div class="countdown-container">
                <div class="countdown-box">
                    <div class="countdown-item">
                        <div class="countdown-number" id="days">00</div>
                        <div class="countdown-label">Days</div>
                    </div>
                    <div class="countdown-item">
                        <div class="countdown-number" id="hours">00</div>
                        <div class="countdown-label">Hours</div>
                    </div>
                    <div class="countdown-item">
                        <div class="countdown-number" id="minutes">00</div>
                        <div class="countdown-label">Minutes</div>
                    </div>
                    <div class="countdown-item">
                        <div class="countdown-number" id="seconds">00</div>
                        <div class="countdown-label">Seconds</div>
                    </div>
                </div>
            </div>

            <div class="registration-content">
                <p class="instruction-text">
                    Scan the QR code below to register instantly
                </p>

                <div class="qr-container">
                    <a href="https://forms.gle/GMy71xqwbdKUjZdg7" target="_blank">
                        <img src="{{ asset('user_view/images/Project_Showcasing.png') }}" alt="QR Code" class="qr-code">
                    </a>
                </div>

                <p class="instruction-text">
                    Or register using our Google Form
                </p>

                <a href="https://forms.gle/GMy71xqwbdKUjZdg7" class="google-form-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" style="margin-right: 8px;">
                        <path d="M20 2a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h16zm-8 3.5a4.5 4.5 0 1 0 0 9 4.5 4.5 0 0 0 0-9zM12 16v4h6v-4h-6z"/>
                    </svg>
                    Google Form Registration
                </a>
            </div>

        @else
            <div class="expired-message">
                Registration Closed!
            </div>
            <p class="instruction-text" style="color: #666; margin-top: 1rem;">
                The registration period ended on {{ $endDate->format('F j, Y \a\t H:i') }}
            </p>
        @endif
    </div>
</div>

<script>
    @if(in_array($registrationStatus, ['pending', 'open']))
    // Convert server-side dates to client-side timezone
    const deadline = new Date("{{ ($registrationStatus === 'pending' ? $startDate : $endDate)->toIso8601String() }}");
    let hasReloaded = false;

    function updateCountdown() {
        const now = new Date();
        const diff = deadline - now;

        // Handle expiration
        if (diff < 0) {
            if (!hasReloaded) {
                hasReloaded = true;
                window.location.reload();
            }
            return;
        }

        // Calculate time units
        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
        const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((diff % (1000 * 60)) / 1000);

        // Update display
        document.getElementById('days').textContent = days.toString().padStart(2, '0');
        document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
        document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
        document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
    }

    // Initial update and set interval
    updateCountdown();
    const countdownInterval = setInterval(updateCountdown, 1000);

    // Cleanup interval when leaving page
    window.addEventListener('beforeunload', () => {
        clearInterval(countdownInterval);
    });
    @endif
</script>

     <!-- footer -->
	    @include('home.footer')
	  <!-- end footer -->
  
  <!-- loader -->
  <!-- js -->
   @include('home.jss')
  <!-- end js -->
    
  </body>
</html>