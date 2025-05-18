<!DOCTYPE html>
<html lang="en">

<head>
    <title>HSTU-RDPC Team List</title>
    @include('home.css')
</head>

<body>


    <!-- navbar -->
    @include('home.navigation')
    <!-- endnavbar -->
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <h2 class="bg-success text-white p-2 text-center rounded">Approved Teams</h2>

    <div class="container mt-5 w-80 mx-auto">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>Team Name</th>
                    <th>University</th>
                </tr>
            </thead>
            <tbody>
                @foreach($teams as $index => $team)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $team->team_name }}</td>
                    <td>{{ $team->institution }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('registration') }}" class="btn btn-primary mt-3">Back to Registration</a>
    </div>
    <p></p>
    <p></p>



    <!-- footer -->
    @include('home.footer')
    <!-- end footer -->


    <!-- loader -->
    <!-- js -->
    @include('home.jss')
    <!-- end js -->


</body>

</html>