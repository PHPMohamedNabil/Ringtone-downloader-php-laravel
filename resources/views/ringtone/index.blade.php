@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
           <div class="card">
  	         <div class="card-header">
  		          Ringtones
  		          <sapn class="float-right">
  		          	<a href="{{route('ringtone.create')}}"><button  class="btn btn-primary">Create Ringtone</button></a>
  		          </sapn>
  	         </div>
  	         <div class="card-body">
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
                   	@foreach($ringtones as $rington)
                     <tr>
                       <th scope="row">{{$rington->id}}</th>
                       <td>{{$rington->title}}</td>
                       <td>{{substr($rington->description,0,100)}}...</td>
                       <td>
                       	 <audio src="{{asset('audio')}}/{{$rington->file}}" controls onplay="return pauseOthers(this);">your broser does not support HTML5</audio>
                       </td>
                       <td>{{round($rington->size/1000,1)}} KB</td>
                       <td>{{$rington->download}}</td>
                       <td>
                       	<a href="{{route('ringtone.edit',$rington->id)}}" class="btn btn-outline-primary btn-sm">Edit</a>&nbsp;&nbsp;
                       	<form action="{{route('ringtone.destroy',$rington->id)}}" method="post" class="d-inline" onsubmit="return del();">
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