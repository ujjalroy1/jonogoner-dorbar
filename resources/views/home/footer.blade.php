<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS for sticky footer -->
  <style>
    html {
      height: 100%;
    }

    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      margin: 0;
    }

    main {
      flex: 1 0 auto;
    }

    footer {
      flex-shrink: 0;
    }

    .hover-effect:hover {
      color: #ffc107 !important;
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <!-- Your page content -->
  <main>
    @yield('content')
  </main>

  <!-- Bootstrap 5 Enhanced Sticky Footer -->
  <footer class="bg-dark text-white py-4 border-top border-secondary">
    <div class="container text-center text-md-start">
      <div class="row align-items-center">
        <div class="col-12 text-center">
          <p class="mb-0 fw-light small">
            © ২০২৫ <strong>ডিসি অফিস দিনাজপুর</strong>। সর্বস্বত্ব সংরক্ষিত।
          </p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>