<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageSent;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat');
    }

    public function messageAll(Request $request)
    {
        $message = $request->input('message');

        // Save the message to the database if desired
        event(new MessageSent($message));

        return true;
    }
}