@extends('layout.admin')

@section('title', 'Users')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header text-primary">
            <h6 class="m-0 font-weight-bold">
                @if(isset($user))
                    Edit Existing User
                @else
                    Create New User
                @endif
            </h6>
        </div>
        <div class="card-body">
            @if(isset($user))
            {!! Form::model($user, ['url' => ['admin/users', $user->id], 'method' => 'patch', 'class' => 'needs-validation', 'novalidate']) !!}
                @php $selected_roles = $user->roles->pluck('id')->toArray(); @endphp
            @else
                {!! Form::open(['url' => 'admin/users', 'class' => 'needs-validation', 'novalidate']) !!}
                @php $selected_roles = []; @endphp
            @endif

            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'required']) !!}
                {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', 'E-mail:') !!}
                {!! Form::email('email', null, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'required']) !!}
                {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            @if(!isset($user))
            <div class="form-group">
                {!! Form::label('password', 'Password:') !!}
                {!! Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'required']) !!}
                {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {!! Form::label('password_confirmation', 'Confirm Password:') !!}
                {!! Form::password('password_confirmation', ['class' => 'form-control' . ($errors->has('password_confirmation') ? ' is-invalid' : ''), 'required']) !!}
                {!! $errors->first('password_confirmation', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            @endif
            <div class="form-group">
                {!! Form::label('roles[]', 'Role:') !!}
                {!! Form::select('roles[]', $roles, $selected_roles, ['class' => 'form-control', 'multiple' => 'multiple', 'required']) !!}
                {!! $errors->first('role_id', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
