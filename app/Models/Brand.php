<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    private static $brand,$cimage,$cimageExtention,$cimageName,$brandimage;

    public static function getImageUrl($request)
    {
        self::$cimage               = $request->file('image');
        self::$cimageExtention      = $request->image->getClientOriginalExtension();
        self::$cimageName           = 'pp' . time() . '.' . self::$cimageExtention;
        self::$cimage->             move(public_path('brandimages'), self::$cimageName);
        self::$brandimage        = 'brand-images/' . self::$cimageName;
        return self::$brandimage;
    }
    public static function newBrand($request)
    {


        self:: $brand= new Brand();

        self:: $brand->id = $request->id;
        self:: $brand->name = $request->name;
        self:: $brand->description = $request->description;
        self:: $brand->image = self::getImageUrl($request);
        self:: $brand->status = $request->status;

        self:: $brand->save();
    }

    public static function updateBrand($request, $id){

        self::$brand = Brand::find($id);
        if($request->file('image'))
        {
            if (file_exists(self::$brand->image))
            {
                unlink(self::$brand->image);
            }
            self::$brandimage = self::getImageUrl($request);
        }
        else {
            self::$brandimage = self::$brand->image;
        }


        self:: $brand->id = $request->id;
        self:: $brand->name = $request->name;
        self:: $brand->description = $request->description;
        self:: $brand->image = self::$brandimage;
        self:: $brand->status = $request->status;

        self:: $brand->save();
    }
    public static function deleteBrand($id){

        self::$brand = Brand::find($id);
        if (file_exists(self::$brand->image))
            {
                unlink(self::$brand->image);
            }
            self::$brand->delete();

    }
}
