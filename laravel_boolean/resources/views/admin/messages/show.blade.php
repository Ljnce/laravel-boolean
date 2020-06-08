@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="row">
        <div class="col-12">
           <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item " aria-current="page"><a href="{{route('admin.messages.index')}}">Messages</a></li>
            <li class="breadcrumb-item active" aria-current="page">Utente{{$message->id}}</li>
            </ol>
          </nav>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <h5>Messaggio inviato da{{$message->email}}</h5>
        </div>
    </div>
      <div class="row">
        <div class="col-12">
          <h2>{{$message->message}}</h2>
        </div>
    </div>
    </div>

@endsection
