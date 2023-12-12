@extends('layout.admin')

@section('content')
<div class="container mt-4">
    <h1>Pages</h1>
    <a href="{{ route('pages.create') }}" class="btn btn-primary">Create New Page</a>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Title</th>
                <th>Slug</th>

                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pages as $page)
            <tr>
                <td>{{ $page->title }}</td>
                <td>{{$page -> slug}}</td>
                <td>
                    <a href="{{ route('pages.edit', $page) }}" class="btn btn-info">Edit</a>
                    <form action="{{ route('pages.destroy', $page) }}" method="POST" style="display:inline;">
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
