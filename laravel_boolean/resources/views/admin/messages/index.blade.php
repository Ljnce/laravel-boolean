@extends('layouts.app')
@section('content')
    <div class="offset-1 col-10">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
             <li class="breadcrumb-item active" aria-current="page">Pages</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-5">
                <h2>Pages</h2>
            </div>
            <div class="offset-3 col-2">
                <a href="{{route('admin.pages.create')}}">Crea una pagina</a>
            </div>
        </div>
        <table class="table">
            <thead>
                <th>ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>Tags</th>
                <th colspan="3">Action</th>
            </thead>
            <tbody>

                @foreach ($messages as $key => $message)

                    <tr>
                        <td>{{$message->id}}</td>
                        <td>{{$message->email}}</td>
                        <td>{{$message->created_at}}</td>
                        <td><a class="btn btn-primary" href="{{route('admin.messages.show', $message->id)}}">Visualizza</a></td>
                        </td>

                    </tr>
        
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
