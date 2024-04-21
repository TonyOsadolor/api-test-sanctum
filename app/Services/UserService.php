<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->uuid = Str::uuid();
        $user->surname = $request->surname;
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->gender = $request->gender;
        $user->marital_status = $request->marital_status;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return $user;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the User's Profile
     * 
     * @param $request
     * @param $user
     * @return User
     */
    public function update($request, $user)
    {
        $user->update($request->validated());

        return $user;
    }

    /**
     * Deactivate User Profile.
     * 
     * @param $userUuid
     */
    public function destroy($userUuid)
    {
        $user = User::where('uuid', $userUuid)
            ->firstOrFail();
        $user->delete();

        return $userUuid;
    }
}
