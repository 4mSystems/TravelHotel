<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Validator;
use App\User;
use App\customer_category;

class registerApiController extends Controller
{
    public function sendResponse($code = null, $msg = null, $data = null){

        return response(
            [
                'code' => $code,
                'msg' => $msg,
                'data' => $data
            ]
        );

    }

    public function validationErrorsToString($errArray){
        $valArr = array();
        foreach ($errArray->toArray() as $key => $value) {
            $errStr = $value[0];
            array_push($valArr, $errStr);
        }
        return $valArr;
    }

    public function makeValidate($inputs, $rules){

        $validator = Validator::make($inputs, $rules);
        if ($validator->fails()) {
            return $this->validationErrorsToString($validator->messages());
        } else {
            return true;
        }
    }

    public function user_Profile(Request $request)
    {
        $rules = [

            'api_token' => 'required',
            'user_id' => 'required',

        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->sendResponse(401, 'يرجى تسجيل الدخول ', null);
        } else {

            $api_token = $request->input('api_token');
            $user_id = $request->input('user_id');
            $user = User::where('api_token',$api_token)->first();
            if($user != null){

            $UserData =User::where('id',$user_id)->first();

           return $this->sendResponse(200, 'تم اظهار معلومات المستخدم', $UserData);
        }else{
            return $this->sendResponse(403, 'يرجى تسجيل الدخول ',null);
        }
       
        }

    }
     public function store(Request $request)
    {
        $input = $request->all();

        $validate = $this->makeValidate($input,
            [
                'name' => 'required|unique:users',
                'phone' => 'numeric|required|unique:users',
                'company_name' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required|min:6',
                'payment_method'=>'required',
                'type'=>'required',
                'card_number'=>'sometimes|nullable',
                'categories'=>'required',
                
            ]);

        if (!is_array($validate)) {

     

            $input['password'] = bcrypt(request('password'));

            $user = User::create($input);

           
            $user->api_token = Str::random(60);

            $api_token = $user->api_token;
            $user->save();


        foreach ($input['categories'] as $cat) {
            customer_category::create(['user_id' => $user->id, 'category_id' => $cat]);
        }

            return $this->sendResponse(200, 'تم أضافة حساب جديد بنجاح', $user);
        } else {
            return $this->sendResponse(403, $validate, null);
        }

    }

    public function update_profile(Request $request)
    {
        $input = $request->all();
        $id = $request->input('user_id');
       

            $validate = $this->makeValidate($input,
            [
                'api_token' => 'required',
                'name' => 'required|unique:users,name,' . $id,
                'user_id' => 'required',
                'phone' => 'numeric|unique:users,phone,' . $id,
                'company_name' => 'required',
                'email' => 'required|unique:users,email,' . $id,
                'password' => 'required|min:6',
                'payment_method'=>'required',
                'card_number'=>'sometimes|nullable',
            ]);


            if (!is_array($validate)) {

            $api_token = $request->input('api_token');
          
            $user = User::where('api_token',$api_token)->first();
            if($user != null){

            
        if($request['password'] != null){

            $pass= Hash::make(request('password'));
            $input['password'] = $pass;
        }else
        {
            unset($input['password']);
        }
        $User = User::find(intval($id))->update($input);

           return $this->sendResponse(200, 'تم التعديل', $User);
        }else{
            return $this->sendResponse(403, 'يرجى تسجيل الدخول ',null);
        }
       
        }else {
            return $this->sendResponse(403, $validate, null);
        }
    }
}