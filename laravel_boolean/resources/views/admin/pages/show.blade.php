@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="row">
        <div class="col-12">
           <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item " aria-current="page"><a href="{{route('admin.pages.index')}}">Pages</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$page->title}}</li>
            </ol>
          </nav>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <h2>{{$page->title}}</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-8">
          {!! $page->body !!}
        </div>
        <div class="col-4">
          @foreach ($page->photos as $photo)
          <img src="{{asset('storage/'  . $photo->path)}}" alt="{{$photo->name}}">
          @endforeach
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          @foreach ($page->tags as $tag)
              #{{$tag->name}}
              @if (!$loop->last)
                  ,
              @endif
          @endforeach
        </div>
      </div>
    </div>

@endsection
