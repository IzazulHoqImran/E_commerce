<?php

namespace App\Http\Controllers;

use App\Models\Catagory;
use Illuminate\Http\Request;

class CatagoryController extends Controller
{
    public function index()
    {
        return view('admin.catagory.index');
    }
    public function manage()

    {
        // $catagories=Catagory::all();
        // return view ('admin.catagory.manage',compact('catagories'));
        return view('admin.catagory.manage', ['catagories' => Catagory::all()]);
    }
    public function addcatagory(Request $request)
    {
        Catagory::newCatagory($request);
        return back()->with('success', 'Product has been saved successfully!');
    }
    public function edit($id)
    {
        return view('admin.catagory.edit', ['catagory' => Catagory::find($id)]);
    }
    public function update(Request $request, $id)
    {
        Catagory::UpdateCatagory($request, $id);
        return redirect('/catagory-manage')->with('message', 'Catagory Info Updated');
    }
    public function delete($id)
    {
        Catagory::deleteCatagory($id);
        return redirect('/catagory-manage')->with('message', 'Catagory Info Deleted');
    }

}
