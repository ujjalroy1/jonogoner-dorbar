<!DOCTYPE html>
<html>

<head>
  @include('admin.css')
</head>

<body>

  <!-- header -->
  @include('admin.header')
  <!-- header end -->
  <!-- sidebar -->

  @include('admin.sidebar')

  <!-- Sidebar Navigation end-->
  <div class="page-content">
    <div class="page-header">
      <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Dashboard</h2>
      </div>
    </div>

    <div>
      <!-- resources/views/select_recipients.blade.php -->
      <form action="{{ route('sendMessage') }}" method="POST">
        @csrf

        <label>Select Recipients:</label><br>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
        <label>
          <input type="checkbox" name="team_members" value="1" checked> Team Members
        </label><br>

        <!-- Checkbox for coach -->
        <label>
          <input type="checkbox" name="coach" value="1"> Coach
        </label><br>

        <!-- Select message file (you can change it to your own files) -->
        <label for="message_file">Select Message:</label>
        <select name="message_file" required>
          <option value="message1">Message 1</option>
          <option value="message2">Message 2</option>
          <!-- Add more message options as needed -->
        </select><br>

        <button type="submit">Send Message</button>
      </form>

    </div>


  </div>

  <!-- JavaScript files -->
  @include('admin.jss')
  <!-- end js -->

</body>

</html>