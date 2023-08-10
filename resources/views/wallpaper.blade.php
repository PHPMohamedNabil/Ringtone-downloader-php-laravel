@extends('layouts.app')

@section('content')
<div class="container">
     @foreach($photos as $photo)
    <div class="row justify-content-center">
        <div class="col-md-8">
         
            <div class="card mb-4">
                <div class="card-header">{{$photo->title }}</div>

                <div class="card-body">
                  <p>{{$photo->description}}</p>
                  <p>
                        <img src="{{asset('uploads')}}/{{$photo->file}}" class="thumbnail"  class="img-thumbnail img-responsive"/>
                  </p>
                </div>
            </div>
          
        </div>
        <div class="col-md-4">
            <p>
             <form action="{{route('donwload1',$photo->id)}}" method="post">
                <button type="submit" class="btn btn-primary">Download 800*600</button>
                @csrf
             </form>
           </p>
           <p>
             <form action="{{route('donwload2',$photo->id)}}" method="post">
                <button type="submit" class="btn btn-primary">Download 1280*1024</button>
                 @csrf
             </form>
           </p>
            <p>
             <form action="{{route('donwload3',$photo->id)}}" method="post">
                <button type="submit" class="btn btn-primary">Download 316*255</button>
                 @csrf
             </form>
           </p>
            <p>
             <form action="{{route('donwload4',$photo->id)}}" method="post">
                <button type="submit" class="btn btn-primary">Download 118*95</button>
                 @csrf
             </form>
           </p>

        </div>
    
        {{$photos->links()}}
    </div>
   @endforeach
</div>

<script type="text/javascript">
    
    function pauseOthers(element)
    {
        $("audio").not(element).each((index,audio)=>{
                 audio.pause();
        });
    }
</script>
@endsection
