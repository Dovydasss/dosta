@extends('layout.admin')

@section('content')
<div class="container mt-4">
    <h1>Users</h1>
    <a href="{{ url('admin/users/create') }}" class="btn btn-primary">
        Add User
    </a>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                    <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
                    <td>
                        <a href="{{ url('admin/users/'.$user->id.'/edit') }}" class="btn btn-info btn-sm">
                           Edit
                        </a>
                        <a href="{{ url('admin/users/'.$user->id) }}" class="btn btn-success btn-sm">
                       View
                        </a>
                        <form action="{{ url('admin/users', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                               Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
