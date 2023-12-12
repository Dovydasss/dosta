@extends('layout.admin')

@section('content')
<div class="container mt-4">
    <h1>Messages</h1>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Title</th>
                <th>Message</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $message)
                <tr>
                    <td>{{ $message->id }}</td>
                    <td>{{ $message->name }}</td>
                    <td><a href="mailto:{{ $message->email }}">{{ $message->email }}</a></td>
                    <td>{{ $message->title }}</td>
                    <td>{{ $message->message }}</td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm">Edit</a>
                        <form action="{{ url('admin/messages', $message->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
