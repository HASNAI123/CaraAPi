<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return response()->json($users);
    }

    public function getUsersByRole($roleName)
    {
        $users = User::role($roleName)->get();
        return response()->json($users);
    }


    /**
 * Register a new user.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'user_id' => 'required|string|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->user_id,
        'password' => bcrypt($request->password),
    ]);

    $token = $user->createToken('auth-token')->plainTextToken;

    return response()->json([
        'access_token' => $token,
        'token_type' => 'Bearer',
        'user' => $user
    ], 201);
}
public function login(Request $request)
{
    $credentials = $request->only('user_id', 'password');

    if (Auth::attempt($credentials)) {
        $token = Auth::user()->createToken('API Token')->plainTextToken;

        return response()->json([
            'token' => $token,
        ]);
    }

    return response()->json([
        'message' => 'Invalid credentials',
    ], 401);
}


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(null, 204);
    }
}
