<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Ringtone;
class FrontEndController extends Controller
{
    //

    public function index()
    {
      return view('ringtone',[
        'ringtones'=>Ringtone::paginate(10),
        'categories'=>Category::all()
      ]);
    }

    public function oneRingtone($id,$slug)
    {
        $ringtone = Ringtone::where('id',$id)->where('slug',$slug)->get(); 

        if(!count($ringtone))
        {
            return abort(404);
        }
        return view('ringtone_one',['ringtone'=>$ringtone,'categories'=>Category::all()]);
    }

    public function downloadRington($id)
    {
        $ringtone = Ringtone::findorFail($id);
        $filePath = public_path('audio/').$ringtone->file;

        $ringtone->increment('download');
        $ringtone->save();

        return response()->download($filePath);
    }

    public function ringtonesByCategory($id)
    {
        $ringtones = Ringtone::where('category_id',$id)->paginate(10); 
          
        return view('ringtone_cats',['ringtones'=>$ringtones,'category_name'=>Category::where('id',$id)->get()[0]->name,'categories'=>Category::all(),'catid'=>$id]);
    }
}
