<!DOCTYPE html>
<html>

<head>
    <title>User Chat</title>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">User Chat</h1>
        <div id="chat-container" class="bg-white p-4 rounded shadow">
            @if($queue && $queue->status === 'active')
            <div id="chat-box" class="h-96 overflow-y-auto mb-4 p-2 border">
                @foreach($messages as $message)
                <div class="{{ $message->sender_role === 'user' ? 'text-right' : 'text-left' }}">
                    <p class="inline-block {{ $message->sender_role === 'user' ? 'bg-blue-200' : 'bg-gray-200' }} p-2 rounded mb-1">
                        {{ $message->message }}
                    </p>
                    <small class="block text-gray-500">{{ $message->created_at }}</small>
                </div>
                @endforeach
            </div>
            <form id="chat-form" class="flex">
                <input type="text" id="message" class="flex-1 p-2 border rounded-l" placeholder="Type a message..." required>
                <button type="submit" class="bg-blue-500 text-white p-2 rounded-r">Send</button>
            </form>
            <button id="leave-chat" class="mt-2 bg-red-500 text-white p-2 rounded">Leave Chat</button>
            @elseif($queue && $queue->status === 'waiting')
            <p class="text-yellow-500">You are in the queue. Please wait...</p>
            @else
            <button id="join-queue" class="bg-green-500 text-white p-2 rounded">Join Chat Queue</button>
            @endif
        </div>
    </div>

    <script>
        // Ensure user is authenticated
        const userId = @json(Auth::id());
        const userRole = @json(Auth::user() ? Auth::user() -> role : null);

        if (!userId) {
            console.error('User not authenticated');
            alert('Please log in to use the chat');
        }

        // Initialize Pusher
        Pusher.logToConsole = true;
        const pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
            cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
            encrypted: true
        });

        const channel = pusher.subscribe('chat-channel');

        // Handle incoming messages
        channel.bind('message-sent', function(data) {
            const chatBox = document.getElementById('chat-box');
            if (!chatBox) {
                console.warn('Chat box not found, user might not be in active chat');
                return;
            }

            const isOwnMessage = data.user_id === userId && data.sender_role === userRole;
            const alignmentClass = isOwnMessage ? 'text-right' : 'text-left';
            const colorClass = isOwnMessage ? 'bg-blue-200' : 'bg-gray-200';

            const messageDiv = document.createElement('div');
            messageDiv.className = alignmentClass;
            messageDiv.innerHTML = `
                <p class="inline-block ${colorClass} p-2 rounded mb-1">${data.message}</p>
                <small class="block text-gray-500">${data.created_at}</small>
            `;
            chatBox.appendChild(messageDiv);
            chatBox.scrollTop = chatBox.scrollHeight;
        });

        // Handle queue updates
        channel.bind('queue-updated', function(data) {
            if (data.user_id === userId && data.status === 'active') {
                console.log('Queue status updated to active, reloading page');
                window.location.reload();
            }
        });

        // Join queue
        document.getElementById('join-queue')?.addEventListener('click', function() {
            fetch('/chat/join', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            }).then(response => {
                return response.json().then(data => ({
                    status: response.status,
                    data
                }));
            }).then(({
                status,
                data
            }) => {
                if (status === 200 && (data.status === 'waiting' || data.status === 'active')) {
                    console.log('Joined queue with status:', data.status);
                    window.location.reload();
                } else {
                    console.error('Join queue error:', data);
                    alert('Failed to join queue: ' + (data.error || 'Unknown error'));
                }
            }).catch(error => {
                console.error('Fetch error:', error);
                alert('Network error while joining queue');
            });
        });

        // Send message
        document.getElementById('chat-form')?.addEventListener('submit', function(e) {
            e.preventDefault();
            const messageInput = document.getElementById('message');
            const message = messageInput.value.trim();
            if (!message) {
                alert('Please enter a message');
                return;
            }

            fetch('/chat/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    message
                })
            }).then(response => {
                return response.json().then(data => ({
                    status: response.status,
                    data
                }));
            }).then(({
                status,
                data
            }) => {
                if (status === 200) {
                    console.log('Message sent:', data.message);
                    messageInput.value = '';
                } else {
                    console.error('Send message error:', data);
                    alert('Failed to send message: ' + (data.error || 'Unknown error'));
                }
            }).catch(error => {
                console.error('Fetch error:', error);
                alert('Network error while sending message');
            });
        });

        // Leave chat
        document.getElementById('leave-chat')?.addEventListener('click', function() {
            fetch('/chat/leave', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            }).then(response => {
                return response.json().then(data => ({
                    status: response.status,
                    data
                }));
            }).then(({
                status,
                data
            }) => {
                if (status === 200) {
                    console.log('Left chat');
                    window.location.reload();
                } else {
                    console.error('Leave chat error:', data);
                    alert('Failed to leave chat: ' + (data.error || 'Unknown error'));
                }
            }).catch(error => {
                console.error('Fetch error:', error);
                alert('Network error while leaving chat');
            });
        });
    </script>
</body>

</html>