@php
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
@endphp

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
        {{-- <form class="" action="{{route('admin.pages.store')}}" enctype='multipart/form-data' method="post">
            @csrf
            @method('POST')
        <form> --}}
        {{-- TITLE --}}
        <div class="form-group">
                <label for="title">Title</label>
                <input type="text"  class="form-control" name="title" id="title" placeholder="Enter Title">
            @error('title')
                <span class='alert alert-danger'>
                    {{$message}}
                </span>
            @enderror
        </div>
        {{-- BODY --}}
        <div class="form-group">
                <label for="body">Body</label>
                <textarea type="text"  class="form-control" name="body" id="body" rows="10" placeholder="Enter Body"></textarea>
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
                <option value="{{$category['id']}}">{{$category['name']}}</option>
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
                    <input class="form-check-input"  type="checkbox" name="tags[]" id="tag{{$tag['id']}}" value="{{$tag['id']}}">
                    <label class="form-check-label" for="tag{{$tag['id']}}">{{$tag['name']}}</label>
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
            <label for="photos">Tags</label>
            @foreach ($photos as $photo)
            <div class="form-check form-check-inline">
                <input class="form-check-input"  type="checkbox" name="photos[]" id="tag{{$photo['id']}}" value="{{$photo['id']}}">
                <label class="form-check-label" for="tag{{$photo['id']}}">{{$photo['path']}}</label>
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
