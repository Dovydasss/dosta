@extends('layout.admin')

@section('content')
<div class="container mt-4">
    <h1>Add New Item to {{ $menu->name }} Menu</h1>
    <form action="{{ route('menus.menuitems.store', $menu->id) }}" method="POST" class="mt-4">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" class="form-control" name="title" id="title" required>
        </div>
        <div class="mb-3">
            <label for="url" class="form-label">URL:</label>
            <input type="url" class="form-control" name="url" id="url" required>
        </div>
       
        <button type="submit" class="btn btn-primary">Add Item</button>
    </form>
</div>
@endsection
