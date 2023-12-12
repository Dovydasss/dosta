@extends('layout.admin')

@section('content')
<div class="container mt-4">
    <h1>Edit Header</h1>

    @if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('header.update') }}" method="POST" enctype="multipart/form-data" class="mt-4">
        @csrf
        @method('POST')

        <div class="mb-3">
            <label for="header_image" class="form-label">Header Image</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="header_image" id="header_image" onchange="updateImageDisplay()">
                <label class="custom-file-label" for="header_image">Choose file</label>
            </div>
            @if(optional($header)->header_image)
            <div class="mt-2">
            <img id="header-image-preview" src="{{ asset($header->header_image) }}" alt="Header Image" class="img-thumbnail" style="max-width: 200px;">
            </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="header_width" class="form-label">Header Width</label>
            <input type="number" class="form-control" name="header_width" id="header_width" value="{{ old('header_width', optional($header)->width ?? 1024) }}">
        </div>

        <div class="mb-3">
            <label for="header_height" class="form-label">Header Height</label>
            <input type="number" class="form-control" name="header_height" id="header_height" value="{{ old('header_height', optional($header)->height ?? 768) }}">
        </div>

        <button type="submit" class="btn btn-primary">Save Header</button>
    </form>
</div>

<script>
function updateImageDisplay() {
    const input = document.getElementById('header_image');
    const preview = document.getElementById('header-image-preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('header_image');
    const preview = document.getElementById('header-image-preview');

    if(input.files && input.files[0]){
        preview.style.display = 'block';
    }


    bsCustomFileInput.init();
});
</script>
@endsection
