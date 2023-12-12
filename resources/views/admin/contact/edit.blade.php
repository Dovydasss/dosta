@extends('layout.admin')

@section('content')
<div class="container mt-4">
    <h2>Edit Contact Setting</h2>
    <form action="{{ route('contacts.update', $contactSetting->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="recipient_email">Recipient Email:</label>
            <input type="email" class="form-control" id="recipient_email" name="recipient_email" value="{{ $contactSetting->recipient_email }}" required>
        </div>
        <div class="form-group">
            <label for="recipient_name">Recipient Name:</label>
            <input type="text" class="form-control" id="recipient_name" name="recipient_name" value="{{ $contactSetting->recipient_name }}" required>
        </div>
        <div class="form-group">
            <label for="slug">Slug:</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{ $contactSetting->slug }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
