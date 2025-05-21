<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Role;
use App\Models\Chat;
use App\Models\ChatQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        try {
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

            Log::info('User joined queue', ['user_id' => Auth::id(), 'status' => $status]);

            if ($status === 'active') {
                $this->notifyAdmin();
            }

            return response()->json(['status' => $status]);
        } catch (\Exception $e) {
            Log::error('Join Queue Error', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to join queue'], 500);
        }
    }

    public function sendMessage(Request $request)
    {
        try {
            $role = Auth::user()->usertype;
            $request->validate(['message' => 'required|string|max:1000']);
            $queue = ChatQueue::where('user_id', Auth::id())->first();

            $isAdmin = $role === 'admin';
            if (!$isAdmin) {
                // Regular user check: must be in queue and active
                $queue = ChatQueue::where('user_id', Auth::id())->first();
                if (!$queue) {
                    return response()->json(['error' => 'You are not in the queue'], 403);
                }
                if ($queue->status !== 'active') {
                    return response()->json(['error' => 'Chat is not active', 'queue_status' => $queue->status], 403);
                }
            }

            $chat = Chat::create([
                'user_id' => Auth::id(),
                'message' => $request->message,
                'sender_role' => $role,
            ]);

            Log::info('Message sent', ['user_id' => Auth::id(), 'message' => $chat->message]);

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

            return response()->json(['success' => true, 'message' => $chat->message]);
        } catch (\Exception $e) {
            Log::error('Send Message Error', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to send message: ' . $e->getMessage()], 500);
        }
    }

    public function leaveChat()
    {
        try {
            $queue = ChatQueue::where('user_id', Auth::id())->first();
            if ($queue) {
                $queue->delete();
                Log::info('User left chat', ['user_id' => Auth::id()]);
            }
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Leave Chat Error', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to leave chat'], 500);
        }
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
        try {
            $activeQueue = ChatQueue::where('status', 'active')->first();
            if ($activeQueue) {
                $activeQueue->update(['status' => 'completed']);
                $activeQueue->delete();
                Log::info('Chat ended', ['user_id' => $activeQueue->user_id]);
                $this->startNextChat();
            }
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('End Chat Error', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to end chat'], 500);
        }
    }

    public function nextUser()
    {
        try {
            $this->startNextChat();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Next User Error', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to start next chat'], 500);
        }
    }

    private function startNextChat()
    {
        try {
            $nextQueue = ChatQueue::where('status', 'waiting')->orderBy('created_at')->first();
            if ($nextQueue) {
                $nextQueue->update(['status' => 'active']);
                Log::info('Next chat started', ['user_id' => $nextQueue->user_id]);
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
        } catch (\Exception $e) {
            Log::error('Start Next Chat Error', ['error' => $e->getMessage()]);
        }
    }

    private function notifyAdmin()
    {
        try {
            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                ['cluster' => env('PUSHER_APP_CLUSTER'), 'useTLS' => true]
            );
            $pusher->trigger('chat-channel', 'queue-updated', ['admin' => true]);
        } catch (\Exception $e) {
            Log::error('Notify Admin Error', ['error' => $e->getMessage()]);
        }
    }
}
