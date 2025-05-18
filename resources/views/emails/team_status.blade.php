<!DOCTYPE html>
<html>
<head>
    <title>Team Registration Update</title>
</head>
<body>
    <h2>Hello, {{ $team->team_name }}!</h2>

    @if($messageType == 'approve')
        <p>Your team's registration has been **approved** successfully. You are now officially registered!</p>
    @elseif($messageType == 'payment')
        <p>Your team's **payment has been received** successfully. You are now fully confirmed!</p>
    @endif

    <p>Thank you!</p>
</body>
</html>
