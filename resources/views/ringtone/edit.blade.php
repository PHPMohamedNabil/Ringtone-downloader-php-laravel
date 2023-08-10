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
                    <a href="{{route('ringtone.index')}}">Ringtones</a> </span>/ {{$ringtone->title}}
              
                </div>

                <div class="card-body">
                    <form action="{{route('ringtone.update',$ringtone->id)}}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PUT')
                        
                        
                        <div class="form-group">
                            <label>Title</label>
                           @error('title')
                                    <span class="invalid-feedback d-block d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <input type="text" name="title" class="form-control  @error('title') is-invalid @enderror" value="{{$ringtone->title}}"/>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            @error('description')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{$ringtone->description}}</textarea>
                        </div>
                        <div class="form-group mt-3">

                            <label>File</label>
                            <audio src="{{asset('audio')}}/{{$ringtone->file}}" controls>your broser does not support HTML5</audio>
                            @error('file')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" accept="audio/*"/>
                        </div>
                        <div class="form-group mt-3">
                            <label>Choose Category</label>
                            @error('category_id')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                <option value="">-select Category</option>
                                @foreach($categories as $category)
                                  <option value="{{$category->id}}" @if($category->id == $ringtone->category_id)selected="" @endif >{{$category->name}}</option>
                                @endforeach
                            </select>
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
