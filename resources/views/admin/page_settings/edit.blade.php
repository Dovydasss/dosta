@extends('layout.admin')

@section('content')
<div class="container mt-4">

    <h1>Edit Page Settings</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('admin.page-settings.update', $pageSetting->id) }}" method="POST" enctype="multipart/form-data" class="mt-4">
        @csrf
        @method('PUT')

        {{-- Title Field --}}
        <div class="mb-3">
            <label for="title">Page Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $pageSetting->title ?? '' }}" required>
        </div>

        {{-- Icon Upload Field --}}
        <div class="mb-3">
            <label for="icon" class="form-label">Page Icon:</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="icon" name="icon" onchange="readURL(this);">
                <label class="custom-file-label" for="icon">Choose file</label>
            </div>
            @if($pageSetting->icon)
                <div class="mt-2">
                    <img id="icon-preview" src="{{ asset('storage/icons/' . basename($pageSetting->icon_url)) }}" alt="Page Icon" width="50" height="50">
                </div>
            @endif
        </div>

        {{-- Description Field --}}
        <div class="mb-3">
            <label for="description">Page Description:</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $pageSetting->description ?? '' }}</textarea>
        </div>

        {{-- Submit Button --}}
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>

</div>

<script>
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#icon-preview').attr('src', e.target.result).width(50).height(50);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}

$(document).ready(function () {
    bsCustomFileInput.init();
});
</script>

@endsection
