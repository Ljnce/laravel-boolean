
@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="row">
        <div class="col-12">
           <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item " aria-current="page"><a href="{{route('admin.photos.index')}}">Photos</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$photo->name}}</li>
            </ol>
          </nav>
        </div>
      </div>
        <div class="col-4">
            <img src="{{asset('storage/'. $photo->path)}}" alt="{{$photo->name}}">
        </div>
      </div>
    </div>
@endsection
