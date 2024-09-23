<?php

namespace App\Http\Controllers;

use App\Events\GreetingSent;
use App\Events\MessageSent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ChatController extends Controller
{
    public function showChat(){
        return view('chat.show');
    }
    public function  messageReceived(Request $request){
        $rule=[
            'message' => 'required',
        ];
        $request->validate($rule);
        broadcast(new MessageSent($request->user(),$request->message));

        return response()->json('Message broadcast');
    }
    public function greetReceived(Request $request, User $receiver){
        broadcast(new GreetingSent($receiver,"{$request->user()->name} đã chào bạn"));
        broadcast(new GreetingSent($request->user(),"bạn đã chào {$receiver->name}"));
        return "Lời chào từ {$request->user()->name} đến {$receiver->name}";

    }
}
