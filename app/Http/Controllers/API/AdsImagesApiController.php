<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\ad;
use App\ads_image;
use App\User;

class AdsImagesApiController extends Controller
{
    public $i =1;
    public $LoginWarning ='You Want to login First !';
    

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
    public function MoveImage($request_file)
    {
        
        $file = $request_file;
        $name = $file->getClientOriginalName();
        $ext = $file->getClientOriginalExtension();
        // Move Image To Folder ..
        $fileNewName = 'img_' .$this->i . time() .'.' . $ext;
        $file->move(public_path('uploads/ads_images'), $fileNewName);
        $this->i =$this->i+1;
        return $fileNewName;
     
    }
    public function store_ad_images (Request $request)
    {
        $input = $request->all();
        $validate = $this->makeValidate($input,[
                'api_token' => 'required',
                'provider_id' => 'required',
                'ads_id' => 'required',
                
                'image' => 'required',
                ]);


                if (!is_array($validate)) {

            $api_token = $request->input('api_token');
            $provider_id = $request->input('provider_id');
            $ads_id = $request->input('ads_id');
            $user = User::where('api_token',$api_token)->first();
            if($user != null){
            
                foreach ($input['image'] as $ima) {
                  
                    $gallery['image'] = $this->MoveImage($ima);
                    $gallery['provider_id'] = $provider_id;
                    $gallery['ads_id'] = $ads_id;
        
                  $data =  ads_image::create($gallery);

                }

            return $this->sendResponse(200, 'Ad Images Added Successfully', Null);
        }else{
            return $this->sendResponse(403, $this->LoginWarning,null);
        }
    }else {
        return $this->sendResponse(403, $validate, null);
    }
}

    

    public function delete_ad_images(Request $request)
    {
        $id = $request->ad_image_id;
        $input = $request->all();
        $validate = $this->makeValidate($input,[
                'api_token' => 'required',
                'ad_image_id' => 'required',
                ]);


                if (!is_array($validate)) {

            $api_token = $request->input('api_token');
            $user = User::where('api_token',$api_token)->first();
            if($user != null){

                foreach ($input['ad_image_id'] as $image_id) {

                    ads_image::find($image_id)->delete();
        
                }



            return $this->sendResponse(200, 'Your Ad Deleted ', null);
        }else{
            return $this->sendResponse(403, $this->LoginWarning,null);
        }
    }else {
        return $this->sendResponse(403, $validate, null);
    }
}
}
