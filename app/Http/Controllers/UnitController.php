<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;

class UnitController extends Controller
{

    public function index()
    {
        return view('admin.unit.index');
    }
    public function manage()

    {
        // $catagories=Unit::all();
        // return view ('admin.Unit.manage',compact('catagories'));
        return view('admin.unit.manage', ['units' => Unit::all()]);
    }
    public function addUnit(Request $request)
    {
        Unit::newUnit($request);
        return back()->with('success', 'Product has been saved successfully!');
    }
    public function edit($id)
    {
        return view('admin.unit.edit', ['unit' => Unit::find($id)]);
    }
    public function update(Request $request, $id)
    {
        Unit::UpdateUnit($request, $id);
        return redirect('/unit-manage')->with('message', 'Unit Info Updated');
    }
    public function delete($id)
    {
        Unit::deleteUnit($id);
        return redirect('/unit-manage')->with('message', 'Unit Info Deleted');
    }
}
