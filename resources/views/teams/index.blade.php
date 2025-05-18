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
                <h2 class="mb-4">Team Approval List</h2>
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Team Name</th>
                            <th>Institution</th>
                            <th>Approve</th>
                            <th>Payment</th>
                            <th>View</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teams as $team)
                        <tr>
                            <td>{{ $team->team_name }}</td>
                            <td>{{ $team->institution }}</td>
                            <td>{!! $team->approve ? '✅' : '❌' !!}</td>
                            <td>{!! $team->payment ? '✅' : '❌' !!}</td>
                            <td><a href="{{ route('teams.show', $team->id) }}" class="btn btn-primary">View</a></td>
                            <td>
                                <form action="{{ route('teams.destroy', $team->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    @include('admin.jss')
</body>

</html>