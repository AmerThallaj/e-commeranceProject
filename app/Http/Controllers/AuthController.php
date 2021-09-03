<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $helper;
    public function register(Request $request)
    {
        $request = collect($request);
        $user_info = $this->helper->filter($request,['name','email','password','birthday']);
        $user_info['password']=bcrypt($user_info['password']);
        $user = User::create($user_info);
        if($request->get('city')&&$request->get('town')){
            $user->address()->save(new Address($this->helper->filter($request,['town','city'])));
        }
        return response()->json([
            'token' => $user->createToken('API Token')->plainTextToken,
            'id' => $user->id
        ]);
    }
    public function login(UserLoginRequest $request){
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response(['wrong'=>'wrong email or password'],401);
        }
        $token=auth()->user()->createToken('API Token')->plainTextToken;
        $user = User::find(auth()->user()->getAuthIdentifier());
        return response(['token'=>$token,'id'=>$user->id]);
    }
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged out'
        ];
    }
    public function changePassword(Request $request)
    {
        $user = User::find(\auth()->user()->getAuthIdentifier());
        $newCryptedPassword=bcrypt(\request()->newPassword);
        $user->password=$newCryptedPassword;
        $user->save();
        auth()->user()->tokens()->delete();
        return response()->json([
            'token' => $user->createToken('API Token')->plainTextToken,
            'id' => $user->id]);
    }
}
