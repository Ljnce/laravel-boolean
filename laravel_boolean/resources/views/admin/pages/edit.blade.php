{{-- @php
//PROVA CON UNA SOLA PAGE (Create è riferito ad una page, non a più page)
$page = [
        'id' => 1,
        'title' => 'Iron man',
        'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
        'category' => '2',
        'tags' => [
            1,
            2,
            3
        ]
];

    $categorytest = [
        'id' => 1,
        'name' => 'Sport'
    ];

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
        <form class="" action="{{route('admin.pages.update', $page->id)}}" method="post">
            @csrf
            @method('PATCH')
        <form>
        {{-- TITLE --}}
        <div class="form-group">
                <label for="title">Title</label>
                <input type="text"  class="form-control" name="title" id="title" value="{{!empty(old('title')) ? old('title') : $page->title}}">
            @error('title')
                <span class='alert alert-danger'>
                    {{$message}}
                </span>
            @enderror
        </div>
        {{-- BODY --}}
        <div class="form-group">
                <label for="body">Body</label>
                <textarea type="text"  class="form-control" name="body" id="body" rows="10" >{{!empty(old('body')) ? old('body') : $page->body}}</textarea>
            @error('body')
                <span class='alert alert-danger'>
                    {{$message}}
                </span>
            @enderror
        </div>
        {{-- SUMMARY--}}
        <div class="form-group">
                  <label for="summary">Summary</label>
                  <input type="text" class="form-control" id="summary"  placeholder="Inserisci il sommario" name="summary">
                  @error('summary')
                    <small class="form-text">Errore</small>
                  @enderror
                </div>
        {{-- CATEGORY --}}
        <div class="form-group">
                <label for="category">Category</label>
                <select name="category_id" id="category" class="custom-select">
                    {{-- PROVA per old {{}}
                     <option value="{{$categorytest['id']}}"
                    {{!empty(old('category')) ? old('category') : $categorytest['name']}}>
                    {{$categorytest['name']}}</option> --}}
            @foreach ($categories as $category)
                <option value="{{$category->id}}"
                {{!empty(old('category')) ? old('category') : $category->name}}>
                {{$category->name}}</option>
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
                    <input class="form-check-input"  type="checkbox" name="tags[]" id="tag{{$tag->id}}" value="{{$tag->id}}">
                     {{-- {{((is_array(old('tags')) && in_array($tag->id, old('tags')))
                         ||  $page->tags->contains($tag->id)) ? 'checked' : ''}} --}}
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
            <label for="photos">Photo</label>
            @foreach ($photos as $photo)
            <div class="form-check form-check-inline">
                <img width="300" height="200" src="{{asset('storage/'. $photo->path)}}" alt="{{$photo->name}}">
                <label class="form-check-label" for="tag{{$photo->id}}">{{$photo->path}}</label>
                <input class="form-check-input"  type="checkbox" name="photos[]" id="tag{{$photo->id}}" value="{{$photo->id}}">
                {{((is_array(old('photos')) && in_array($tag->id, old('photos')))
                    ||  $page->photos->contains($photo->id)) ? 'checked' : ''}}
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
