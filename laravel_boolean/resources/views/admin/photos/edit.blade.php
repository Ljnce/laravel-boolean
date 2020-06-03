@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="row">
        <div class="col-12">
           <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{route('admin.photos.index')}}">photos</a></li>
              <li class="breadcrumb-item active" aria-current="page">edit</li>
            </ol>
          </nav>
        </div>
      </div>
      <div class="row">
        <div class="col-8">
          <form action="{{route('admin.photos.update', $photo->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
             <div class="form-group">
                <label for="name">Title</label>
                <input type="text" class="form-control" id="name"  placeholder="Inserisci un titolo" name="name" value="{{$photo->name}}">
                @error('name')
                    <span class='alert alert-danger'>
                        {{$message}}
                    </span>
                @enderror
              </div>
             <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description"  placeholder="Inserisci una descrizione"  name="description" value="{{$photo->description}}">
                @error('description')
                    <span class='alert alert-danger'>
                        {{$message}}
                    </span>
                @enderror
              </div>
             <div class="form-group">

                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="inputGroupFile01" name="update-path">
                  <label class="custom-file-label" for="inputGroupFile01">Carica nuova foto</label>
                </div>
                @error('update-path')
                    <span class='alert alert-danger'>
                        {{$message}}
                    </span>
                @enderror
              </div>

               <div class="form-group">
                 <input class="btn btn-primary" type="submit" value="Salva">
               </div>
          </form>
        </div>
        <div class="col-4">
          <img src="{{asset('storage/'. $photo->path)}}" alt="">
        </div>
      </div>
    </div>
@endsection
