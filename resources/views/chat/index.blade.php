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
            <strong>Queue Position:</strong>
            <span id="queue-position" class="text-primary">{{ $queuePosition ?? 'Checking...' }}</span>
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
            <input type="hidden" name="receiver_id" value="1" /> <!-- Admin ID -->
            <div class="input-group">
                <input type="text" name="message" class="form-control" placeholder="Type your message..." required>
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
        </form>
        {{$isInQueue && !$isActive}}
        @if($isInQueue && !$isActive)
        <form action="{{ route('chat.start') }}" method="POST" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-success">Start Chat</button>
        </form>
        @elseif ($isActive)
        <form action="{{ route('chat.end') }}" method="POST" class="mt-3">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <button type="submit" class="btn btn-danger">End Chat</button>
        </form>
        @endif
    </div>

    @include('home.footer')
    @include('home.jss')

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="{{ mix('/js/app.js') }}"></script>

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
                // In production, use Laravel Echo for real-time update
                location.reload();
            });
        });

        // Auto-scroll to bottom
        window.onload = function() {
            const box = document.getElementById('chat-box');
            box.scrollTop = box.scrollHeight;
        };

        // Update queue position
        function checkQueue() {
            axios.get('{{ route("chat.queueStatus") }}')
                .then(res => {
                    document.getElementById('queue-position').innerText = res.data.position;
                }).catch(err => {
                    document.getElementById('queue-position').innerText = 'Error';
                });
        }

        setInterval(checkQueue, 5000);
        checkQueue();

        // Laravel Echo listening (optional)
        Echo.private('chat.{{ auth()->id() }}')
            .listen('ChatSent', (e) => {
                const chatBox = document.getElementById('chat-box');
                chatBox.innerHTML += `<div class="text-start"><span class="badge bg-secondary mb-1">${e.chat.message}</span></div>`;
                chatBox.scrollTop = chatBox.scrollHeight;
            });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- {{dd($queuePosition);}} -->

</body>


</html>