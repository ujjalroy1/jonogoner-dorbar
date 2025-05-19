<!DOCTYPE html>
<html lang="en">

<head>
    <title>DC Office - Live Chat</title>
    @include('home.css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    @include('home.navigation')

    <div class="container my-4">
        <h3 class="mb-3">Live Chat</h3>

        <div class="mb-3">
            <strong>Queue Position:</strong> <span id="queue-position" class="text-primary">Checking...</span>
        </div>

        <div id="chat-box" class="border rounded p-3 bg-white mb-3" style="height: 300px; overflow-y: scroll;">
            @foreach ($chats as $chat)
            <div class="{{ $chat->sender_id == auth()->id() ? 'text-end' : 'text-start' }}">
                <span class="badge bg-{{ $chat->sender_id == auth()->id() ? 'primary' : 'secondary' }} mb-1">
                    {{ $chat->message }}
                </span>
            </div>
            @endforeach
        </div>

        <form id="chat-form" class="mt-2">
            @csrf
            <input type="hidden" name="receiver_id" value="1" /> <!-- Assuming Admin ID is 1 -->
            <div class="input-group">
                <input type="text" name="message" class="form-control" placeholder="Type your message..." required>
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
        </form>
    </div>

    @include('home.footer')
    @include('home.jss')

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // Submit message
        document.getElementById('chat-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;

            axios.post('{{ route("chat.send") }}', {
                message: form.message.value,
                receiver_id: form.receiver_id.value,
            }).then(() => {
                form.message.value = '';
                location.reload(); // Later replace with WebSocket update
            });
        });

        // Check queue position
        function checkQueue() {
            axios.get('{{ route("chat.queueStatus") }}').then(res => {
                document.getElementById('queue-position').innerText = res.data.position;
            });
        }

        // Auto scroll chat to bottom
        window.onload = function() {
            const box = document.getElementById('chat-box');
            box.scrollTop = box.scrollHeight;
        };

        setInterval(checkQueue, 5000);
        checkQueue();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>