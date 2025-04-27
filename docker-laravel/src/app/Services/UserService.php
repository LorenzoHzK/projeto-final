<?php
namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;
class UserService
{
    public function __construct(protected UserRepository $userRepository, Request $request)
    {
        $this->UserRepository = $userRepository;
        $this->request = $request;
    }

    /* registro do usuario */
    public function registerUser()
    {
        $userData = $this->request ->validate([
            "email" => "required|email|unique:users,email",
            "name" => "required|string|min:3",
            "password" => "required|string|min:8"
        ]);

        return $this->userRepository->create($userData);
    }

    /* login do user */
    public function loginUser()
    {
        $credentials = $this->request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                "message" => "Invalid email or password" ], 401);
            }

        $user = $this->request->user();

        $token = $user->createToken('auth_token',['*'], now()->addDays(10))->plainTextToken;

        return response()->json([
            "message" => "Login successful",
            "access_token" => $token,
            "token_type" => "Bearer",
        ]);
    }


    // LogOut do User
    public function logout(){
        auth()->user()->tokens()->delete();

        return response()->json([
            "message" => "Logout successful"
        ]);
    }

    // renovar o token
    public function renewToken()
    {
        $user = $this->request->user();
        if (!$user){
            return response()->json(["message"=> "User not authenticate"], 401);
        }
        if(!$user->tokens()->exists()){
            return response()->json(["message"=> "Token does not exist, you need to login first"], 401);
        }

        $user->tokens()->delete();

        $token = $user->createToken('auth_token',['*'], now()->addDays(10))->plainTextToken;
        return response()->json([
            "message" => "Token renewed successfully",
            "access_token" => $token,
            "token_type" => "Bearer",
            "date_user" => $user,
            "token_expire" => now()->addDays(10)->toDateTimeString()
        ]);
    }

    // verificacao do token
    public function verifyToken(){
        $user = $this->request->user();
        if (!$user){
            return response()->json(["message"=> "User not authenticate"], 401);
        }
        return response()->json([
            "message" => "Token verified successfully",
            "date_expires_token" => $user->tokens()->first()->expires_at,
        ]);
    }

    public function infoUser()
    {
        return response()->json(auth()->user());
    }

    public function UpdateUser()
    {
        $validated = $this->request->validate([
            'name' => 'sometimes|string|min:3',
            'email' => 'sometimes|string|min:3|email|unique:users,email',
            'password' => 'required|string|min:8'
        ]);

        $user = auth()->user();
        $user->update($validated);
        return response()->json("Successful Updated, Your profile $user->name ");
    }

    public function deleteUser()
    {
        $user = auth()->user();
        $user->delete();
        $user->tokens()->delete();
        return response()->json(["message"=> "User deleted successfully"]);
    }

    public function createModerator()
    {
        $user = auth()->user();

        $userData = $this->request ->validate([
            "name" => "required|string|min:3",
            "email" => "required|email|unique:users,email",
            "password" => "required|string|min:8"
        ]);

        if ($user->role != 'Admin') {
            return response()->json([
                'message' => 'erro, you can`t create a moderator, to create a moderator you must be an admin'
            ], 401);
        };

        $userData = [
            "name" => $this->request->name,
            "email" => $this->request->email,
            "password" => $this->request ->password,
            "role" => "Moderator"
        ];

        $this->userRepository->create($userData);

        return response()->json([
            'message' => "Successful create moderator"
        ]);
    }
}
