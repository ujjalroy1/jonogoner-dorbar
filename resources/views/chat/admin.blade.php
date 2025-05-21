<!DOCTYPE html>
<html>

<head>
    <title>Admin Chat</title>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <p class="inline-block {{ $message->sender_role === 'admin' ? 'bg-blue-200' : 'bg-gray-200' }} p-2 rounded mb-1">
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
        // Ensure admin is authenticated
        const adminId = @json(Auth::id());
        const adminRole = @json(Auth::user() ? Auth::user() -> usertype : null);
        const activeUserId = @json($activeQueue ? $activeQueue -> user_id : 0);

        if (!adminId) {
            console.error('Admin not authenticated');
            alert('Please log in to use the admin chat');
        }

        if (adminRole !== 'admin') {
            console.error('User is not an admin', {
                role: adminRole
            });
            alert('You do not have permission to access the admin chat');
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
                console.warn('Chat box not found, no active chat');
                return;
            }

            // Only display messages for the current active user
            if (data.user_id !== activeUserId && data.sender_role !== 'admin') {
                return;
            }

            const isOwnMessage = data.sender_role === 'admin';
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
            if (data.admin) {
                console.log('Queue updated, reloading page');
                window.location.reload();
            }
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

        // End chat
        document.getElementById('end-chat')?.addEventListener('click', function() {
            fetch('/admin/chat/end', {
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
                    console.log('Chat ended');
                    window.location.reload();
                } else {
                    console.error('End chat error:', data);
                    alert('Failed to end chat: ' + (data.error || 'Unknown error'));
                }
            }).catch(error => {
                console.error('Fetch error:', error);
                alert('Network error while ending chat');
            });
        });

        // Next user
        document.getElementById('next-user')?.addEventListener('click', function() {
            fetch('/admin/chat/next', {
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
                    console.log('Next user requested');
                    window.location.reload();
                } else {
                    console.error('Next user error:', data);
                    alert('Failed to load next user: ' + (data.error || 'Unknown error'));
                }
            }).catch(error => {
                console.error('Fetch error:', error);
                alert('Network error while requesting next user');
            });
        });
    </script>
</body>

</html>