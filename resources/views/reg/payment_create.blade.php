<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Submission</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @include('home.css')
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .btn-custom {
            background-color: #28a745;
            color: white;
            padding: 10px 12px;
            font-size: 1.1rem;
            width: 100%;
        }
        .btn-custom:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    @include('home.navigation')
    
    <div class="container mt-5">
        <div class="col-lg-6 mx-auto">
            <div class="card p-4">
                <h2 class="bg-success text-white p-3 text-center rounded">Submit Payment Info</h2>

                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('payment_save') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="team_id" class="form-label fw-bold">Team Name</label>
                        <select class="form-select" id="team_id" name="team_id" required>
                            <option value="">Select an Approved Team</option>
                            @foreach($approvedTeams as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="mb-3">
                        <label for="payment_from" class="form-label fw-bold">Payment From (Sender)</label>
                        <input type="text" class="form-control" id="payment_from" name="payment_from" required>
                    </div>
    
                    <div class="mb-3">
                        <label for="payment_to" class="form-label fw-bold">Payment To (Receiver)</label>
                        <input type="text" class="form-control" id="payment_to" name="payment_to" required>
                    </div>
    
                    <div class="mb-3">
                        <label for="transaction_id" class="form-label fw-bold">Transaction ID</label>
                        <input type="text" class="form-control" id="transaction_id" name="transaction_id" required>
                    </div>
    
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-custom">Submit Payment Info</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('home.footer')
    @include('home.jss')
</body>

</html>
