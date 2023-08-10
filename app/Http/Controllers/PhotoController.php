<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Photo;
use App\Http\Requests\PhotoRequest;
use App\Http\Requests\PhotoUpdateRequest;
use Image;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('photo.index',['photos'=>Photo::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('photo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhotoRequest $request)
    {
        return $this->addPhoto($request);
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
        return view('photo.edit',['photo'=>Photo::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PhotoUpdateRequest $request, $id)
    {
        return $this->updatePhoto($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->deletePhoto($id);
    }

    public function photoResize($photo)
    {

    }

    public function addPhoto($request)
    {
        $image    = $request->file('image');
        $filename = $image->hashName();

        $format   = $request->image->getClientOriginalExtension();

        $size    = $request->image->getSize();
    
        //$request->image->move(public_path('uploads/'),$filename);

        $path     = 'uploads/'.$filename;
        $path1    = 'uploads/1280_1024/'.$filename;
        $path2    = 'uploads/316_255/'.$filename;
        $path3    = 'uploads/118_95/'.$filename;
     // return dd($image);
        Image::make($image->getRealPath())->resize(800,600)->save($path); 
        Image::make($image->getRealPath())->resize(1280,1024)->save($path1);
        sleep(1);
        Image::make($image->getRealPath())->resize(316,255)->save($path2);
        Image::make($image->getRealPath())->resize(118,95)->save($path3);
    

        $photo = new photo;
        $photo->title       = $request->title;
        $photo->description = $request->description;
        $photo->file        = $filename;
        $photo->format      = $format;
        $photo->size         = $size;

        $photo->save();

        return redirect()->route('photo.create')->with('msg','Photo Uploaded Successfully');

    }
    public function updatePhoto($request,$id)
    {
        $photo = Photo::find($id);

         $image    = $request->file('image');
         
        // return dd(explode('.',$photo->format));
        $filename= ($request->has('image'))?$request->image->hashName():$photo->file;
        $format  = ($request->has('image'))?$request->image->getClientOriginalExtension():$photo->format;
        $size    = ($request->has('image'))?$request->image->getSize():$photo->size;
        $download = ($request->has('image'))?0:$photo->download;
        
        if($request->has('image'))
        {
            //$request->file->move(public_path('audio'),$filename);

            $path     = 'uploads/'.$filename;
            $path1    = 'uploads/1280_1024/'.$filename;
            $path2    = 'uploads/316_255/'.$filename;
            $path3    = 'uploads/118_95/'.$filename;

            $this->unlinkPhotoIfExsit($photo,'uploads/');
            $this->unlinkPhotoIfExsit($photo,'uploads/1280_1024/');
            $this->unlinkPhotoIfExsit($photo,'uploads/316_255/');
            $this->unlinkPhotoIfExsit($photo,'uploads/118_95/');
             sleep(1);
            Image::make($image->getRealPath())->resize(800,600)->save($path); 
            Image::make($image->getRealPath())->resize(1280,1024)->save($path1);
            sleep(1);
            Image::make($image->getRealPath())->resize(316,255)->save($path2);
            Image::make($image->getRealPath())->resize(118,95)->save($path3);

            
        }
      
        
        Photo::where('id', $id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'format' => $format,
            'size'   =>$size,
            'file'   =>$filename,
            'download'=>$download 
    ]);


          return redirect()->route('photo.edit',$id)->with('msg','photo Data Updated Successfully');

    }

    public function deletePhoto($id)
    {
        $photo = Photo::findorFail($id);
        
        $photo->delete();

            $this->unlinkPhotoIfExsit($photo,'uploads/');
            $this->unlinkPhotoIfExsit($photo,'uploads/1280_1024/');
            $this->unlinkPhotoIfExsit($photo,'uploads/316_255/');
            $this->unlinkPhotoIfExsit($photo,'uploads/118_95/');

          return redirect()->route('photo.index')->with('msg','photo data Deleted');
    }

    public function unlinkPhotoIfExsit($photo,$path)
    {
        if(file_exists(public_path($path.$photo->file)))
        {
             return  unlink(public_path($path.$photo->file));
        }
        return false;
    }
}
