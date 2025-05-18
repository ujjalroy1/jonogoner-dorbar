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

          @if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table border="1">
    <tr>
        <th>Team Name</th>
        <th>Payment From</th>
        <th>Payment To</th>
        <th>Transaction ID</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    @foreach ($payments as $payment)
    <tr>
        <td>{{ $payment->team_name }}</td>
        <td>{{ $payment->payment_from }}</td>
        <td>{{ $payment->payment_to }}</td>
        <td>{{ $payment->transaction_id }}</td>
        <td>
            @if ($payment->approved)
            <button class="btn btn-success" disabled>Paid</button>
            @else
            <form action="{{ route('approvePayment', $payment->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Pay</button>
            </form>
            @endif
        </td>
        <td>
            <form action="{{ route('deletePayment', $payment->id) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this payment?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>





          
          </div>

            
      </div>
    
<!-- JavaScript files -->
   @include('admin.jss')
 <!-- end js -->

  </body>
</html>