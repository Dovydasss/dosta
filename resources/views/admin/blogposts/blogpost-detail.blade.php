@extends('layout.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>{{ $blogPost->title }}</h2>
            <p>{!! $blogPost->content !!}</p>

            <div class="mt-5">
                <h3>Comments</h3>
                <form method="POST" action="{{ route('comments.store') }}" class="mb-4">
                    @csrf
                    <input type="hidden" name="blog_post_id" value="{{ $blogPost->id }}">
                    <div class="form-group">
                        <textarea name="content" class="form-control" rows="3" required placeholder="Write your comment here"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Post Comment</button>
                </form>

                @foreach ($blogPost->comments as $comment)
    <div class="card mb-3">
        <div class="card-body">
            <p>{{ $comment->content }}</p>
            <footer class="blockquote-footer">
                Comment by: {{ $comment->user ? $comment->user->name : 'Anonymous' }}
            </footer>

            @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('moderator'))
                <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            @endif
        </div>
    </div>
@endforeach
            </div>
        </div>
    </div>
</div>
@endsection
