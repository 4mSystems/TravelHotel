<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class SuperAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    public function index()
    {

        $users = User::where('type','super admin')->limit(10)->get();
        return view('admin.super_admin',\compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create_super_admin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate(\request(),
        [
            'name' => 'required|unique:users',
            'phone' => 'numeric|required|unique:users',
            'company_name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
            'payment_method'=>'required',
            'card_number'=>'',

        ]);

    $data['password'] = Hash::make(request('password'));
    $data['type'] = "super admin";
    $data['added_by'] = Auth::user()->id;
    $user = User::create($data);
    $user->save();
    session()->flash('success', trans('admin.addedsuccess'));
    return redirect(url('super_Admin'));

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
        $user_data = User::where('id', $id)->first();
        return view('admin.edit_super_admin', \compact('user_data'));
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
        $data = $this->validate(\request(),
        [
            'name' => 'required|unique:users,name,' . $id,
            'email' => 'required|unique:users,email,'.$id,
            'phone' => 'numeric|required|unique:users,phone,'.$id,
            'company_name' => 'required',
            'payment_method' => 'required',
            'card_number' => '',
            'password' => 'sometimes|nullable|min:6',
        ]);
        if($request['password'] != null){


            $pass= Hash::make(request('password'));
            $data['password'] = $pass;
        }else
        {
            unset($data['password']);
        }

    User::where('id', $id)->update($data);
    session()->flash('success', trans('admin.updatSuccess'));

    return redirect(url('super_Admin'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        $user->delete();
        session()->flash('success', trans('admin.deleteSuccess'));
        return redirect(url('super_Admin'));
    }
}
