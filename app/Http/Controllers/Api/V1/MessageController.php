<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\MessageResource;
use App\Models\Conversation;
use App\Models\Message;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return MessageResource::collection(Message::with('conversation')->get());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Conversation $conversation, Request $request)
    {
        $validator = Validator::make(['conversation' => $conversation, 'content' => $request->content, 'conversation_id' => $conversation->id], [
            'conversation'=> 'required',
            'conversation_id' => 'required|exists:conversations,id',
            'content' => 'required|min:3'
        ]);

        if ($validator->fails())
        {
            return $this->error('Conversation not found.', 422, $validator->errors());
        }

        $response = 'teste';
        $data = ['content' => $request->content, 'response' => $response, 'conversation_id' => $conversation->id];

        $created = Message::create($data);

        if(!$created)
        {
            return $this->error('Message not created.', 400);
        }

        return $this->response('Message created', 200, new MessageResource($created->load('conversation')));
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        return new MessageResource($message);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
