<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\NewMessageNotification;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id = Auth::user()->id;
        $data = array('user_id' => $user_id);

        return $data;
    }

    public function send()
    {
        // message is being sent
        $message = new Message();
        $message->setAttribute('to', 1);
        $message->setAttribute('message', 'Demo message user 1');
        $message->save();

        // want to broadcast NewMessageNotification event
        event(new NewMessageNotification($message));

        // ...
    }
}