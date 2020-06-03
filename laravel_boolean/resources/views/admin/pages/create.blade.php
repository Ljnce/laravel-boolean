{{-- @php
    $categories = [
        [
            'id' => 1,
            'name' => 'Adventure'
        ],
        [
            'id' => 2,
            'name' => 'Horror'
        ],
        [
            'id' => 3,
            'name' => 'Sport'
        ],
        [
            'id' => 4,
            'name' => 'Triller'
        ],
        [
            'id' => 5,
            'name' => 'Funny'
        ]
    ];

    $tags = [
        [
            'id' => 1,
            'name' => 'Primo'
        ],
        [
            'id' => 2,
            'name' => 'Secondo'
        ],
        [
            'id' => 3,
            'name' => 'Terzo'
        ],
        [
            'id' => 4,
            'name' => 'Quarto'
        ],
        [
            'id' => 5,
            'name' => 'Quinto'
        ]
    ];

    $photos = [
        [
            'id' => 1,
            'path' => 'Primo'
        ],
        [
            'id' => 2,
            'path' => 'Secondo'
        ],
        [
            'id' => 3,
            'path' => 'Terzo'
        ],
        [
            'id' => 4,
            'path' => 'Quarto'
        ],
        [
            'id' => 5,
            'path' => 'Quinto'
        ]
    ];
@endphp --}}

@extends('layouts.app')
@section('content')
    <div class="offset-1 col-10">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.pages.index')}}">Posts</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
        </nav>
        <form class="" action="{{route('admin.pages.store')}}"  method="post">
            @csrf
            @method('POST')
        <form>
        {{-- TITLE --}}
        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="customSwitches" name="visible">
                <label class="custom-control-label" for="customSwitches">Visible</label>
            </div>
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text"  class="form-control" name="title" id="title" placeholder="Enter Title" value="{{old('title')}}">
            @error('title')
                <span class='alert alert-danger'>
                    {{$message}}
                </span>
            @enderror
        </div>
        {{-- BODY --}}
        <div class="form-group">
                <label for="body">Body</label>
                <textarea type="text"  class="form-control" name="body" id="body" rows="10" placeholder="Enter Body" >{{old('body')}}</textarea>
            @error('body')
                <span class='alert alert-danger'>
                    {{$message}}
                </span>
            @enderror
        </div>
        {{-- CATEGORY --}}
        <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" class="custom-select">
            @foreach ($categories as $category)
                <option value="{{$category['id']}}"
                {{(!empty(old('category'))) ? 'selected' : ''}}>
                {{$category['name']}}</option>
            @endforeach
            @error('category')
                <span class='alert alert-danger'>
                    {{$message}}
                </span>
            @enderror
        </div>
        {{-- TAGS --}}
            <div class="form-check">
                <label for="tags">Tags</label>
                @foreach ($tags as $tag)
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="tag{{$tag->id}}">{{$tag->name}}</label>
                    <input class="form-check-input"  type="checkbox" name="tags[]" id="tag{{$tag->id}}" value="{{$tag->id}}"
                     {{ (is_array(old('tags')) && in_array($tag->id, old('tags'))) ? 'checked' : ''}}>
                </div>
                @endforeach
                @error('tags')
                    <span class='alert alert-danger'>
                        {{$message}}
                    </span>
                @enderror
            </div>
        {{-- PHOTOS --}}
        <div class="form-check">
            <label for="photos">Photos</label>
            @foreach ($photos as $photo)
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="photo{{$photo->id}}">{{$photo->path}}</label>
                <input class="form-check-input"  type="checkbox" name="photos[]" id="photo{{$photo->id}}" value="{{$photo->id}}">
                 {{ (is_array(old('photos')) && in_array($photo->id, old('photos'))) ? 'checked' : ''}}>
            </div>
            @endforeach
            @error('photos')
                <span class='alert alert-danger'>
                    {{$message}}
                </span>
            @enderror
        </div>
        {{-- PHOTOS UPLOAD --}}
        {{-- <div class="form-group">
            <h3>Photos</h3>
            <label for="photo">Choose a Photo</label>
            <input type="file" name="photo" id="photo">
            @error('photos')
                <span class='alert alert-danger'>
                    {{$message}}
                </span>
            @enderror
        </div> --}}
        <button type="submit" class="btn btn-dark">Invia</button>
    </div>
@endsection
