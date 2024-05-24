<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|min:3',
            'lastName' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if($validator->fails())
        {
            return $this->error('Missing required parameters.', 422, $validator->errors());
        }

        $created = User::create($validator->validated());

        if(!$created)
        {
            return $this->error('User not created.', 400);
        }

        return $this->response('User created', 200, new UserResource($created));
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     return new UserResource(User::where('id', $id)->first());
    // }
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|min:3',
            'lastName' => 'required|min:3',
            'email' => 'required|email',
        ]);

        if($validator->fails())
        {
            return $this->error('Validation failed', 422, $validator->errors());
        }

        $validated = $validator->validated();

        $updated = $user->update([
            'firstName' => $validated['firstName'],
            'lastName' => $validated['lastName'],
            'email' => $validated['email']
        ]);

        if(!$updated)
        {
            return $this->error('User not updated.', 400);
        }

        return $this->response('User updated', 200, new UserResource($user));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
