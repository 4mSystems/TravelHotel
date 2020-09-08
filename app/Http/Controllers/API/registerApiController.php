<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
use App\User;

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
            ]);

        if (!is_array($validate)) {

     

            $input['password'] = bcrypt(request('password'));

            $user = User::create($input);

           
            $user->api_token = Str::random(60);

            $api_token = $user->api_token;
            $user->save();

            return $this->sendResponse(200, 'تم أضافة حساب جديد بنجاح', $user);
        } else {
            return $this->sendResponse(403, $validate, null);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
