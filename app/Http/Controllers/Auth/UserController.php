<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    use GeneralTrait;

    public function register(Request $request): JsonResponse
    {
        $rules = [
            'email'=>['required','email','unique:users,email'],
            'password'=>['required',Password::min(6)->letters()->numbers()->mixedCase()->symbols()->uncompromised()],
            'name'=>['required','min:3','string'],
        ];
        try {
            $validator = Validator::make($request->all(),$rules);
            if($validator->fails()){
                return $this->returnValidationError($validator);
            }
            $user = User::create($request->all());
            $token = $user->createToken('user_token',['user'])->plainTextToken;
            $user['token'] = $token;
            return $this->returnData('user',$user);

        }catch (\Exception $e)
        {
            return $this->returnError($e->getMessage(),$e->getCode());
        }
        }

}
