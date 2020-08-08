<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Section;

use Session;
use Auth;

class SectionController extends Controller
{
    //
    public function index()
    {
        $sections = Section::all();
        return view('admin.sections')->with(compact('sections'));
    }


    public function add(Request $request)
    {
        $data = $request->all();

        $validatedData = $request->validate([
            'name' => 'required',
            'status' => 'required'
        ]);

        $section = new Section;

        $section->name = $data['name'];
        $section->description = $data['description'];
        $section->status = $data['status'];

        $section->save();

        $count = Section::count();

        return response([
                'success_message' => "Section is Added Successfully...",
                'name' => $data['name'],                
                'status' => $data['status'],
                'count' => $count,
                'last_insert_id' => $section->id,
            ], 200);
    }

    public function delete($did)
    {
        if(Auth::guard('admin')->check()){
            Section::where('id', $did)->delete();

            Session::flash('success_message', 'Section is successfully deleted...');
            return redirect()->back();
        }
        
        Session::flash('error_message', 'Something Wrong!');
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $data = $request->all();

        $validatedData = $request->validate([
            'ename' => 'required',
            'estatus' => 'required'
        ]);

        $section = Section::where('id', $data['eid'])->first();

        $section->name = $data['ename'];
        $section->description = $data['edescription'];
        $section->status = $data['estatus'];

        $section->update();

        $count = Section::count();

        return response([
                'success_message' => "Section is Added Successfully...",
                'name' => $data['ename'],                
                'status' => $data['estatus'],
                'description' => $data['edescription'],
                'count' => $count,
                'last_insert_id' => $data['eid'],
            ], 200);
    }
}
