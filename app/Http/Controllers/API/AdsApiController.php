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
    public $i =1;

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
        $input = $request->all();
        $validate = $this->makeValidate($input,[
            'provider_id' => 'required',
            'api_token' => 'required',
            
            ]);
            if (!is_array($validate)) {

            $api_token = $request->input('api_token');
            $user = User::where('api_token',$api_token)->first();
            if($user != null){
            $provider_id = $request->input('provider_id');
            
            $ad_withCat =ad::where('status','accepted')
            ->where('provider_id',$provider_id)
            ->with('category')
            ->with('getUser')->get();
           
            return $this->sendResponse(200, 'تم  اظهار الاعلانات ', $ad_withCat);
        }else{
            return $this->sendResponse(403, 'يرجى تسجيل الدخول ',null);
        }
    }else {
        return $this->sendResponse(403, $validate, null);
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
    public function ads_withCat(Request $request)
    {
        $input = $request->all();
        $validate = $this->makeValidate($input,[
            'cat_id' => 'required',
            'provider_id' => 'required',
            'api_token' => 'required',
            
            ]);
            if (!is_array($validate)) {

            $api_token = $request->input('api_token');
            $user = User::where('api_token',$api_token)->first();
            if($user != null){

            $cat_id = $request->input('cat_id');
            $provider_id = $request->input('provider_id');
            
            $ad_withCat =ad::where('status','accepted')
            ->where('category_id',$cat_id)
            ->where('provider_id',$provider_id)
            ->with('category')
            ->with('getUser')->get();

            if(count($ad_withCat) != 0){
            return $this->sendResponse(200, 'تم  اظهار الاعلانات بالنصنيف', $ad_withCat);
              }  else{
        return $this->sendResponse(403, 'لا يوجد اعلانات',null);                

    }
        }else{
            return $this->sendResponse(403, 'يرجى تسجيل الدخول ',null);
        }
    }else {
        return $this->sendResponse(403, $validate, null);
    }

    }

    public function ads_with_Cat_customer(Request $request)
    {
        $input = $request->all();
        $validate = $this->makeValidate($input,[
            'cat_id' => 'required',
            'api_token' => 'required',
            
            ]);
            if (!is_array($validate)) {

            $api_token = $request->input('api_token');
            $user = User::where('api_token',$api_token)->first();
            if($user != null){

            $cat_id = $request->input('cat_id');

            $ad_withCat =ad::where('status','accepted')
            ->where('category_id',$cat_id)
            ->with('category')
            ->with('getUser')->get();
           
            if(count($ad_withCat) != 0){
            return $this->sendResponse(200, 'تم  اظهار الاعلانات بالنصنيف', $ad_withCat);
            }else{
            return $this->sendResponse(403, 'لا يوجد اعلانات',null);                
            }
        }else{
            return $this->sendResponse(403, 'يرجى تسجيل الدخول ',null);
        }
    }else {
        return $this->sendResponse(403, $validate, null);
    }

    }
   

    public function ad_with_id(Request $request)
    {
        $input = $request->all();
        $validate = $this->makeValidate($input,[
            'ad_id' => 'required',
            'api_token' => 'required',
            
            ]);
            if (!is_array($validate)) {
            $api_token = $request->input('api_token');
            $user = User::where('api_token',$api_token)->first();
            if($user != null){

            $ad_id = $request->input('ad_id');
            
            $ad_withID =ad::where('id',$ad_id)
            ->with('category')
            ->with('getUser')
            ->get();

            if(count($ad_withID) != 0){

            $adImages_withID =ads_image::where('ads_id',$ad_id)
            ->with('ads')->get();

            return $this->sendResponse(200, ' تم  اظهار الاعلان بصوره',  array('ad_withID' => $ad_withID ,'adImages_withID' => $adImages_withID));

            }else{
                $adImages_withID = [];
                return $this->sendResponse(403, 'لا يوجد اعلانات',null);                
            }
        }else{
            return $this->sendResponse(403, 'يرجى تسجيل الدخول ',null);
        }
    }else {
        return $this->sendResponse(403, $validate, null);
    }

    }

    public function ads_with_provider_id(Request $request)
    {
        $input = $request->all();
        $validate = $this->makeValidate($input,[
            'provider_id' => 'required',
            'api_token' => 'required',
            
            ]);
            if (!is_array($validate)) {
            $api_token = $request->input('api_token');
            $user = User::where('api_token',$api_token)->first();
            if($user != null){

            $provider_id = $request->input('provider_id');
            
            $ads_with_provider_id =ad::where('provider_id',$provider_id)
            ->with('category')
            ->with('getUser')
            ->get();

            return $this->sendResponse(200, ' تم  اظهار الاعلانات ',  array('ads_with_provider_id' => $ads_with_provider_id ));
        }else{
            return $this->sendResponse(403, 'يرجى تسجيل الدخول ',null);
        }
    }else {
        return $this->sendResponse(403, $validate, null);
    }

    }

    public function store_ad(Request $request)
    {
        $input = $request->all();
       
        $validate = $this->makeValidate($input,[
                'api_token' => 'required',
                'provider_id' => 'required',
                'price' => 'numeric|required',
                'image' => 'required|nullable|image|mimes:jpg,jpeg,png,gif,bmp',
                'imageAD' => 'sometimes|nullable',
                'description' => 'required',
                'category_id'=>'required',
                ]);
            if (!is_array($validate)) {
            $api_token = $request->input('api_token');
            $user = User::where('api_token',$api_token)->first();
            if($user != null){
                // dd($user->ads_count);
                if($user->ads_count == '0'){

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
            $ad->save();

            $provider_id = $request->input('provider_id');
            foreach ($input['imageAD'] as $ima) {

            $ads_image = new ads_image();
            $ads_image->image =$this->MoveImage($ima);
            $ads_image->ads_id = $ad->id;
            $ads_image->provider_id = $provider_id;


            $ads_image->save();

        }
       //Update user for taken one ad free
        $inputUser['ads_count'] = "1";

        User::find(intval($provider_id))->update($inputUser);
      

            return $this->sendResponse(200, 'Data Added Successfully', array('ad'=>$ad,'ad_images'=>$ads_image));
    }else{
        return $this->sendResponse(403, 'you have take Ad free once , you should pay',null);
    }
        
        }else{
            return $this->sendResponse(403, $this->LoginWarning,null);
        }
    }else {
        return $this->sendResponse(403, $validate, null);
    }

    }

    public function uodate_ad(Request $request)
    {
        $input = $request->all();
        $id = $request->ad_id;
        $validate = $this->makeValidate($input,
            [
            'api_token' => 'required',
            'ad_id' => 'required',
            'price' => 'required',
            'image' => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp',
            'description' => 'required',
            'category_id'=>'required',
            ]);

        if (!is_array($validate)) {

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
            return $this->sendResponse(403, 'يرجى تسجيل الدخول ',null);
        }
       
        }else {
            return $this->sendResponse(403, $validate, null);
        }

    }

 

    public function change_status(Request $request)
    {
        $input = $request->all();
        $id = $request->ad_id;
        $validate = $this->makeValidate($input,
            [
                'api_token' => 'required',
                'ad_id' => 'required',
            ]);

        if (!is_array($validate)) {

            $api_token = $request->input('api_token');
            $user = User::where('api_token',$api_token)->first();
            if($user != null){

                $ad_selectd = ad::where('id',$id)->first();
// dd($ad_selectd->status);
                if($ad_selectd->status =='rejected'){

                    return $this->sendResponse(403, 'برجاء دفع نصف المبلغ لاعاده الاعلان للظهور',null);

                }else if($ad_selectd->status =='accepted'){

                    $input['status'] = 'rejected';
                    $ad = ad::find(intval($id))->update($input);
                    return $this->sendResponse(200, 'Your Ad Updated to Deactived ', $ad);
                }     
    
        }else{
            return $this->sendResponse(403, 'يرجى تسجيل الدخول ',null);
        }
       
        }else {
            return $this->sendResponse(403, $validate, null);
        }

    }

    public function delete_ad(Request $request)
    {

        $input = $request->all();
        $id = $request->ad_id;
        $validate = $this->makeValidate($input,[
                'api_token' => 'required',
                'ad_id' => 'required',
                ]);
                if (!is_array($validate)) {
            $api_token = $request->input('api_token');
            $user = User::where('api_token',$api_token)->first();
            if($user != null){


            $ad = ad::find(intval($id))->delete();


            return $this->sendResponse(200, 'Your Ad Deleted ', $ad);
        }else{
            return $this->sendResponse(403, $this->LoginWarning,null);
        }
    }else {
        return $this->sendResponse(403, $validate, null);
    }

    }
}
