<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\CodeMail;
use App\Models\Auth\Code;
use App\models\User;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{
    use GeneralTrait;

    public function sendEmailWithCode()
    {
        // when the user ask to verify his email
        //we will send a numeric code to his email
        try{
            /** @var User $user **/
            $user = Auth::user();
            if($user->hasVerifiedEmail())
            {
                return $this->returnError('email already verified. ');
            }
            $userCode = random_int(1111,9999);
            $data = [
                'code'=>$userCode,
                'subject'=>'Confirming Email Address'
            ];
            Code::create([
                'code'=>$userCode,
                'user_id'=>$user->id,
            ]);
            Mail::to($user->email)->send(new CodeMail($data));
            return $this->returnSuccessMessage('Code Send. ');

        }catch (\Exception $e)
        {
            return $this->returnError($e->getMessage(),$e->getCode());
        }
    }
}
