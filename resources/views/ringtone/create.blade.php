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
                <div class="card-header">Create Ringtone</div>

                <div class="card-body">
                    <form action="{{route('ringtone.store')}}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Title</label>
                            @error('title')

                                    <span class="text-danger" role="alert">
                                        <strong c>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" />
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            @error('description')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror"></textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label>File</label>
                            @error('file')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" accept="audio/*"/>
                        </div>
                        <div class="form-group mt-3">
                            <label>Choose Category</label>
                            @error('category_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                <option value="">-select Category</option>
                                @foreach($categories as $category)
                                  <option value="{{$category->id}}">{{$category->name}}</option>
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
