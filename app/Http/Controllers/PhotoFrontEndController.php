<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\photo;
class PhotoFrontEndController extends Controller
{
    //

    public function index()
    {
      return view('wallpaper',[
        'photos'=>Photo::latest()->paginate(10),
      ]);
    }

    public function onephoto($id)
    {
        $photo = Photo::where('id',$id); 

        if(!count($photo))
        {
            return abort(404);
        }
        return view('photo_one',['photo'=>$photo]);
    }

    public function downloadPhoto($id)
    {
        $photo = Photo::findorFail($id);
        $filePath = public_path('audio/').$photo->file;

        $photo->increment('download');
        $photo->save();

        return response()->download($filePath);
    }

    public function download_800_600($id)
    {
        $photo= Photo::findorFail($id);

        return response()->download(public_path('uploads/').$photo->file);
    }

    public function download_1280_1024($id)
    {
        $photo= Photo::findorFail($id);

        return response()->download(public_path('uploads/1280_1024/').$photo->file);
    }

    public function download_316_255($id)
    {
        $photo= Photo::findorFail($id);

        return response()->download(public_path('uploads/316_255/').$photo->file);
        
    }

    public function download_118_95($id)
    {
        $photo= Photo::findorFail($id);

        return response()->download(public_path('uploads/118_95/').$photo->file);
    }


    
}
