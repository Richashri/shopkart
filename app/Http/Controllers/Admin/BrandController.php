<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Brand;

use Session;
use Auth;

class BrandController extends Controller
{
    //
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brands')->with(compact('brands'));
    }


    public function add(Request $request)
    {
        $data = $request->all();

        $validatedData = $request->validate([
            'name' => 'required',
            'status' => 'required',
            'slug' => 'required|unique:brands'
        ]);

        $brand = new Brand;

        $brand->name = $data['name'];
        $brand->description = $data['description'];
        $brand->slug = $data['slug'];
        $brand->status = $data['status'];

        $brand->save();

        $count = brand::count();

        return response([
                'success_message' => "Brand is Added Successfully...",
                'name' => $data['name'],                
                'status' => $data['status'],
                'description' => $data['description'],
                'slug' => $data['slug'],
                'count' => $count,
                'last_insert_id' => $brand->id,
            ], 200);
    }

    public function delete($did)
    {
        if(Auth::guard('admin')->check()){
            Brand::where('id', $did)->delete();

            Session::flash('success_message', 'Brand is successfully deleted...');
            return redirect()->back();
        }
        
        Session::flash('error_message', 'Something Wrong!');
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $data = $request->all();

        $validatedData = $request->validate([
            'name' => 'required',
            'status' => 'required',
            'slug' => 'required'
        ]);

        $brand = Brand::where('id', $data['eid'])->first();

        $brand->name = $data['name'];
        $brand->description = $data['description'];
        $brand->status = $data['status'];
        $brand->slug = $data['slug'];

        $brand->update();

        $count = brand::count();

        return response([
                'success_message' => "Brand is Added Successfully...",
                'name' => $data['name'],                
                'status' => $data['status'],
                'description' => $data['description'],
                'slug' => $data['slug'],
                'count' => $count,
                'last_insert_id' => $data['eid'],
            ], 200);
    }
}
