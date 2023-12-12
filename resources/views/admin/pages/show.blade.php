@extends('layout.app')

@section('content')


    @if (isset($page))

        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div>
                        {!! $page->content !!}
                    </div>
                </div>
            </div>
        </div>
    @else
        <p>Page content not found.</p>
    @endif
@endsection



