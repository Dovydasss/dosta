@extends('layout.admin')

@section('content')
<div class="container mt-5">
    <h1>Create Page</h1>

    <form method="POST" action="{{ route('pages.store') }}" class="mt-4 bg-white p-4 border rounded shadow-sm">
        @csrf
        <div class="form-group">
            <label for="title" class="mb-2">Title:</label>
            <input type="text" class="form-control p-2" name="title" id="title" required placeholder="Enter title here">
        </div>

        <div class="form-group">
            <label for="slug" class="mb-2">Slug:</label>
            <input type="text" class="form-control p-2" name="slug" id="slug" required placeholder="Enter slug here">
        </div>

        <div class="form-group">
            <label for="content" class="mb-2">Content:</label>
            <textarea class="form-control p-2" id="content" name="content" rows="5" placeholder="Enter content here">{{ old('content') }}</textarea>
        </div>

        <div class="form-group form-check pl-0">
            <input type="checkbox" class="form-check-input" name="published" id="published">
            <label class="form-check-label" for="published">Published</label>
        </div>

        {{-- Checkbox for is_blog --}}
        <div class="form-group form-check pl-0">
            <input type="checkbox" class="form-check-input" name="is_blog" id="is_blog">
            <label class="form-check-label" for="is_blog">This is a blog page</label>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Create Page</button>
    </form>
</div>
@endsection
