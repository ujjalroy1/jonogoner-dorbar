<footer class="custom-footer">
    <div class="container">
        <div class="footer-grid">
            <!-- About Section -->
            <div class="footer-column">
                <h2 class="footer-heading">HSTU CSE Fest</h2>
                <p>HSTU CSE Fest is a celebration of technology, innovation, and programming excellence, uniting students, professionals, and tech enthusiasts.</p>
                <div class="social-links" role="navigation" aria-label="Social media links">
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="footer-column">
                <h2 class="footer-heading">Quick Links</h2>
                <ul class="footer-links" role="navigation" aria-label="Quick links">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Events</a></li>
                    <li><a href="#">Speakers</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>

            <!-- Events -->
            <div class="footer-column">
                <h2 class="footer-heading">Events</h2>
                <ul class="footer-links" role="navigation" aria-label="Event links">
                    <li><a href="#">Programming Contest</a></li>
                    <li><a href="#">Project Showcasing</a></li>
                    <li><a href="#">Quiz</a></li>
                    <li><a href="#">Tech Talks</a></li>
                    <li><a href="#">Gaming Contest</a></li>
                </ul>
            </div>

            <!-- Sponsors -->
            <div class="footer-column">
                <h2 class="footer-heading">Sponsors</h2>
                <p>We are grateful to our sponsors for supporting the event.</p>
                <ul class="footer-links" role="navigation" aria-label="Sponsor links">
                    <li><a href="#">SP1</a></li>
                    <li><a href="#">SP2</a></li>
                    <li><a href="#">SP3</a></li>
                </ul>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <p>© 2025 <b>DC Office Dinajpur</b>. All rights reserved. Developed with <span class="heart-icon" aria-hidden="true">❤</span> by
                <a href="https://www.linkedin.com/in/ujjal-roy-321103241/" target="_blank" rel="noopener">Ujjal</a> and
                <a href="#" target="_blank" rel="noopener">Abhijit</a>.
            </p>
        </div>
    </div>
</footer>

/* Custom Modern Footer Styles */
<style>
    .custom-footer {
        background: #191f2a;
        /* Deep Dark Blue */
        color: #e5e7eb;
        /* Light Gray */
        padding: 3rem 0 1.5rem;
        font-family: 'Inter', sans-serif;
        /* Modern font stack */
        font-size: 0.875rem;
        /* 14px */
        line-height: 1.6;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .footer-column {
        text-align: left;
    }

    .footer-heading {
        font-size: 1.125rem;
        /* 18px */
        font-weight: 600;
        margin-bottom: 1rem;
        color: #60a5fa;
        /* Sky Blue Accent */
    }

    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li {
        margin-bottom: 0.5rem;
    }

    .footer-links a {
        color: #d1d5db;
        /* Gray */
        text-decoration: none;
        transition: color 0.2s ease, transform 0.2s ease;
    }

    .footer-links a:hover {
        color: #60a5fa;
        /* Sky Blue */
        transform: translateX(4px);
        /* Subtle slide effect */
    }

    .social-links {
        display: flex;
        gap: 0.75rem;
        margin-top: 0.75rem;
    }

    .social-links a {
        color: #e5e7eb;
        font-size: 1.25rem;
        /* 20px */
        transition: color 0.2s ease, transform 0.2s ease;
    }

    .social-links a:hover {
        color: #60a5fa;
        transform: scale(1.1);
        /* Subtle scale effect */
    }

    .footer-bottom {
        text-align: center;
        margin-top: 1.5rem;
        font-size: 0.8125rem;
        /* 13px */
        color: #9ca3af;
        /* Muted Gray */
    }

    .footer-bottom a {
        color: #60a5fa;
        text-decoration: none;
        font-weight: 500;
    }

    .footer-bottom a:hover {
        text-decoration: underline;
    }

    .heart-icon {
        color: #ef4444;
        /* Red */
        font-size: 0.875rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .custom-footer {
            padding: 2rem 0 1rem;
        }

        .footer-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .footer-column {
            text-align: center;
        }

        .social-links {
            justify-content: center;
        }

        .footer-links a:hover {
            transform: none;
            /* Disable slide on mobile for simplicity */
        }
    }
</style>