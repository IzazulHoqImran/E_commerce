<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{

    public function index()
    {
        return view('admin.Brand.index');
    }
    public function manage()

    {
        // $catagories=Brand::all();
        // return view ('admin.Brand.manage',compact('catagories'));
        return view('admin.brand.manage', ['brands' => Brand::all()]);
    }
    public function addBrand(Request $request)
    {
        Brand::newBrand($request);
        return back()->with('success', 'Product has been saved successfully!');
    }
    public function edit($id)
    {
        return view('admin.brand.edit', ['brand' => Brand::find($id)]);
    }
    public function update(Request $request, $id)
    {
        Brand::UpdateBrand($request, $id);
        return redirect('/brand-manage')->with('message', 'Brand Info Updated');
    }
    public function delete($id)
    {
        Brand::deleteBrand($id);
        return redirect('/brand-manage')->with('message', 'Brand Info Deleted');
    }

}
