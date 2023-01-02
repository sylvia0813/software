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

    public static function send($user_id, $message)
    {
        $message = new Message();
        $message->to = $user_id;
        $message->message = $message;
        $message->save();

        event(new NewMessageNotification($message));
    }
}