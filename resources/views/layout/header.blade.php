<div class="d-flex justify-content-center align-items-center">
@if(optional($header)->header_image)
    <img src="{{ asset($header->header_image) }}" alt="Header Image" class="img-fluid">
@else
    Header image not set.
@endif


</div>
