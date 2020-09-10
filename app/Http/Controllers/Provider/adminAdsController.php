<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ad;
use App\User;

class adminAdsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }
    public function index()
    {
        session()->put('reser_status', 'all');
        $provider_id  = Auth::user()->id;
        $ads = ad::where('provider_id','!=',null)->get();
        return view('admin_ads.ads_admin_page',\compact('ads'));
    }

    public function getAdsByStatus($status)
    {
        session()->put('reser_status', $status);
                // dd($status);
        $ads = ad::where('provider_id','!=', null)->where('status', $status)->get();

        return view('admin_ads.ads_admin_page',\compact('ads'));

    }
    public function block_user(Request $request, $provider_id)
    {
        $data = $this->validate(\request(),
        [
        ]);
        $data['status'] = 'deActive';
        User::where('id', $provider_id)->update($data);
        session()->flash('success', trans('admin.statuschanged'));
        return redirect(url('ads_admin'));
    }
    public function store(Request $request)
    {
        //
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
