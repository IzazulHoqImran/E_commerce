<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyEcommerce extends Controller
{
    public function index()
    {
        return view('website.home.index');
    }
    public function catagory()
    {
        return view('website.catagory.index');
    }
    public function detail()
    {
        return view('website.detail.index');
    }
}
