@extends('layout.admin')

@section('content')
<div class="container mt-4">
    <h1>Roles</h1>
    <a href="{{ url('admin/roles/create') }}" class="btn btn-primary">
       Add Role
    </a>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    <a href="{{ url('admin/roles/'.$role->id.'/edit') }}" class="btn btn-info btn-sm">
                        Edit
                    </a>
                    <a href="{{ url('admin/roles/'.$role->id) }}" class="btn btn-success btn-sm">
                         View
                    </a>
                    <form action="{{ url('admin/roles', $role->id) }}" method="POST" style="display:inline;">
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
