<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public $objectName;


    public function __construct(User $model){
        $this->objectName = $model;

    }
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
    public function login(Request $request)
    {
        $input = $request->all();
        $validate = $this->makeValidate($input,[
            'email'=>'required|email',
            'password'=>'required',
            ]);
            if (!is_array($validate)) {

            if(Auth::attempt([
                'email'=>$request->input('email'),
                'password'=>$request->input('password'),
            ]))
            {


                $user = auth()->user();
                if($user->type =='super admin'){
                    return $this->sendResponse(401, 'غير مصرح لك الدخول',null);


                }

                $user->api_token = Str::random(60);

                $api_token = $user->api_token;
                $user->save();


                return $this->sendResponse(200, 'تم تسجيل الدخول بنجاح',$user);
            }
            else
            {
                return $this->sendResponse(401, 'البريد الالكترونى او الرقم السري غير صحيح',null);
            }
        }else {
            return $this->sendResponse(403, $validate, null);
        }
    
        }





    public function logout(Request $request){
        $input = $request->all();
        $validate = $this->makeValidate($input,[
            'api_token'=>'required',

            ]);
            if (!is_array($validate)) {

            $api_token =$request->input('api_token');
            $user = User::where('api_token',$api_token)->first();

            if(empty($user)){
                return $this->sendResponse(403, 'يرجى تسجيل الدخول ',null);
            }


            $user->api_token = null;
            if($user->save()){
                Auth::logout();
                return $this->sendResponse(200, 'تم تسجيل الخروج بنجاح',null);
            }else{
                return $this->sendResponse(401, 'يرجى تسجيل الدخول ',null);
            }
       }else {
        return $this->sendResponse(403, $validate, null);
    }

    }




}