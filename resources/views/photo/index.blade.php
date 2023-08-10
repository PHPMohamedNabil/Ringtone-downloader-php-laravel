@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
           <div class="card">
  	         <div class="card-header">
  		          Photos
  		          <sapn class="float-right">
  		          	<a href="{{route('photo.create')}}"><button  class="btn btn-primary">Uploade Photo</button></a>
  		          </sapn>
  	         </div>
  	         <div class="card-body">
              <div class="table-responsive">
                
                 <table class="table table-hover table-responsive">
                   <thead>
                     <tr>
                       <th scope="col">#</th>
                       <th scope="col">Title</th>
                       <th scope="col">Description</th>
                       <th scope="col">File</th>
                       <th scope="col">Size</th>
                       <th scope="col">Donwloads</th>
                       <th scope="col">Action</th>
                     </tr>
                   </thead>
                   <tbody>
                    @foreach($photos as $photo)
                     <tr>
                       <th scope="row">{{$photo->id}}</th>
                       <td>{{$photo->title}}</td>
                       <td>{{substr($photo->description,0,100)}}...</td>
                       <td>
                        <div class="thumbnail">
                           <img src="{{asset('uploads')}}/{{$photo->file}}" class="thumbnail"  class="img-thumbnail img-responsive" height="90"/>
                        </div>
                        
                       </td>
                       <td>{{round($photo->size/1000,1)}} KB</td>
                       <td>{{$photo->download}}</td>
                       <td>
                        <a href="{{route('photo.edit',$photo->id)}}" class="btn btn-outline-primary btn-sm">Edit</a>&nbsp;&nbsp;
                        <form action="{{route('photo.destroy',$photo->id)}}" method="post" class="d-inline" onsubmit="return del();">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-outline-danger btn-sm" type="submit">Delete</button>
                        </form>
                       </td>
                      </tr>
                    @endforeach
                   </tbody>
                 </table>
              </div>
  	         </div>
           </div>
      </div>
   </div>
</div>


@endsection
@section('js')
<script type="text/javascript">
	function del()
	{
		if(confirm('are you sure you want to delete this data ?'))
		{
			return true;
		}
		return false;
	}

	function pauseOthers(element)
	{
		$("audio").not(element).each((index,audio)=>{
                 audio.pause();
		});
	}

</script>
@endsection