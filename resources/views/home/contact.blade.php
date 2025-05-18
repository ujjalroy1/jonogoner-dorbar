<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact - HSTU-RDPC</title>
    @include('home.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f7f6;
            color: #333;
        }

        .contact-container {
            max-width: 800px;
            margin: 80px auto;
            padding: 40px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .contact-container h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 30px;
            position: relative;
        }

        .contact-container h2::after {
            content: '';
            width: 60px;
            height: 4px;
            background: #3498db;
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 2px;
        }

        .contact-container .section {
            margin-bottom: 40px;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .contact-container .section:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .contact-container h3 {
            font-size: 1.8rem;
            font-weight: 600;
            color: #34495e;
            margin-bottom: 20px;
        }

        .contact-container p {
            font-size: 1.1rem;
            color: #555;
            margin: 10px 0;
        }

        .contact-container strong {
            font-size: 1.2rem;
            color: #2c3e50;
            font-weight: 600;
        }

        .contact-container a {
            color: #3498db;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .contact-container a:hover {
            color: #2980b9;
        }

        .contact-container .icon {
            font-size: 1.5rem;
            margin-right: 10px;
            color: #3498db;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .contact-container {
                padding: 20px;
                margin: 40px auto;
            }

            .contact-container h2 {
                font-size: 2rem;
            }

            .contact-container h3 {
                font-size: 1.5rem;
            }

            .contact-container p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    @include('home.navigation')

    <div class="contact-container">
        <h2>Contact Us</h2>
        
        <!-- Registration Section -->
        <div class="section">
            <h3>Registration</h3>
            <div class="contact-info">
                <p><i class="fas fa-user icon"></i><strong>Ujjal Roy</strong></p>
                <p><i class="fas fa-envelope icon"></i>Email: <a href="mailto:ujjalroy1011@gmail.com">ujjalroy1011@gmail.com</a></p>
                <p><i class="fas fa-phone icon"></i>Phone: <a href="tel:01751961572">01751961572</a></p>
            </div>
            <div class="contact-info">
                <p><i class="fas fa-user icon"></i><strong>Abhijite Deb Barman</strong></p>
                <p><i class="fas fa-envelope icon"></i>Email: <a href="mailto:dbabhijite@gmail.com">dbabhijite@gmail.com</a></p>
                <p><i class="fas fa-phone icon"></i>Phone: <a href="tel:01710597706">01710597706</a></p>
            </div>
            <div class="contact-info">
                <p><i class="fas fa-user icon"></i><strong>Hamday Rabby Hossain</strong></p>
                <p><i class="fas fa-envelope icon"></i>Email: <a href="mailto:hamdayrabby385@gmail.com">hamdayrabby385@gmail.com</a></p>
                <p><i class="fas fa-phone icon"></i>Phone: <a href="tel:01720908856">01720908856</a></p>
            </div>
        </div>
        
        <!-- More Information Section -->
        <div class="section">
            <h3>For More Information</h3>
            <div class="contact-info">
                <p><i class="fas fa-user icon"></i><strong>Meharaj Mithu</strong></p>
                <p><i class="fas fa-envelope icon"></i>Email: <a href="mailto:mehrajmithu222@gmail.com">mehrajmithu222@gmail.com</a></p>
                <p><i class="fas fa-phone icon"></i>Phone: <a href="tel:01787202970">01787202970</a></p>
            </div>
        </div>
        
        <!-- Teacher Section -->
        <div class="section">
            <h3>Teacher</h3>
            <div class="contact-info">
                <p><i class="fas fa-user icon"></i><strong>Pankaj Bhowmik Sir</strong></p>
                <p><i class="fas fa-envelope icon"></i>Email: <a href="mailto:pankaj.cshstu@gmail.com">pankaj.cshstu@gmail.com</a></p>
                <p><i class="fas fa-phone icon"></i>Phone: <a href="tel:01791848439">01791848439</a></p>
            </div>
        </div>
    </div>

    @include('home.footer')
    @include('home.jss')
</body>
</html>