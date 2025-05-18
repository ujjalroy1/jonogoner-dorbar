<!DOCTYPE html>
<html lang="en">
<head>
    <title>Gallery - HSTU-RDPC</title>
    @include('home.css')
    <style>
        .gallery-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 50px 20px;
        }
        .gallery-container h2 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }
        .gallery-container p {
            font-size: 1.2rem;
            color: #666;
            max-width: 700px;
            margin-bottom: 30px;
        }
        .gallery-btn {
            display: inline-block;
            background: #ff6b6b;
            color: white;
            padding: 12px 24px;
            font-size: 1.2rem;
            border-radius: 8px;
            text-decoration: none;
            transition: background 0.3s;
        }
        .gallery-btn:hover {
            background: #e63946;
        }
    </style>
</head>
<body>
    @include('home.navigation')

    <div class="gallery-container">
        <h2>HSTU-RDPC Gallery</h2>
        <p>Explore the memorable moments from the HSTU-RDPC event. Click the button below to view the full gallery on Google Drive.</p>
        <a href="#" target="_blank" class="gallery-btn">View Gallery</a>
    </div>

    @include('home.footer')
    @include('home.jss')
</body>
</html>
