<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ConversationResource;
use App\Models\Conversation;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConversationController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ConversationResource::collection(Conversation::with('user')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(User $user)
    {
        $validator = Validator::make(['user' => $user, 'user_id' => $user->id], [
            'user'=> 'required',
            'user_id' => 'required|numeric|exists:users,id'
        ]);

        if($validator->fails())
        {
            return $this->error('User not found.', 422, $validator->errors());
        }

        $created = Conversation::create($validator->validated());

        if (!$created)
        {
            return $this->error('Conversation not created', 400);
        }

        return $this->response('Conversation created', 200, new ConversationResource($created->load('user')));
    }

    /**
     * Display the specified resource.
     */
    public function show(Conversation $conversation)
    {
        return new ConversationResource($conversation);
    }

    /**
     * Display the specified resource.
     */
    public function findByUser(User $user)
    {
        $conversations = Conversation::where('user_id', $user->id)->get();
        return ConversationResource::collection($conversations);
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
