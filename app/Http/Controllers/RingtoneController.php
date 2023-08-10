<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RingtoneRequest;
use App\Http\Requests\RingtoneUpdateRequest;
use App\Models\Category;
use App\Models\Ringtone;
use Illuminate\Support\Str;

class RingtoneController extends Controller
{   


    public function __construct()
    {
    
        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ringtone.index',['ringtones'=>Ringtone::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ringtone.create',['categories'=>Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RingtoneRequest $request)
    {
       // return dd($request->all());

        return $this->addRingTone($request);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       return view('ringtone.edit',['ringtone'=>Ringtone::find($id),'categories'=>Category::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RingtoneUpdateRequest $request, $id)
    {
        return $this->updateRingTone($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->deleteRingtone($id);  
    }

    public function addRingTone($request)
    {
        $filename= $request->file->hashName();
        $format  = $request->file->getClientOriginalExtension();
        $size    = $request->file->getSize();
        $request->file->move(public_path('audio'),$filename);

        $ringtone = new Ringtone;
        $ringtone->title       = $request->title;
        $ringtone->description = $request->description;
        $ringtone->file        = $filename;
        $ringtone->slug        = Str::slug($request->title);
        $ringtone->category_id = $request->category_id;
        $ringtone->format      = $format;
        $ringtone->size        = $size;
        
        $ringtone->save();

          return redirect()->route('ringtone.create')->with('msg','Ringtone Created Successfully');
    }

    public function updateRingTone(RingtoneUpdateRequest $request,$id)
    {

        $ringtone = Ringtone::find($id);
         
        // return dd(explode('.',$ringtone->format));
        $filename= ($request->has('file'))?$request->file->hashName():$ringtone->file;
        $format  = ($request->has('file'))?$request->file->getClientOriginalExtension():$ringtone->format;
        $size    = ($request->has('file'))?$request->file->getSize():$ringtone->size;
        $download = ($request->has('file'))?0:$ringtone->download;
        
        if($request->has('file'))
        {
            $request->file->move(public_path('audio'),$filename);
            if(file_exists(public_path('/audio/'.$ringtone->file)))
            {
                unlink(public_path('/audio/'.$ringtone->file));
            }
        }
      
        
        Ringtone::where('id', $id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'slug' => Str::slug($request->title),
            'category_id' => $request->category_id,
            'format' => $format,
            'size'   =>$size,
            'file'   =>$filename,
            'download'=>$download 
    ]);


          return redirect()->route('ringtone.edit',$id)->with('msg','Ringtone Data Updated Successfully');
    }

    public function deleteRingTone($id)
    {
        $ringtone = Ringtone::findorFail($id);

          if(file_exists(public_path('/audio/'.$ringtone->file)))
          {
              unlink(public_path('/audio/'.$ringtone->file));
             
              
          }
           $ringtone->delete();

          return redirect()->route('ringtone.index')->with('msg','Ringtone Deleted');
    }
}
