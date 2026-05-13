<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Get distinct conversation partners
        $conversations = Message::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->with(['sender', 'receiver'])
            ->orderByDesc('created_at')
            ->get()
            ->groupBy(fn($msg) => $msg->sender_id === $userId ? $msg->receiver_id : $msg->sender_id)
            ->map(fn($msgs) => $msgs->first()); // latest message per conversation

        return view('student.messages.index', compact('conversations', 'userId'));
    }

    public function show(User $user)
    {
        $myId = Auth::id();

        $thread = Message::where(function ($q) use ($myId, $user) {
                $q->where('sender_id', $myId)->where('receiver_id', $user->id);
            })->orWhere(function ($q) use ($myId, $user) {
                $q->where('sender_id', $user->id)->where('receiver_id', $myId);
            })
            ->orderBy('created_at')
            ->get();

        // Mark all received messages in this thread as read
        Message::where('sender_id', $user->id)
            ->where('receiver_id', $myId)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return view('student.messages.show', compact('thread', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => ['required', 'exists:users,id'],
            'subject'     => ['required', 'string', 'max:255'],
            'body'        => ['required', 'string'],
        ]);

        Message::create([
            'sender_id'   => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'subject'     => $request->subject,
            'body'        => $request->body,
        ]);

        return redirect()->route('student.messages.thread', $request->receiver_id)
            ->with('success', 'Message sent.');
    }

    public function create()
    {
        $advisors = Auth::user()->advisors()->get();
        return view('student.messages.create', compact('advisors'));
    }
}
