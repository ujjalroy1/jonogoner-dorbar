<!DOCTYPE html>
<html lang="en">

<head>
  <title>HSTU-RDPC</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  @include('home.css')
  <style>
    body {
      background-color: #f8f9fa;
    }

    .card {
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-custom {
      background-color: #007bff;
      color: white;
      padding: 10px 30px;
    }

    .btn-custom:hover {
      background-color: #0056b3;
    }
  </style>
</head>

<body>
  <!-- Navigation -->
  @include('home.navigation')

  <div class="container mt-5">
    <div class="col-lg-8 mx-auto">
      <div class="card p-4">
        <h2 class="bg-primary text-white p-3 text-center rounded">RDCPC Team Registration</h2>

        <!-- Success Message -->
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Validation Errors -->
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <!-- Registration Form -->
        <form action="{{ route('registration_save') }}" method="POST">
          @csrf

          <!-- Institution -->
          <div class="mb-3">
            <label class="form-label fw-bold">Institution</label>
            <input type="text" name="institution" class="form-control" value="{{ old('institution') }}" required>
          </div>

          <!-- Team Name -->
          <div class="mb-3">
            <label class="form-label fw-bold">Team Name</label>
            <input type="text" name="team_name" class="form-control" value="{{ old('team_name') }}" required>
          </div>

          <hr>

          <!-- Members -->
          <h4 class="text-primary">Member 1</h4>
          <div class="mb-3">@include('reg.member_form', ['prefix' => 'member1', 'required' => true])</div>
          <h4 class="text-primary">Member 2</h4>
          <div class="mb-3">@include('reg.member_form', ['prefix' => 'member2'])</div>
          <h4 class="text-primary">Member 3</h4>
          <div class="mb-3">@include('reg.member_form', ['prefix' => 'member3'])</div>

          <hr>

          <!-- Coach -->
          <h4 class="text-primary">Coach Information</h4>
          <div class="mb-3">@include('reg.member_form', ['prefix' => 'coach', 'required' => true])</div>

          <!-- Submit Button -->
          <div class="text-center mt-4">
            <button type="submit" class="btn btn-custom">Register</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Footer -->
  @include('home.footer')
  @include('home.jss')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>