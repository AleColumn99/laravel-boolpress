@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>
    <h5>
        @if($post->category)
            Categoria: {{ $post->category }}
        @else
            Nessuna categoria
        @endif
    </h5>
    <p>{{ $post->content }}</p>
    <div>
        <a class="btn btn-info" href="{{ route('admin.posts.edit', $post) }}">EDIT</a>
    </div>

</div>
@endsection
