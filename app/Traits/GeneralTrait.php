<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait GeneralTrait
{
    public function returnError(string $message,string $code='E000'): JsonResponse
    {
        return response()->json([
            'status'=>false,
            'code'=>$code,
            'msg'=>$message,
        ]);
    }

    public function returnSuccessMessage(string $message,string $code='S000'): JsonResponse
    {
        return response()->json([
            'status'=>true,
            'code'=>$code,
            'msg'=>$message,
        ]);
    }
    public function returnData(string $key, $data, string $message,string $code='S000'): JsonResponse
    {
        return response()->json([
            'status'=>true,
            'code'=>$code,
            'msg'=>$message,
            $key=>$data,
        ]);
    }

    public function returnValidationError($validator,$code='E0011'): JsonResponse
    {
        return $this->returnError(
            $validator->errors()->first(),
            $code
        );
    }
    protected function returnCodeAccordingToInput($validator):string
    {
        $inputs = array_keys($validator->errors()->toArray());
        return $this->getErrorCode($inputs[0]);
    }

    protected function getErrorCode(string $input):string
    {
        if($input == 'email')return 'E002';
        if($input == 'password')return 'E003';
        if($input == 'name')return 'E004';
        return 'E0011';
    }

}
