<?php
namespace app\Services;

use App\Repositories\UserRepository;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class UserService
{
    public function __construct(protected UserRepository $userRepository)
    {
    }
    public function updateUser(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "name" => "sometimes|string|min:3",
            "email" => "sometimes|string|email|unique:users,email,$id",
            "password" => "sometimes|string|min:8"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->only(['name', 'email']);

        if ($request->has('password')) {
            $data['password'] = Hash::make($request->password);
        }

        return $this->userRepository->update($id, $data);

        return response()->json([
            "message" => "User not found"
        ]);

        return $this->UserRepository->update($user);
    }

    /* registro do usuario */
    public function registerUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email|unique:users,email",
            "name" => "required|string|min:3",
            "password" => "required|string|min:8"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'erro, This account already exists'
                ], 401);
        };

        $userData = [
            "email" => $request->email,
            "name" => $request->name,
            "password" => $request ->password
        ];
        return $this->userRepository->create($userData);
    }

    /* login do usuario */
    public function loginUser(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                "message" => "Invalid email or password" ], 401);
            }

        $user = $request->user();

        $token = $user->createToken('auth_token',['*'], now()->addDays(10))->plainTextToken;

        return response()->json([
            "message" => "Login successful",
            "access_token" => $token,
            "token_type" => "Bearer",
        ]);
    }

    // renovar o token
    public function renewToken(Request $request)
    {
        $user = $request->user();
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
    public function verifyToken(Request $request){
        $user = $request->user();
        if (!$user){
            return response()->json(["message"=> "User not authenticate"], 401);
        }
        return response()->json([
            "message" => "Token verified successfully",
            "date_expires_token" => $user->tokens()->first()->expires_at,
        ]);
    }
}
