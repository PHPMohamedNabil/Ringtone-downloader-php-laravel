@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-md-12">
                <h2>   Download Alert Sounds & Wallpapers for free</h2>
                <p>

Here are the sounds that have been tagged with Alert free from SoundBible.com Please bookmark us Ctrl+D and come back soon for updates!

All files are available in both Wav and MP3 formats
                </p>
            </div>
        </div>
        <div class="col-md-8">
          @foreach($ringtones as $ringtone)
            <div class="card" style="margin-top: 48px;">
                <div class="card-header">{{$ringtone->title }}</div>

                <div class="card-body">
                   <audio src="{{asset('audio')}}/{{$ringtone->file}}" controls onplay="return pauseOthers(this);" controlsList="nodownload">your broser does not support HTML5</audio>
                </div>
                <div class="card-footer">
                    <a href="{{route('ringtone_one',[$ringtone->id,$ringtone->slug])}}">Info and Download</a>
                </div>
            </div>
          @endforeach
        </div>
        <div class="col-md-4">
          <div class="card">
              <div class="card-header">
                  Categories
              </div>
            @foreach($categories as $category)
                <div class="card-header" style="background-color:#eaeaea;">
                    <a href="{{route('ring_category',$category->id)}}">{{$category->name}}</a>
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
