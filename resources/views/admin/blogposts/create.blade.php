@extends('layout.admin')

@section('content')
<div class="container mt-5">
    <h1>Create Blog Post</h1>

    <form method="POST" action="{{ route('blogposts.store') }}" class="mt-4 bg-white p-4 border rounded shadow-sm">
        @csrf
        <div class="form-group">
            <label for="title" class="mb-2">Title:</label>
            <input type="text" class="form-control p-2" name="title" id="title" required placeholder="Enter title here">
        </div>

        <div class="form-group">
            <label for="content" class="mb-2">Content:</label>
            <textarea class="form-control" name="content" id="content" rows="5" placeholder="Enter content here"></textarea>
        </div>

        <div class="form-group">
    <label for="page_id" class="mb-2">Page:</label>
    <select name="page_id" id="page_id" class="form-control p-2" required>
        @foreach ($pages->where('is_blog', 1) as $page)
            <option value="{{ $page->id }}">{{ $page->title }}</option>
        @endforeach
    </select>
</div>


        

        <button type="submit" class="btn btn-primary btn-block">Create Post</button>
    </form>
</div>
@endsection
