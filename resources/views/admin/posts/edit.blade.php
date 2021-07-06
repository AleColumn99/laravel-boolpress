@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifica:
        <a href="{{ route('admin.posts.show', $post) }}">{{ $post->title }}</a> </h1>
    <div>
        <form action="{{ route('admin.posts.update',$post) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label class="label-control" for="title">Titolo</label>
                <input type="text" id="title" name="title" value="{{ $post->title }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="label-control" for="content">Content</label>
                <textarea type="text" id="content" name="content" class="form-control" rows="5" >{{ $post->content }}</textarea>
            </div>

            <div class="mb-3">
                <label class="label-control" for="category_id">Categoria</label>
                <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                    <option value=""> Selezionare una categoria </option>
                    @foreach($categories as $category)
                        <option @if(old('category_id', $post->category_id) == $category->id) selected @endif value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <h5>Tag</h5>
                @foreach($tags as $tag)
                    <span class="d-inline-block mr-3">
                        <input type="checkbox"
                            id="tag{{ $loop->iteration }}"
                            name="tags[]"
                            value="{{ $tag->id }}"
                            @if ($errors->any() && in_array($tag->id, old('tags',[])))
                                checked
                            @elseif (!$errors->any() && $post->tags->contains($tag->id))
                                checked
                            @endif
                        >
                        <label for="tag{{ $loop->iteration }}">{{ $tag->name }}</label>
                    </span>
                @endforeach
                @error('tags')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button class="btn btn-primary" type="submit">Invio</button>
            </div>

        </form>
    </div>


</div>
@endsection
