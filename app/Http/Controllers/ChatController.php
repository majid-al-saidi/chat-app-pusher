<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function show(User $user)
{
    // Prevent chatting with self (optional)
    if ($user->id === Auth::id()) {
        return redirect('/chat/users');
    }

    return view('chat.chat', [
        'chatUser' => $user,
    ]);
}
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'to_user_id' => 'required|integer|exists:users,id',
        ]);

        $message = $request->input('message');
        $toUserId = $request->input('to_user_id');
        $fromUserId = auth()->id(); // assumes user is logged in
        $fromUserName = auth()->user()->name; // assumes user has a name attribute

        broadcast(new MessageSent($message, $fromUserId, $toUserId, $fromUserName))->toOthers();

        return response()->json(['status' => 'Message sent']);
    }
}
