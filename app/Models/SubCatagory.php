<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SubCatagory extends Model
{
    use HasFactory;



    private static $subCatagory,$cimage,$cimageExtention,$cimageName,$catagoryImage;

    public static function getImageUrl($request)
    {
        self::$cimage       = $request->file('image');
        self::$cimageExtention    = $request->image->getClientOriginalExtension();
        self::$cimageName = 'pp' . time() . '.' . self::$cimageExtention;
        self::$cimage->move(public_path('Subcatagory-images'), self::$cimageName);
        self::$catagoryImage      = 'Subcatagory-images/' . self::$cimageName;
        return self::$catagoryImage;
    }
    public static function newSubCatagory($request)
    {


        self:: $subCatagory= new SubCatagory;


        self:: $subCatagory->catagory_id = $request->catagory_id;
        self:: $subCatagory->name =$request->name;
        self:: $subCatagory->description = $request->description;
        self:: $subCatagory->image = self::getImageUrl($request);
        self:: $subCatagory->status = $request->status;

        self:: $subCatagory->save();
    }

    public static function updateSubCatagory($request, $id){

        self::$subCatagory = SubCatagory::find($id);
        if($request->file('image'))
        {
            if (file_exists(self::$subCatagory->image))
            {
                unlink(self::$subCatagory->image);
            }
            self::$catagoryImage = self:: getImageUrl($request);
        }
        else {
            self::$catagoryImage = self::$subCatagory->image;
        }


        self:: $subCatagory->catagory_id = $request->catagory_id;
        self:: $subCatagory->name = $request->name;
        self:: $subCatagory->description = $request->description;
        self:: $subCatagory->image = self::$catagoryImage;
        self:: $subCatagory->status = $request->status;

        self:: $subCatagory->save();
    }
    public static function deleteSubCatagory($id){

        self::$subCatagory = SubCatagory::find($id);
        if (file_exists(self::$subCatagory->image))
            {
                unlink(self::$subCatagory->image);
            }
            self::$subCatagory->delete();

    }
    public function catagory()
    {
        return $this->belongsTo(Catagory::class);
    }
}
