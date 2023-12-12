@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">{{ $page->title }}</h1>

    <div class="row justify-content-center">
        @php $postCount = count($blogPosts); @endphp

        @foreach($blogPosts as $blogPost)
            <div class="{{ $postCount === 1 ? 'col-md-8' : 'col-md-6' }} mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $blogPost->title }}</h5>

     
                        <p class="card-text">
                            {{ $postCount === 1 
                                ? \Illuminate\Support\Str::limit(strip_tags($blogPost->content), 200) 
                                : \Illuminate\Support\Str::limit(strip_tags($blogPost->content), 100) 
                            }}
                        </p>
                        <a href="{{ route('blogposts.show', $blogPost->id) }}" class="btn btn-primary mx-auto">Read More</a>
                    </div>
                </div>
            </div>
            @if ($loop->iteration % 2 == 0 && $postCount > 2)
                </div><div class="row justify-content-center">
            @endif
        @endforeach
    </div>
</div>
@endsection
