<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Category;

use Auth;
use File;

class ProductController extends Controller
{
     
         public function index()
    {
        $table_products = Product::all();
        return view('admin.product.create')->with(compact('table_products'));
    }
     public function create()
    {
        $sections = \App\Section::select('id', 'name')->where('status', 1)->get();
        $categories = Category::select('id', 'name')->where('status', 1)->get();
      // $brand = \App\Brands::select('id','name')->where('status',1)->get();
        //$table_products = Product::select('id', 'name')->where('status', 1)->get();
       // return view('admin.product.create')->with(compact('sections', 'categories','brand'));
        return view('admin.product.create')->with(compact('sections', 'categories'));
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
        
        $product = new Product;
        $file_name = '';
        $env_admin_img_path = env('IMG_ADMIN_PATH');

        if($request->hasfile('image')){
            $file = $request->file('image');
            $file_ext = $file->getClientOriginalExtension();
            $file_name = 'category_'.uniqid().'.'.$file_ext;
            $file->move($env_admin_img_path, $file_name);
        }

        $product->name = $data['name'];
        $product->code = $data['code'];
        $product->category_id = $data['category'];
        $product->description = $data['description'];
        $product->status = $data['status'];
        $product->slug = $data['slug'];
        $product->weight = $data['weight'];
        $product->color = $data['color'];
        $product->fit = $data['fit'];
        $product->mrp = $data['mrp'];
        $product->price = $data['price'];
        $product->product_id = $data['product'];
        $product->discount = $data['discount'];
        $product->section_id = $data['section'];
        $product->brand_id = $data['brand'];
        $product->meta_description = $data['meta_description'];
        $product->meta_keywords = $data['meta_keywords'];
        $product->meta_title = $data['meta_keywords'];
        $product->order = $data['order'];
        $product->is_featured = $data['is_featured'];
        $product->image = $file_name;
        $product->other_image = $file_name;
        $product->video = $file_name;

        if($product->save()){
            Session::flash('success_message', 'product is added successfully...');
            return redirect()->route('product_list');
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
            if(Product::where('id', $cat_id)->update(['image' => ''])){
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
        $edit_Product = Product::where('id', $eid)->first();
        $sections = \App\Section::select('id', 'name')->where('status', 1)->get();
        $categories = Category::select('id', 'name')->where('status', 1)->get();
$products = Product::select('id', 'name')->where('status', 1)->get();
        return view('admin.product.update')->with(compact('edit_product', 'sections', 'categories'));
    }

    public function delete($did)
    {
        if(Auth::guard('admin')->check()){
            Product::where('id', $did)->delete();

            Session::flash('success_message', 'Product is successfully deleted...');
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
        
        $prduct = Product::where('id', $id)->first();
        $file_name = ($product->image != '') ? $product->image : '';
        $env_admin_img_path = env('IMG_ADMIN_PATH');

        if($request->hasfile('image')){
            $file = $request->file('image');
            $file_ext = $file->getClientOriginalExtension();
            $file_name = 'product_'.uniqid().'.'.$file_ext;
            $file->move($env_admin_img_path, $file_name);
        }

        $product->name = $data['name'];
        $product->code = $data['code'];
        $product->category_id = $data['category'];
        $product->description = $data['description'];
        $product->status = $data['status'];
        $product->slug = $data['slug'];
        $product->weight = $data['weight'];
        $product->color = $data['color'];
        $product->fit = $data['fit'];
        $product->mrp = $data['mrp'];
        $product->price = $data['price'];
        $product->product_id = $data['product'];
        $product->discount = $data['discount'];
        $product->section_id = $data['section'];
        $product->brand_id = $data['brand'];
        $product->meta_description = $data['meta_description'];
        $product->meta_keywords = $data['meta_keywords'];
        $product->meta_title = $data['meta_keywords'];
        $product->order = $data['order'];
        $product->is_featured = $data['is_featured'];
        $product->image = $file_name;
        $product->other_image = $file_name;
        $product->video = $file_name;
       
        if($product->update()){
            Session::flash('success_message', 'Product is added successfully...');
            return redirect()->route('product_list');
        }else{
            Session::flash('error_message', 'Someting Wrong!');
            return redirect()->back();
        }       
    }

    	//$categories=Category::pluck('name','parent_id');
    	//return view ('admin.product.create',compact('categories'));
    	//return view ('admin.product.create');
    
    //public function store(Request $request)
    //{
    //	$formInput=$request->expect('image');
    //	$image=$request->image;
   // 	if($image){
    //		$imageName=$image->getClientOriginalName();
    //		$image->move('images',$imageName);
    //		$formInput['image']=$imageName;

    //	}
    //	Product::create($formInput);
    //	return redirect()->route('admin.index');
    //}
}
