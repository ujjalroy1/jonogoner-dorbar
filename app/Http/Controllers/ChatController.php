<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Chat;
use App\Models\ChatSession;

class ChatController extends Controller
{
    public function index()
    {
        $chats = Chat::where('sender_id', auth()->id())
            ->orWhere('receiver_id', auth()->id())
            ->orderBy('created_at')
            ->get();

        return view('chat.index', compact('chats'));
    }

    public function send(Request $request)
    {
        $request->validate(['message' => 'required', 'receiver_id' => 'required']);

        $chat = Chat::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message
        ]);

        broadcast(new \App\Events\NewChatMessage($chat))->toOthers();

        return response()->json(['status' => 'Message sent']);
    }

    public function queueStatus()
    {
        $queue = ChatSession::where('status', 'waiting')->orderBy('created_at')->get();
        $position = $queue->search(fn($session) => $session->user_id === auth()->id()) + 1;

        return response()->json(['position' => $position]);
    }

    public function createSession()
    {
        $exists = ChatSession::where('user_id', auth()->id())->where('status', '!=', 'closed')->first();
        if (!$exists) {
            ChatSession::create(['user_id' => auth()->id()]);
        }

        return redirect()->route('chat.index');
    }
}
