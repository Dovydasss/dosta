@extends('layout.admin')

@section('content')
<div class="container mt-4">
    <h1>Edit Page: {{ $page->title }}</h1>

    <form method="POST" action="{{ route('pages.update', $page) }}" class="mt-4">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ $page->title }}" required>
        </div>

        <div class="form-group">
            <label for="slug">Slug:</label>
            <input type="text" class="form-control" name="slug" id="slug" value="{{ $page->slug }}" required>
        </div>

        <div class="form-group">
            <label for="content">Content:</label>
            <textarea class="form-control" name="content" id="content" rows="5" required>{{ $page->content }}</textarea>
        </div>

        <div class="form-group form-check pl-0">
            <input type="checkbox" class="form-check-input" name="is_blog" id="is_blog">
            <label class="form-check-label" for="is_blog">This is a blog page</label>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="published" id="published" {{ $page->published ? 'checked' : '' }}>
            <label class="form-check-label" for="published">Published</label>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
