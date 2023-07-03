<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catagory extends Model
{
    use HasFactory;

    private static $catagory,$cimage,$cimageExtention,$cimageName,$catagoryImage;

    public static function getImageUrl($request)
    {
        self::$cimage       = $request->file('image');
        self::$cimageExtention    = $request->image->getClientOriginalExtension();
        self::$cimageName = 'pp' . time() . '.' . self::$cimageExtention;
        self::$cimage->move(public_path('catagory-images'), self::$cimageName);
        self::$catagoryImage      = 'catagory-images/' . self::$cimageName;
        return self::$catagoryImage;
    }
    public static function newCatagory($request)
    {


        self:: $catagory= new Catagory;

        self:: $catagory->id = $request->id;
        self:: $catagory->name = $request->name;
        self:: $catagory->description = $request->description;
        self:: $catagory->image = self::getImageUrl($request);
        self:: $catagory->status = $request->status;

        self:: $catagory->save();
    }

    public static function updateCatagory($request, $id){

        self::$catagory = Catagory::find($id);
        if($request->file('image'))
        {
            if (file_exists(self::$catagory->image))
            {
                unlink(self::$catagory->image);
            }
            self::$catagoryImage = self::getImageUrl($request);
        }
        else {
            self::$catagoryImage = self::$catagory->image;
        }


        self:: $catagory->id = $request->id;
        self:: $catagory->name = $request->name;
        self:: $catagory->description = $request->description;
        self:: $catagory->image = self::$catagoryImage;
        self:: $catagory->status = $request->status;

        self:: $catagory->save();
    }
    public static function deleteCatagory($id){

        self::$catagory = Catagory::find($id);
        if (file_exists(self::$catagory->image))
            {
                unlink(self::$catagory->image);
            }
            self::$catagory->delete();

    }

}
