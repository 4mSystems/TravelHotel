<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ad;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');


    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        if (auth()->user()->type == 'super admin') {
            // Data For Manager
            $ads =ad::all();
            $ads_pending =ad::where('status','pending')->get();
            $ads_accepted =ad::where('status','accepted')->get();
            $ads_rejected =ad::where('status','rejected')->get();


            $data['ads'] = $ads;
            $data['ads_pending'] = $ads_pending;
            $data['ads_accepted'] = $ads_accepted;
            $data['ads_rejected'] = $ads_rejected;

            return view('home', compact('data'));
        } else {

//             dd($totalCustomer);
auth()->logout();
session()->flash('danger', trans('admin.Erorr_Login'));
            return view('auth.login');
        }
    }
}