<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Setting;
use App\User;


class settingsApiController extends Controller
{
    public function sendResponse($code = null, $msg = null, $data = null)
    {

        return response(
            [
                'code' => $code,
                'msg' => $msg,
                'data' => $data
            ]
        );

    }

    public function validationErrorsToString($errArray)
    {
        $valArr = array();
        foreach ($errArray->toArray() as $key => $value) {
            $errStr = $value[0];
            array_push($valArr, $errStr);
        }
        return $valArr;
    }

    public function makeValidate($inputs, $rules)
    {

        $validator = Validator::make($inputs, $rules);
        if ($validator->fails()) {
            return $this->validationErrorsToString($validator->messages());
        } else {
            return true;
        }
    }
    public function index(Request $request)
    {
        $input = $request->all();
        $validate = $this->makeValidate($input,[
            'api_token' => 'required',
            ]);
            if (!is_array($validate)) {

            $api_token = $request->input('api_token');
            $user = User::where('api_token',$api_token)->first();
            if($user != null){

            $Setting =Setting::where('id','1')->get();
           
            return $this->sendResponse(200, 'تم  اظهار الاعدادات !! ', $Setting);
        }else{
            return $this->sendResponse(403, 'يرجى تسجيل الدخول ',null);
        }
    }else {
        return $this->sendResponse(403, $validate, null);
    }

    }
    public function update(Request $request)
    {
        $input = $request->all();

        $validate = $this->makeValidate($input,
            [
                'api_token' => 'required',
            'cost' => 'numeric|required',
            'period' => 'numeric|required',

            ]);

        if (!is_array($validate)) {

            $api_token = $request->input('api_token');
            $user = User::where('api_token',$api_token)->first();
            if($user != null){


            $Setting = Setting::find(intval(1))->update($input);


            return $this->sendResponse(200, 'Your Setting Updated ', $Setting);
        }else{
            return $this->sendResponse(403, 'يرجى تسجيل الدخول ',null);
        }
       
        }else {
            return $this->sendResponse(403, $validate, null);
        }

    }
}
