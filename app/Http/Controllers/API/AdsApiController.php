<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\ad;
use App\ads_image;
use App\User;



class AdsApiController extends Controller
{
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
    public function all_ads(Request $request)
    {
        $rules = [
            'provider_id' => 'required',
            'api_token' => 'required',
            
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->sendResponse(401, $this->LoginWarning, null);
        } else {

            $api_token = $request->input('api_token');
            $user = User::where('api_token',$api_token)->first();
            if($user != null){
            $provider_id = $request->input('provider_id');
            
            $ad_withCat =ad::where('status','accepted')
            ->where('provider_id',$provider_id)
            ->with('category')->get();
           
            return $this->sendResponse(200, 'تم  اظهار الاعلانات بالنصنيف', $ad_withCat);
        }else{
            return $this->sendResponse(403, 'يرجى تسجيل الدخول ',null);
        }
        }

    }

    public function ads_withCat(Request $request)
    {
        $rules = [
            'cat_id' => 'required',
            'provider_id' => 'required',
            'api_token' => 'required',
            
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->sendResponse(401, $this->LoginWarning, null);
        } else {

            $api_token = $request->input('api_token');
            $user = User::where('api_token',$api_token)->first();
            if($user != null){

            $cat_id = $request->input('cat_id');
            $provider_id = $request->input('provider_id');
            
            $ad_withCat =ad::where('status','accepted')
            ->where('category_id',$cat_id)
            ->where('provider_id',$provider_id)
            ->with('category')->get();
           
            return $this->sendResponse(200, 'تم  اظهار الاعلانات بالنصنيف', $ad_withCat);
        }else{
            return $this->sendResponse(403, 'يرجى تسجيل الدخول ',null);
        }
        }

    }
   

    public function ad_with_id(Request $request)
    {
        $rules = [
            'ad_id' => 'required',
            'api_token' => 'required',
            
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->sendResponse(401,$this->LoginWarning, null);
        } else {

            $api_token = $request->input('api_token');
            $user = User::where('api_token',$api_token)->first();
            if($user != null){

            $ad_id = $request->input('ad_id');
            
            $ad_withID =ad::where('status','accepted')
            ->where('id',$ad_id)
            ->with('category')->get();
            if(count($ad_withID) != 0){
            $adImages_withID =ads_image::where('ads_id',$ad_id)
            ->with('ads')->get();
            }else{
                $adImages_withID = [];
            }
            return $this->sendResponse(200, ' تم  اظهار الاعلان بصوره',  array('ad_withID' => $ad_withID ,'adImages_withID' => $adImages_withID));
        }else{
            return $this->sendResponse(403, 'يرجى تسجيل الدخول ',null);
        }
        }

    }

    public function store_ad(Request $request)
    {
        $input = $request->all();

        $rules = [
                'api_token' => 'required',
                'provider_id' => 'required',
            'name' => 'required',
            'phone' => 'numeric|required',
            'image' => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp',
            'description' => 'required',
            'address' => '',
            'start_at'=>'required',
            'end_at'=>'required',
            'category_id'=>'required',
        ];

                $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->sendResponse(401,$this->LoginWarning, null);
        } else {

            $api_token = $request->input('api_token');
            $user = User::where('api_token',$api_token)->first();
            if($user != null){


            if ($request['image'] != null) {
                // This is Image Information ...
                $file = $request->file('image');
                $name = $file->getClientOriginalName();
                $ext = $file->getClientOriginalExtension();
                // Move Image To Folder ..
                $fileNewName = 'img_' . time() . '.' . $ext;
                $file->move(public_path('uploads/ads'), $fileNewName);
    
    
                $input['image'] = $fileNewName;
    
            }else{
                $input['image'] = 'default_ad.jpg';
            }

            $ad = ad::create($input);


            return $this->sendResponse(200, 'Data Added Successfully', $ad);
        }else{
            return $this->sendResponse(403, $this->LoginWarning,null);
        }
        }

    }

    public function uodate_ad(Request $request)
    {
        $input = $request->all();
        $id = $request->ad_id;
        $rules = [
                'api_token' => 'required',
                'ad_id' => 'required',
            'name' => 'required',
            'phone' => 'numeric|required',
            'image' => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp',
            'description' => 'required',
            'address' => '',
            'start_at'=>'required',
            'end_at'=>'required',
            'category_id'=>'required',
        ];

                $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->sendResponse(401, $this->LoginWarning, null);
        } else {

            $api_token = $request->input('api_token');
            $user = User::where('api_token',$api_token)->first();
            if($user != null){


            if ($request['image'] != null) {
                // This is Image Information ...
                $file = $request->file('image');
                $name = $file->getClientOriginalName();
                $ext = $file->getClientOriginalExtension();
                // Move Image To Folder ..
                $fileNewName = 'img_' . time() . '.' . $ext;
                $file->move(public_path('uploads/ads'), $fileNewName);
    
    
                $input['image'] = $fileNewName;
    
            }else{
                unset($input['image']);
            }

            $ad = ad::find(intval($id))->update($input);


            return $this->sendResponse(200, 'Your Ad Updated ', $ad);
        }else{
            return $this->sendResponse(403, $this->LoginWarning,null);
        }
        }

    }

    public function delete_ad(Request $request)
    {
        $input = $request->all();
        $id = $request->ad_id;
        $rules = [
                'api_token' => 'required',
                'ad_id' => 'required',
        ];

                $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->sendResponse(401, $this->LoginWarning, null);
        } else {

            $api_token = $request->input('api_token');
            $user = User::where('api_token',$api_token)->first();
            if($user != null){


            $ad = ad::find(intval($id))->delete();


            return $this->sendResponse(200, 'Your Ad Deleted ', $ad);
        }else{
            return $this->sendResponse(403, $this->LoginWarning,null);
        }
        }

    }
}
