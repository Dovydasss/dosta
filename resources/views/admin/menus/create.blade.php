@extends('layout.admin')

@section('head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container mt-4">
    <h1>Create Menu</h1>
    <form method="POST" action="{{ route('menus.store') }}" class="mt-4">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Menu Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <select class="selectpicker form-control" id="location" name="location" required>
                <option value="">Choose location</option>
                <option value="top">Top</option>
                <option value="left">Left</option>
                <option value="right">Right</option>
                <option value="bottom">Bottom</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="pages" class="form-label">Pages</label>
            <select name="pages[]" id="pages" class="selectpicker form-control" multiple data-live-search="true">
 
                @foreach($pages as $page)
                <option value="{{ $page->id }}">
                    {{ $page->title }}
                </option>
                @endforeach

                
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(function() {
        $('.selectpicker').selectpicker();
    });
</script>
@endsection