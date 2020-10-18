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
                'email' => 'required|unique:users',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6',
            ]);

        if (!is_array($validate)) {

     
            if($request['password'] != null  && $request['password_confirmation'] != null ){
            $input['password'] = bcrypt(request('password'));
            $input['type'] = 'provider';
            
            $user = User::create($input);

           
            $user->api_token = Str::random(60);

            $api_token = $user->api_token;
            $user->save();
            return $this->sendResponse(200, 'تم أضافة حساب جديد بنجاح', $user);
        }
           
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
                'user_id' => 'required|exists:users,id',
                'phone' => 'numeric|unique:users,phone,' . $id,
                'email' => 'required|unique:users,email,' . $id,
                'password' => 'required|min:6',
                'telephone'=>'required',
                'image' => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp',
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

        if ($request['image'] != null) {
            // This is Image Information ...
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();
            // Move Image To Folder ..
            $fileNewName = 'img_' . time() . '.' . $ext;
            $file->move(public_path('uploads/Providers'), $fileNewName);
            $input['image'] = $fileNewName;

        }else{
            unset($input['image']);
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

    public function changePass(Request $request)
    {
        $input = $request->all();
        $id = $request->input('user_id');
       

            $validate = $this->makeValidate($input,
            [
          
                'user_id' => 'required',
                'password' => 'sometimes|nullable|confirmed|min:6',
            ]);


            if (!is_array($validate)) {

            $api_token = $request->input('api_token');
          
            $user = User::where('api_token',$api_token)->first();
            if($user != null){

                if($request->input('password') != null  && $request->input('password_confirmation')!= null ){


                    $pass= Hash::make($request->input('password'));
                    $data['password'] = $pass;
        
        //            auth()->logout();
        
                }else
                {
                    return $this->sendResponse(200, 'يجب ملئ الحقول', $User);
                }
                $User = User::where('id', $id)->update($data);

           return $this->sendResponse(200, 'تم تغير الرقم السرى', $User);
        }else{
            return $this->sendResponse(403, 'يرجى تسجيل الدخول ',null);
        }
       
        }else {
            return $this->sendResponse(403, $validate, null);
        }
    }

}