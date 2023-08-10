@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          @foreach($ringtone as $ring)
            <div class="card" style="margin-top: 48px;">
                <div class="card-header">{{$ring->title }}</div>
              
                <div class="card-body">
                   <audio src="{{asset('audio')}}/{{$ring->file}}" controls onplay="return pauseOthers(this);" controlsList="nodownload">your broser does not support HTML5</audio>
                </div>
                <div class="card-footer">
                    
                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <div class="addthis_inline_share_toolbox"></div>
            
                    <form action="{{route('ringtone_download',$ring->id)}}" method="post"> 
                        @csrf
                    <button type="submit" class="btn btn-secondary">
                        Download
                    </button>
                    </form>
                </div>
            </div>
            <table class="table table-hover table-responsive">
                <tr>
                    <th>Name</th>
                    <td>{{$ring->title}}</td>
                  </tr>
                   <tr>
                    <th>Description</th>
                    <td>{{$ring->description}}</td>
                 </tr>
                    <tr>
                    <th>Format</th>
                    <td>{{$ring->format}}</td>
                </tr>
                       <tr>
                    <th>Size</th>
                    <td>{{round($ring->size,2)/1000}} Kb</td>
                </tr>
                       <tr>
                    <th>Category</th>
                    <td>{{$ring->category->name}}</td>
                </tr>
                       <tr>
                    <th>Download</th>
                    <td>{{$ring->download}}</td>
                </tr>
              
            </table>
          @endforeach

        </div>
        <div class="col-md-4">
          <div class="card">
              <div class="card-header">
                  Categories
              </div>
            @foreach($categories as $category)
                <div class="card-header" style="background-color:#eaeaea;">
                    <a href="{{route('ring_category',$category->id)}}" class="">{{$category->name}}</a>
                </div>
            @endforeach
          </div>
        </div>
       
    </div>
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
