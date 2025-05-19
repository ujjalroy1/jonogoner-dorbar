<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class ChatController extends Controller
{
    public function index()
    {
        $queue = ChatQueue::where('user_id', Auth::id())->first();
        $messages = Chat::where('user_id', Auth::id())->get();
        return view('chat.index', compact('queue', 'messages'));
    }

    public function joinQueue(Request $request)
    {
        $existingQueue = ChatQueue::where('user_id', Auth::id())->first();
        if ($existingQueue) {
            return response()->json(['status' => $existingQueue->status]);
        }

        $activeChat = ChatQueue::where('status', 'active')->first();
        $status = $activeChat ? 'waiting' : 'active';

        $queue = ChatQueue::create([
            'user_id' => Auth::id(),
            'status' => $status,
        ]);

        if ($status === 'active') {
            $this->notifyAdmin();
        }

        return response()->json(['status' => $status]);
    }

    public function sendMessage(Request $request)
    {
        $request->validate(['message' => 'required|string']);
        $queue = ChatQueue::where('user_id', Auth::id())->first();

        if (!$queue || $queue->status !== 'active') {
            return response()->json(['error' => 'Not in aktif chat'], 403);
        }

        $chat = Chat::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
            'sender_role' => Auth::user()->role,
        ]);

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            ['cluster' => env('PUSHER_APP_CLUSTER'), 'useTLS' => true]
        );

        $pusher->trigger('chat-channel', 'message-sent', [
            'user_id' => Auth::id(),
            'message' => $chat->message,
            'sender_role' => $chat->sender_role,
            'created_at' => $chat->created_at->toDateTimeString(),
        ]);

        return response()->json(['success' => true]);
    }

    public function leaveChat()
    {
        $queue = ChatQueue::where('user_id', Auth::id())->first();
        if ($queue) {
            $queue->delete();
        }
        return response()->json(['success' => true]);
    }

    public function adminIndex()
    {
        $activeQueue = ChatQueue::where('status', 'active')->first();
        $waitingQueues = ChatQueue::where('status', 'waiting')->orderBy('created_at')->get();
        $messages = $activeQueue ? Chat::where('user_id', $activeQueue->user_id)->get() : [];
        return view('chat.admin', compact('activeQueue', 'waitingQueues', 'messages'));
    }

    public function endChat()
    {
        $activeQueue = ChatQueue::where('status', 'active')->first();
        if ($activeQueue) {
            $activeQueue->update(['status' => 'completed']);
            $activeQueue->delete();
            $this->startNextChat();
        }
        return response()->json(['success' => true]);
    }

    public function nextUser()
    {
        $this->startNextChat();
        return response()->json(['success' => true]);
    }

    private function startNextChat()
    {
        $nextQueue = ChatQueue::where('status', 'waiting')->orderBy('created_at')->first();
        if ($nextQueue) {
            $nextQueue->update(['status' => 'active']);
            $this->notifyAdmin();
            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                ['cluster' => env('PUSHER_APP_CLUSTER'), 'useTLS' => true]
            );
            $pusher->trigger('chat-channel', 'queue-updated', [
                'user_id' => $nextQueue->user_id,
                'status' => 'active',
            ]);
        }
    }

    private function notifyAdmin()
    {
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            ['cluster' => env('PUSHER_APP_CLUSTER'), 'useTLS' => true]
        );
        $pusher->trigger('chat-channel', 'queue-updated', ['admin' => true]);
    }
}
