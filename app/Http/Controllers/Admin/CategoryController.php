<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Session;
use App\Category;

use Auth;
use File;

class CategoryController extends Controller
{
    
    //
    public function index()
    {
        $categories = Category::all();
        return view('admin.category')->with(compact('categories'));
    }

    public function create()
    {
        $sections = \App\Section::select('id', 'name')->where('status', 1)->get();
        $categories = Category::select('id', 'name')->where('status', 1)->get();

        return view('admin.category.create')->with(compact('sections', 'categories'));
    }

    public function add(Request $request)
    {
        $data = $request->all();

        $validatedData = $request->validate([
            'name' => 'required',
            'status' => 'required',
            'slug' => 'required|unique:categories',
            'section' => 'required',
            'image' => 'image|max:1024',
        ]);
        
        $category = new Category;
        $file_name = '';
        $env_admin_img_path = env('IMG_ADMIN_PATH');

        if($request->hasfile('image')){
            $file = $request->file('image');
            $file_ext = $file->getClientOriginalExtension();
            $file_name = 'category_'.uniqid().'.'.$file_ext;
            $file->move($env_admin_img_path, $file_name);
        }

        $category->name = $data['name'];
        $category->description = $data['description'];
        $category->status = $data['status'];
        $category->slug = $data['slug'];
        $category->discount = $data['discount'];
        $category->section_id = $data['section'];
        $category->parent_id = $data['parent'];
        $category->meta_description = $data['meta_description'];
        $category->meta_keywords = $data['meta_keywords'];
        $category->image = $file_name;

        if($category->save()){
            Session::flash('success_message', 'Category is added successfully...');
            return redirect()->route('categories_list');
        }else{
            Session::flash('error_message', 'Someting Wrong!');
            return redirect()->back();
        }       
    }

    public function delete_image(Request $request)
    {
        if($request->ajax()){
            $cat_id = $request['catId'];
            $image_path = env('IMG_ADMIN_PATH').$request['catImage'];
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            if(Category::where('id', $cat_id)->update(['image' => ''])){
                return response([
                    'success_message' => "Category Image is delete Successfully...",
                    'cat_id' => $request['catId']
                ], 200);
            }else{
                return response([
                    'error_message' => "Whoops Something wrong!",
                    'cat_id' => $request['catId']
                ], 500);
            }
        }

        return response([
            'error_message' => "Whoops Something wrong!",
            'cat_id' => $request['catId']
        ], 404);
    }

    public function edit(Request $request, $eid)
    {
        $edit_category = Category::where('id', $eid)->first();
        $sections = \App\Section::select('id', 'name')->where('status', 1)->get();
        $categories = Category::select('id', 'name')->where('status', 1)->get();

        return view('admin.category.update')->with(compact('edit_category', 'sections', 'categories'));
    }

    public function delete($did)
    {
        if(Auth::guard('admin')->check()){
            Category::where('id', $did)->delete();

            Session::flash('success_message', 'Category is successfully deleted...');
            return redirect()->back();
        }
        
        Session::flash('error_message', 'Whoops, Something Wrong!');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validatedData = $request->validate([
            'name' => 'required',
            'status' => 'required',
            'slug' => 'required',
            'section' => 'required',
            'image' => 'image|max:1024',
        ]);
        
        $category = Category::where('id', $id)->first();
        $file_name = ($category->image != '') ? $category->image : '';
        $env_admin_img_path = env('IMG_ADMIN_PATH');

        if($request->hasfile('image')){
            $file = $request->file('image');
            $file_ext = $file->getClientOriginalExtension();
            $file_name = 'category_'.uniqid().'.'.$file_ext;
            $file->move($env_admin_img_path, $file_name);
        }

        $category->name = $data['name'];
        $category->description = $data['description'];
        $category->status = $data['status'];
        $category->slug = $data['slug'];
        $category->discount = $data['discount'];
        $category->section_id = $data['section'];
        $category->parent_id = $data['parent'];
        $category->meta_description = $data['meta_description'];
        $category->meta_keywords = $data['meta_keywords'];
        $category->image = $file_name;
       
        if($category->update()){
            Session::flash('success_message', 'Category is added successfully...');
            return redirect()->route('categories_list');
        }else{
            Session::flash('error_message', 'Someting Wrong!');
            return redirect()->back();
        }       
    }
       
}
