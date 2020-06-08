@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="row">
        <div class="col-12">
           <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item " aria-current="page"><a href="{{route('pages.index')}}">Pages</a></li>
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
          <img width="300" height="200" src="{{asset('storage/'  . $photo->path)}}" alt="{{$photo->name}}">
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
      <div class="row">
        <div class="col-12">
            <form class="" action="{{route('admin.messages.store')}}"  method="post">
                @csrf
                @method('POST')
            <form>
                <div class="form-group">
                    <label for="email">email</label>
                    <input type="text"  class="form-control" name="email" id="email" placeholder="Enter Title" value="@if (!empty(old('email'))) {{old('email')}} @elseif (Auth::check()) {{Auth::user()->email}} @else  @endif">
                    @error('email')
                        <span class='alert alert-danger'>
                            {{$message}}
                        </span>
                    @enderror
                </div>
                {{-- BODY --}}
                <div class="form-group">
                        <label for="message">Message</label>
                        <textarea type="text"  class="form-control" name="message" id="message" rows="10" placeholder="Enter Body" >{{old('message')}}</textarea>
                    @error('message')
                        <span class='alert alert-danger'>
                            {{$message}}
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-dark">Invia</button>
                </div>
        </div>
      </div>
    </div>

@endsection
