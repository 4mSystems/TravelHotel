<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;

class CategoryController extends Controller
{
  
    
    public function __construct()
    {
        $this->middleware('auth');

    }
    public function index()
    {
        $provider_id  = Auth::user()->id;
        $categories =Category::all();
        return view('category.categories_page',\compact('categories'));
    }

    public function create()
    {
        return view('category.create_cat');
    }

    public function store(Request $request)
    {
  
        $data = $this->validate(\request(),
        [
            'name' => 'required',
        ]);

    $data['provider_id'] = Auth::user()->id;
    $cat = Category::create($data);
    $cat->save();
    session()->flash('success', trans('admin.addedsuccess'));
    return redirect(url('category'));

    }

 
    public function edit($id)
    {
        $category = Category::where('id', $id)->first();
        return view('category.edit_cat', \compact('category'));
    }

    

    public function update(Request $request, $id)
    {
        $data = $this->validate(\request(),
        [
            'name' => 'required',
        ]);
       
        Category::where('id', $id)->update($data);
    session()->flash('success', trans('admin.updatSuccess'));

    return redirect(url('category'));
    }

    public function destroy($id)
    {
        $cat = Category::where('id', $id)->first();
        $cat->delete();
        session()->flash('success', trans('admin.deleteSuccess'));
        return redirect(url('category'));
    }

}
