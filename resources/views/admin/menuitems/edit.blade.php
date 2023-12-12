@extends('layout.admin')

@section('content')
<div class="container mt-4">
    <h1>Edit Menu Item: {{ $menuItem->title }}</h1>
    <form action="{{ route('menus.menuitems.update', ['menu' => $menuItem->menu_id, 'menuitem' => $menuItem->id]) }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ $menuItem->title }}" required>
        </div>
        <div class="mb-3">
            <label for="url" class="form-label">URL:</label>
            <input type="url" class="form-control" name="url" id="url" value="{{ $menuItem->url }}" required>
        </div>
      
        <button type="submit" class="btn btn-primary">Update Item</button>
    </form>
</div>
@endsection
