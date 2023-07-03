<?php

namespace App\Http\Controllers;
use App\Models\SubCatagory;
use App\Models\Catagory;
use Illuminate\Http\Request;

class SubCatagoryController extends Controller
{

    public function index()
    {
        return view('admin.sub-catagory.index',['catagories' => Catagory::all()]);
    }
    public function manage()

    {
        // $catagories=Catagory::all();
        // return view ('admin.catagory.manage',compact('catagories'));
        return view('admin.sub-catagory.manage', ['sub_catagories' => SubCatagory::all()]);
    }
    public function addsubcatagory(Request $request)
    {
        SubCatagory::newSubCatagory($request);
        return back()->with('success', 'Product has been saved successfully!');
    }
    public function edit($id)
    {
        return view('admin.sub-catagory.edit', [

            'catagories'        => Catagory::all(),
            'sub_catagories'    => SubCatagory::find($id),


    ]);
    }
    public function update(Request $request, $id)
    {
        SubCatagory::UpdateSubCatagory($request, $id);
        return redirect('/sub-catagory-manage')->with('message', 'Sub Catagory Info Updated');
    }
    public function delete($id)
    {
        SubCatagory::deleteSubCatagory($id);
        return redirect('/sub-catagory-manage')->with('message', 'Catagory Info Deleted');
    }

}
