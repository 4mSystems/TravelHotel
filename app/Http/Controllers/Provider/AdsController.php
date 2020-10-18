<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ad;
use App\ads_image;

class AdsController extends Controller
{
    public $i =1;
    
    public function __construct()
    {
        $this->middleware('auth');

    }
    public function index()
    {
        $provider_id  = Auth::user()->id;
        $ads = ad::where('provider_id',$provider_id)->get();
        return view('ads.ads_page',\compact('ads'));
    }

    public function create()
    {
        return view('ads.create_ads');
    }

    public function store(Request $request)
    {
  
        $data = $this->validate(\request(),
        [
            'price' => 'numeric|required',
            'description' => 'required',
            'image' => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp',
            'category_id'=>'required',
        ]);

        if ($request['image'] != null) {
            // This is Image Information ...
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();
            // Move Image To Folder ..
            $fileNewName = 'img_' . time() . '.' . $ext;
            $file->move(public_path('uploads/ads'), $fileNewName);


            $data['image'] = $fileNewName;

        }else{
            $data['image'] = 'default_ad.jpg';
        }


    $data['provider_id'] = Auth::user()->id;
    $ad = ad::create($data);
    $ad->save();
    session()->flash('success', trans('admin.addedsuccess'));
    return redirect(url('ads'));

    }

    public function show($id)
    {
        $ads_images = ads_image::where('ads_id', $id)->get();
        $ad_id = $id ;
        return view('ads.ads_images', \compact('ads_images','ad_id'));
    }

    public function change_ad_status($id,$type)
    {
        dd($type);
        $ads_images = ads_image::where('ads_id', $id)->get();
        $ad_id = $id ;
        return view('ads.ads_images', \compact('ads_images','ad_id'));
    }

    public function edit($id)
    {
        $ad_data = ad::where('id', $id)->first();
        return view('ads.edit_ads', \compact('ad_data'));
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
    public function storeAdImage(Request $request, $id)
    {
       
        $request->validate([
            'image' => 'required',
        ]);

        $input = $request->all();
dd($input['image']);
        foreach ($input['image'] as $ima) {
            # code...
            $gallery['image'] = $this->MoveImage($ima);
            $gallery['ads_id'] = $id;
            $gallery['provider_id'] = Auth::user()->id;

            ads_image::create($gallery);
        }


        return redirect()->back()->with('success',trans('admin.addedsuccess'));

    }

    public function update(Request $request, $id)
    {
        $data = $this->validate(\request(),
        [
            'price' => 'numeric|required',
            'image' => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp',
            'description' => 'required',
            'category_id'=>'required',
        ]);
        if ($request['image'] != null) {
            // This is Image Information ...
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();
            // Move Image To Folder ..
            $fileNewName = 'img_' . time() . '.' . $ext;
            $file->move(public_path('uploads/ads'), $fileNewName);
            $data['image'] = $fileNewName;
        }else{
            unset($data['image']);
        }
       
        ad::where('id', $id)->update($data);
    session()->flash('success', trans('admin.updatSuccess'));

    return redirect(url('ads'));
    }

    public function accept_status(Request $request, $id)
    {
        $data = $this->validate(\request(),
        [
        ]);
        $data['status'] = 'accepted';
        ad::where('id', $id)->update($data);
        session()->flash('success', trans('admin.statuschanged'));
        return redirect(url('ads'));
    }

    public function reject_status(Request $request, $id)
    {
        $data = $this->validate(\request(),
        [
        ]);
        $data['status'] = 'rejected';
        ad::where('id', $id)->update($data);
        session()->flash('success', trans('admin.statuschanged'));
        return redirect(url('ads'));
    }
    public function destroy($id)
    {
        $user = ad::where('id', $id)->first();
        $user->delete();
        session()->flash('success', trans('admin.deleteSuccess'));
        return redirect(url('ads'));
    }

    public function destroyAdImages(Request $request)
    {

        $request->validate([
            'deleteImages' => 'required',
        ]);

        $input = $request->all();

        foreach ($input['deleteImages'] as $image_id) {

            ads_image::find($image_id)->delete();

        }


        return redirect()->back()->with('success',trans('admin.deleteSuccess'));

    }
}
