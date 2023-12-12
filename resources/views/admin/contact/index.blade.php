@extends('layout.admin')

@section('content')
<div class="container mt-4">
    <h2>Contact Settings</h2>
    <a href="{{ route('contacts.create') }}" class="btn btn-primary">Add New Contact Setting</a>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Email</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contactSettings as $setting)
            <tr>
                <td>{{ $setting->recipient_email }}</td>
                <td>{{ $setting->recipient_name }}</td>
                <td>{{ $setting->slug }}</td>
                <td>
                    <a href="{{ route('contacts.edit', $setting->id) }}" class="btn btn-info">Edit</a>
                    <form action="{{ route('contacts.destroy', $setting->id) }}" method="POST" style="display:inline;">
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