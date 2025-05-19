<!DOCTYPE html>
<html>

<head>
    <title>Admin Chat</title>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Admin Chat</h1>
        <div class="bg-white p-4 rounded shadow">
            @if($activeQueue)
            <p class="mb-2">Chatting with User ID: {{ $activeQueue->user_id }}</p>
            <div id="chat-box" class="h-96 overflow-y-auto mb-4 p-2 border">
                @foreach($messages as $message)
                <div class="{{ $message->sender_role === 'admin' ? 'text-right' : 'text-left' }}">
                    <p class="inline-block bg-{{ $message->sender_role === 'admin' ? 'blue' : 'gray' }}-200 p-2 rounded mb-1">
                        {{ $message->message }}
                    </p>
                    <small class="block text-gray-500">{{ $message->created_at }}</small>
                </div>
                @endforeach
            </div>
            <form id="chat-form" class="flex">
                <input type="text" id="message" class="flex-1 p-2 border rounded-l" placeholder="Type a message...">
                <button type="submit" class="bg-blue-500 text-white p-2 rounded-r">Send</button>
            </form>
            <button id="end-chat" class="mt-2 bg-red-500 text-white p-2 rounded">End Chat</button>
            @else
            <p>No active chat. Waiting for users...</p>
            <button id="next-user" class="mt-2 bg-green-500 text-white p-2 rounded">Next User</button>
            @endif
            <h2 class="mt-4 text-xl">Queue ({{ $waitingQueues->count() }})</h2>
            <ul>
                @foreach($waitingQueues as $queue)
                <li>User ID: {{ $queue->user_id }} (Joined: {{ $queue->created_at }})</li>
                @endforeach
            </ul>
        </div>
    </div>

    <script>
        const userId = {
            {
                $activeQueue ? $activeQueue - > user_id : 0
            }
        };
        Pusher.logToConsole = true;
        const pusher = new Pusher('{{ env('
            PUSHER_APP_KEY ') }}', {
                cluster: '{{ env('
                PUSHER_APP_CLUSTER ') }}'
            });
        const channel = pusher.subscribe('chat-channel');

        channel.bind('message-sent', function(data) {
            if (data.user_id === userId || data.sender_role === 'user') {
                const chatBox = document.getElementById('chat-box');
                const messageDiv = document.createElement('div');
                messageDiv.className = data.sender_role === 'admin' ? 'text-right' : 'text-left';
                messageDiv.innerHTML = `
                    <p class="inline-block bg-${data.sender_role === 'admin' ? 'blue' : 'gray'}-200 p-2 rounded mb-1">${data.message}</p>
                    <small class="block text-gray-500">${data.created_at}</small>
                `;
                chatBox.appendChild(messageDiv);
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        });

        channel.bind('queue-updated', function(data) {
            if (data.admin) {
                window.location.reload();
            }
        });

        document.getElementById('chat-form')?.addEventListener('submit', function(e) {
            e.preventDefault();
            const message = document.getElementById('message').value;
            fetch('/chat/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    message
                })
            }).then(response => {
                if (response.ok) {
                    document.getElementById('message').value = '';
                }
            });
        });

        document.getElementById('end-chat')?.addEventListener('click', function() {
            fetch('/admin/chat/end', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(() => window.location.reload());
        });

        document.getElementById('next-user')?.addEventListener('click', function() {
            fetch('/admin/chat/next', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(() => window.location.reload());
        });
    </script>
</body>

</html>