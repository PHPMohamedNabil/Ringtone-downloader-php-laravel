@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h1>{{$category_name}}</h1>

        <div class="col-md-8">
       @if(count($ringtones))
          @foreach($ringtones as $ringtone)
            <div class="card" style="margin-top: 48px;">
                <div class="card-header">{{$ringtone->title }}</div>
s
                <div class="card-body">
                   <audio src="{{asset('audio')}}/{{$ringtone->file}}" controls onplay="return pauseOthers(this);" controlsList="nodownload">your broser does not support HTML5</audio>
                </div>
                <div class="card-footer">
                    <a href="{{route('ringtone_one',[$ringtone->id,$ringtone->slug])}}">Info and Download</a>
                </div>
            </div>
          @endforeach
        @else
          <p class="text-center display-4">Still No ringtones added till now  to this category will be soon .</p><span class="bold"><a href="{{asset('')}}">Explore More Ringtones</a></span>
        @endif
        </div>
        <div class="col-md-4">
          <div class="card">
              <div class="card-header">
                  Categories
              </div>
            @foreach($categories as $category)
                <div class="card-header" style="background-color:#eaeaea;">
                    <a href="{{route('ring_category',$category->id)}}" class="@if($category->id == $catid) active @endif">{{$category->name}}</a>
                </div>
            @endforeach
          </div>
        </div>
        {{$ringtones->links()}}
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
