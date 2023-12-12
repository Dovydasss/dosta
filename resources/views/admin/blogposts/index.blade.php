@extends('layout.admin')

@section('content')
<div class="container mt-4">
    <h1>Blog Posts</h1>
    <a href="{{ route('blogposts.create') }}" class="btn btn-primary">Create New Post</a>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($blogPosts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>
                    <a href="{{ route('blogposts.edit', $post) }}" class="btn btn-info">Edit</a>


                   <form action="{{ route('blogposts.destroy', $post) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection