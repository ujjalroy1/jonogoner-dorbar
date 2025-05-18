<!DOCTYPE html>
<html lang="en">

<head>
    <title>HSTU-RDPC</title>
    @include('admin.css')
</head>

<body>

    <!-- navbar -->
    @include('admin.header')
    @include('admin.sidebar')


    <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Dashboard</h2>
          </div>
        </div>

          <div>

          <div class="container">
        <h2>Team Details</h2>
        <table class="table table-bordered">
            <tr>
                <th>Team Name</th>
                <td>{{ $team->team_name }}</td>
            </tr>
            <tr>
                <th>Institution</th>
                <td>{{ $team->institution }}</td>
            </tr>

            <tr>
                <th>Member1 Name</th>
                <td>{{ $team->member1_name }}</td>
            </tr>
            <tr>
                <th>Member1 Email</th>
                <td>{{ $team->member1_email }}</td>
            </tr>
            <tr>
                <th>Member1 Id</th>
                <td>{{ $team->member1_id }}</td>
            </tr>
            <tr>
                <th>Member1 Phone</th>
                <td>{{ $team->member1_phone }}</td>
            </tr>
            <tr>
                <th>Member1 T-shirt</th>
                <td>{{ $team->member1_tshirt_size }}</td>
            </tr>

            <tr>
                <th>Member2 Name</th>
                <td>{{ $team->member2_name }}</td>
            </tr>
            <tr>
                <th>Member2 Email</th>
                <td>{{ $team->member2_email }}</td>
            </tr>
            <tr>
                <th>Member2 Id</th>
                <td>{{ $team->member2_id }}</td>
            </tr>
            <tr>
                <th>Member2 Phone</th>
                <td>{{ $team->member2_phone }}</td>
            </tr>
            <tr>
                <th>Member2 T-shirt</th>
                <td>{{ $team->member2_tshirt_size }}</td>
            </tr>
            <tr>
                <th>Member3 Name</th>
                <td>{{ $team->member3_name }}</td>
            </tr>
            <tr>
                <th>Member3 Email</th>
                <td>{{ $team->member3_email }}</td>
            </tr>
            <tr>
                <th>Member3 Id</th>
                <td>{{ $team->member3_id }}</td>
            </tr>
            <tr>
                <th>Member3 Phone</th>
                <td>{{ $team->member3_phone }}</td>
            </tr>
            <tr>
                <th>Member3 T-shirt</th>
                <td>{{ $team->member3_tshirt_size }}</td>
            </tr>

            <tr>
                <th>Coach Name</th>
                <td>{{ $team->coach_name }}</td>
            </tr>
            <tr>
                <th>Coach Email</th>
                <td>{{ $team->coach_email }}</td>
            </tr>
            <tr>
                <th>Coach Id</th>
                <td>{{ $team->coach_id }}</td>
            </tr>
            <tr>
                <th>Coach Phone</th>
                <td>{{ $team->coach_phone }}</td>
            </tr>
            <tr>
                <th>Coach T-shirt</th>
                <td>{{ $team->coach_tshirt_size }}</td>
            </tr>
            
            <tr>
                <th>Approve</th>
                <td>
                    <input type="checkbox" id="approve" {{ $team->approve ? 'checked' : '' }} disabled>
                </td>
            </tr>
            <tr>
                <th>Payment</th>
                <td>
                    <input type="checkbox" id="payment" {{ $team->payment ? 'checked' : '' }} disabled>
                </td>
            </tr>
        </table>

        <form action="{{ route('teams.update', $team->id) }}" method="POST">
            @csrf
            <label>
                <input type="checkbox" name="approve" {{ $team->approve ? 'checked' : '' }}> Approve
            </label>
            <label class="ml-3">
                <input type="checkbox" name="payment" {{ $team->payment ? 'checked' : '' }}> Payment
            </label>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('teams.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>

          




          </div>

            
      </div>

    @include('admin.jss')


</body>

</html>