<!DOCTYPE html>
<html>
<head>
    <title>Team Registration Confirmation</title>
</head>
<body>
    <h2>Hello {{ $team->team_name }}!</h2>

    <p>Your team has been successfully registered for the competition. Below are the details:</p>

    <h3>Team Information</h3>
    <p><strong>Team Name:</strong> {{ $team->team_name }}</p>
    <p><strong>Institution:</strong> {{ $team->institution }}</p>

    <h3>Coach Information</h3>
    <p><strong>Name:</strong> {{ $team->coach_name }}</p>
    <p><strong>Email:</strong> {{ $team->coach_email }}</p>
    <p><strong>Phone:</strong> {{ $team->coach_phone }}</p>

    @if($team->member1_name)
    <h3>Member 1</h3>
    <p><strong>Name:</strong> {{ $team->member1_name }}</p>
    <p><strong>Email:</strong> {{ $team->member1_email }}</p>
    <p><strong>Phone:</strong> {{ $team->member1_phone }}</p>
    @endif

    @if($team->member2_name)
    <h3>Member 2</h3>
    <p><strong>Name:</strong> {{ $team->member2_name }}</p>
    <p><strong>Email:</strong> {{ $team->member2_email }}</p>
    <p><strong>Phone:</strong> {{ $team->member2_phone }}</p>
    @endif

    @if($team->member3_name)
    <h3>Member 3</h3>
    <p><strong>Name:</strong> {{ $team->member3_name }}</p>
    <p><strong>Email:</strong> {{ $team->member3_email }}</p>
    <p><strong>Phone:</strong> {{ $team->member3_phone }}</p>
    @endif

    <p>Thank you for registering. We look forward to your participation!</p>
</body>
</html>
