<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\ChatSent;
use App\Events\SessionUpdated;
use phpDocumentor\Reflection\PseudoTypes\True_;

class ChatController extends Controller
{
    // Show chat view
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            $activeSession = ChatSession::where('status', 'active')->first();
            $chats = $activeSession ? $activeSession->chats()->with('sender')->orderBy('created_at')->get() : collect();
            return view('chat.index', compact('chats', 'activeSession'));
        } else {
            $session = ChatSession::where('user_id', $user->id)->latest()->first();

            $queuePosition = null;
            $chats = collect();
            $isInQueue = false;
            $isActive = $request->query('isActive');

            if ($session) {
                $isInQueue = $session->status !== 'done';
                $isActive = $session->status === 'active';

                if ($isActive) {
                    $chats = $session->chats()->with('sender')->orderBy('created_at')->get();
                }

                if ($session->status === 'waiting') {
                    $queuePosition = ChatSession::where('status', 'waiting')
                        ->orderBy('created_at')
                        ->pluck('user_id')
                        ->search($user->id) + 1;
                }
            }

            return view('chat.index', compact('chats', 'session', 'queuePosition', 'isInQueue', 'isActive'));
        }
    }

    // User requests chat (puts in queue)
    public function createSession()
    {
        $user = Auth::user();

        ChatSession::firstOrCreate([
            'user_id' => $user->id,
            'status' => 'waiting',
        ]);

        broadcast(new SessionUpdated())->toOthers();
        $isActive = false;
        return redirect()->route('chat.index', ['isActive']);
    }

    // Send message
    public function send(Request $request)
    {
        $user = Auth::user();

        if ($user->role == 'user') {
            // User can send message only if session active
            $session = ChatSession::where('user_id', $user->id)
                ->where('status', 'active')
                ->first();

            if (!$session) {
                return response()->json(['error' => 'You are not in an active session'], 403);
            }
        } else {
            // Admin must have active session to reply
            $session = ChatSession::where('status', 'active')->first();
            if (!$session) {
                return response()->json(['error' => 'No active session'], 403);
            }
        }

        $chat = Chat::create([
            'sender_id' => $user->id,
            'receiver_id' => $user->role == 'admin' ? $session->user_id : 1, // admin id = 1
            'chat_session_id' => $session->id,
            'message' => $request->message,
        ]);

        broadcast(new ChatSent($chat))->toOthers();

        return response()->json(['success' => true]);
    }
    public function queueStatus()
    {
        $user = Auth::user();

        $session = ChatSession::where('user_id', $user->id)->latest()->first();

        if (!$session || $session->status === 'done') {
            return response()->json(['position' => 'Not in queue']);
        }

        if ($session->status === 'active') {
            return response()->json(['position' => 'Active']);
        }

        // Calculate queue position
        $position = ChatSession::where('status', 'waiting')
            ->orderBy('created_at')
            ->pluck('user_id')
            ->search($user->id);

        return response()->json(['position' => $position !== false ? $position + 1 : 0]);
    }

    // Admin ends chat session, activates next user in queue
    public function closeSession(Request $request)
    {
        $user = Auth::user();

        if ($user->role != 'admin') {
            abort(403);
        }

        $session = ChatSession::where('id', $request->session_id)->where('status', 'active')->first();
        if ($session) {
            $session->update(['status' => 'done']);
        }

        $nextSession = ChatSession::where('status', 'waiting')->orderBy('created_at')->first();
        if ($nextSession) {
            $nextSession->update(['status' => 'active']);
        }

        broadcast(new SessionUpdated())->toOthers();

        return response()->json(['message' => 'Session closed']);
    }
}
