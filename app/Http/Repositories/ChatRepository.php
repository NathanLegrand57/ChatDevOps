<?php

namespace App\Http\Repositories;

use App\Models\Chat;

class ChatRepository
{
    protected $chat;

    public function store($request)
    {
        $data = $request->all();

        $chat = new Chat;

        $chat->pseudo = $data['pseudo'];
        $chat->message = $data['message'];

        $chat->save();
    }
}
