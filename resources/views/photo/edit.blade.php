@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('msg'))
                <div class="alert alert-success">
                    {{session('msg')}}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <a href="{{route('photo.index')}}">Photos</a> </span>/ {{$photo->title}}
              
                </div>

                <div class="card-body">
                    <form action="{{route('photo.update',$photo->id)}}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PUT')
                        
                        
                        <div class="form-group">
                            <label>Title</label>
                           @error('title')
                                    <span class="invalid-feedback d-block d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <input type="text" name="title" class="form-control  @error('title') is-invalid @enderror" value="{{$photo->title}}"/>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            @error('description')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{$photo->description}}</textarea>
                        </div>
                        <div class="form-group mt-3">

                            <label>File</label>
                        <div class="thumbnail">
                           <img src="{{asset('uploads')}}/{{$photo->file}}" class="thumbnail"  class="img-thumbnail img-responsive" height="90"/>
                        </div>
                            @error('file')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <input type="file" name="image" class="form-control @error('file') is-invalid @enderror" accept="image/*"/>
                        </div>
                        
                        <div class="form-group mt-3">
                            <button class="btn btn-primary">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
