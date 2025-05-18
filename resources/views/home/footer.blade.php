<footer class="custom-footer">
    <div class="container">
        <div class="footer-grid">
            <!-- About Section -->
            <div class="footer-column">
                <h2 class="footer-heading">HSTU CSE Fest</h2>
                <p>HSTU CSE Fest is the grand celebration of technology, innovation, and programming excellence, bringing together students, professionals, and tech enthusiasts.</p>
                <div class="social-links">
                    <a href="#"><i class="icon-twitter"></i></a>
                    <a href="#"><i class="icon-facebook"></i></a>
                    <a href="#"><i class="icon-instagram"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="footer-column">
                <h2 class="footer-heading">Quick Links</h2>
                <ul class="footer-links">
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
                <ul class="footer-links">
                    <li><a href="#">Programming Contest</a></li>
                    <li><a href="#">Project Showcasing</a></li>
                    <li><a href="#">Quiz</a></li>
                    <li><a href="#">Tech Talks</a></li>
                    <li><a href="#">Gaming Contest</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="footer-column">
                <h2 class="footer-heading">Sponsors</h2>
                <p>We are grateful to our sponsors for supporting the event.</p>
                <ul class="footer-links">
                    <li><a href="#">SP1</a></li>
                    <li><a href="#">SP2</a></li>
                    <li><a href="#">Sp2</a></li>
                    <li><a href="#">Sp4</a></li>
                    <!-- <li><a href="#">Gaming Contest</a></li> -->
                </ul>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <p>Copyright &copy; 2025 All rights reserved by <b>Programmers Arena</b> | 
                Developed with <span class="heart-icon">❤</span> by 
                <a href="https://www.linkedin.com/in/ujjal-roy-321103241/" target="_blank">Ujjal</a> and <a href="#" target="_blank">Abhijit</a>
            </p>
        </div>
    </div>
</footer>

<style>
/* Custom Modern Footer Styles */
.custom-footer {
    background:rgb(25, 31, 42); /* Deep Dark Blue */
    color: #f3f4f6; /* Light Gray */
    padding: 50px 0 20px;
    font-size: 14px;
    line-height: 1.7;
}

.footer-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 40px;
    padding-bottom: 30px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.footer-column {
    text-align: left;
}

.footer-heading {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 15px;
    color: #60a5fa; /* Sky Blue Accent */
}

.footer-links {
    list-style: none;
    padding: 0;
}

.footer-links li {
    margin-bottom: 8px;
}

.footer-links li a {
    color: #d1d5db;
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer-links li a:hover {
    color: #60a5fa; /* Sky Blue Hover */
}

.social-links {
    display: flex;
    gap: 12px;
    margin-top: 10px;
}

.social-links a {
    color: #f3f4f6;
    font-size: 18px;
    transition: color 0.3s ease;
}

.social-links a:hover {
    color: #60a5fa;
}

.newsletter-form {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.newsletter-input {
    padding: 10px;
    border-radius: 6px;
    border: none;
    outline: none;
    background: #1f2937; /* Dark Gray */
    color: #fff;
}

.newsletter-button {
    padding: 10px;
    background: #60a5fa;
    border: none;
    border-radius: 6px;
    color: #fff;
    cursor: pointer;
    transition: background 0.3s ease;
}

.newsletter-button:hover {
    background: #3b82f6; /* Lighter Blue */
}

.footer-bottom {
    text-align: center;
    margin-top: 20px;
    font-size: 13px;
    color: #9ca3af;
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
    color: red;
}

/* Responsive Design */
@media (max-width: 768px) {
    .custom-footer {
        text-align: center;
    }
    
    .footer-grid {
        grid-template-columns: 1fr;
        gap: 25px;
    }
    
    .social-links {
        justify-content: center;
    }
}
</style>
