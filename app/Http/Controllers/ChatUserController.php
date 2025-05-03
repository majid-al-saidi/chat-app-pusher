<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ChatUserController extends Controller
{
    public function index()
{
    $users = User::where('id', '!=', Auth::id())->get();

    return view('chat.index', compact('users'));
}
}
