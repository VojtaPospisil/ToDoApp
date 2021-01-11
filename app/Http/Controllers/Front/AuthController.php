<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Helper;

class AuthController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        return auth()->user();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('front.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->only(['email', 'password']), [
                'email' => 'email|required',
                'password' => 'required'
            ], [
                'required' => 'Toto pole je povinné.',
                'email' => 'Toto pole není platný email.',
            ]);

            abort_if($validator->fails(), Response::HTTP_UNPROCESSABLE_ENTITY, $validator->errors());

            $credentials = request(['email', 'password']);

            abort_if(!Auth::attempt($credentials), Response::HTTP_UNPROCESSABLE_ENTITY, 'Uživatel neexistuje');

            $user = User::where('email', $request->email)->first();

            if (!Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Login Error');
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'auth_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 200);
        } catch (\Exception $error) {
            Helper::generateException($error);
        }
    }

    public function register()
    {
    }

    public function logout(Request $request)
    {
        $tokenId = $request->user()->withAccessToken($request->user()->currentAccessToken())->id;
        $request->user()->tokens()->where('tokenable_id', $tokenId)->delete();
        Auth::guard('web')->logout();

        return response()->json([
            'message' => 'Uživatel úspěšně odhlášen',
            'status_code' => 202
        ], 202);
    }
}
