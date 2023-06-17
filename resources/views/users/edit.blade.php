@extends('layouts.app')

@section('content')

    <div class="container">
        <a class="btn btn-secondary my-2" href="/admin/users">Back</a>
        <div class="card shadow">
            <div class="card-header bg-white">
                <h3 class="text-center mb-0">Update User</h3>
            </div>
            @foreach($user as $u)
                <form role="form" action="/admin/user/update" method="POST">
                    @csrf
                    <div class="card-body bg-white">
                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                            <div class=" mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" class="form-control" id="email" placeholder="name@example.com" value="{{ old('email', $u->email) }}" required>
                            </div>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" name="name" class="form-control" id="name" placeholder="Full Name" value="{{ old('name', $u->name) }}" required>
                            </div>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" name="role" aria-label="Default select example" value="{{ old('role', $u->role) }}">
                                <option value="admin" {{ $u->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="cashier" {{ $u->role == 'cashier' ? 'selected' : '' }}>Cashier</option>
                            </select>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="id" value="{{ $u->id }}" />
                    </div>
                    <div class="card-footer bg-white text-end">
                        <button class="btn btn-primary my-1" type="submit">Update</button>
                    </div>
                </form>
            @endforeach
        </div>

        {{-- @include('layouts.footers.auth') --}}
    </div>
@endsection
