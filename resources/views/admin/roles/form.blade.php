@extends('layout.admin')

@section('title', 'Roles')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header text-primary">
            <h6 class="m-0 font-weight-bold">
                @if(isset($role))
                    Edit Existing Role
                @else
                    Create New Role
                @endif
            </h6>
        </div>
        <div class="card-body">
            @if(isset($role))
                {!! Form::model($role, ['url' => ['admin/roles', $role->id], 'method' => 'patch', 'class' => 'needs-validation', 'novalidate']) !!}
            @else
                {!! Form::open(['url' => 'admin/roles', 'class' => 'needs-validation', 'novalidate']) !!}
            @endif

            <div class="mb-3">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'required']) !!}
                {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            
            <div class="mb-3">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
