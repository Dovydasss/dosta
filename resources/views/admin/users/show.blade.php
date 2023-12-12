@extends('layout.admin')

@section('title', 'Users')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <a href="{{ url('/admin/users/'.$user->id.'/edit') }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit User
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $user->id }}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>E-mail</th>
                            <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>{{ implode(', ', $user->roles->pluck('name')->toArray()) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
