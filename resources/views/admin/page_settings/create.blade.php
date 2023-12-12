@extends('layout.admin')

@section('content')
<div class="container mt-4">

    <h1>Create New Page Settings</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.page-settings.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
        @csrf

        {{-- Title Field --}}
        <div class="mb-3">
            <label for="title">Page Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
        </div>

        {{-- Icon Upload Field --}}
        <div class="mb-3">
            <label for="icon">Page Icon:</label>
            <input type="file" class="form-control-file" id="icon" name="icon">
        </div>

        {{-- Description Field --}}
        <div class="mb-3">
            <label for="description">Page Description:</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
        </div>

        {{-- Submit Button --}}
        <button type="submit" class="btn btn-primary">Create Settings</button>
    </form>

</div>
@endsection
