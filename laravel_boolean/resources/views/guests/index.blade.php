@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="offset-8 col-3">
            <h3> <a href="{{route('download')}}"> Download this file </a> </h3>
        </div>
    </div>
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
        </div>
        <table class="table">
            <thead>
                <th>Title</th>
                <th>Category</th>
                <th>Tags</th>
                <th colspan="3">Action</th>
            </thead>
            <tbody>
                @foreach ($pages as $key => $page)
                    <tr>
                        <td>{{$page->title}}</td>
                        <td>{{$page->category->name}}</td>
                        @foreach ($page->tags as $key => $tag)
                            <td>{{$tag->name}}</td>
                        @endforeach
                        <td><a class="btn btn-primary" href="{{route('pages.show', $page->id)}}">Visualizza</a></td>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
         {{$pages->links()}}
    </div>
@endsection
