{{-- @php
    $pages = [
        [
            'id' => 1,
            'title' => 'Iron man',
            'category' => '2',
            'tags' => [
                1,
                2,
                3
            ]
        ],
        [
            'id' => 2,
            'title' => 'Iron man 2',
            'category' => '6',
            'tags' => [
                1,
                2,
                3
            ]
        ],
        [
            'id' => 3,
            'title' => 'Iron man 3',
            'category' => '5',
            'tags' => [
                1,
                2,
                3
            ]
        ],
        [
            'id' => 4,
            'title' => 'Avengers',
            'category' => '3',
            'tags' => [
                1,
                2,
                3
            ]
        ],
        [
            'id' => 5,
            'title' => 'End game',
            'category' => '6',
            'tags' => [
                1,
                2,
                3
            ],
        ],
    ];
@endphp --}}

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
                @foreach ($pages as $key => $page)
                    <tr>
                        <td>{{$page->id}}</td>
                        <td>{{$page->title}}</td>
                        <td>{{$page->category->name}}</td>
                        @foreach ($page->tags as $key => $tag)
                            <td>{{$tag->name}}</td>
                        @endforeach
                        <td><a class="btn btn-primary" href="{{route('admin.pages.show', $page->id)}}">Visualizza</a></td>
                    @if(Auth::id() == $page->user_id)
                    <td><a class="btn btn-secondary" href="{{route('admin.pages.edit', $page->id)}}">Modifica</a></td>
                     @endif
                    <td>
                        @if(Auth::id() == $page->user_id)
                      <form action="{{route('admin.pages.destroy', $page->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input class="btn btn-danger" type="submit" value="Elimina">
                      </form>
                  @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
