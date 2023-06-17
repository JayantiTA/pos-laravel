@extends('layouts.app')

@section('content')

    <div class="container">
        <a class="btn btn-secondary my-2" href="/admin/categories">Back</a>
        <div class="card shadow">
            <div class="card-header bg-white">
                <h3 class="text-center mb-0">Update Category</h3>
            </div>
            @foreach($category as $c)
                <form role="form" action="/admin/category/update" method="POST">
                    @csrf
                    <div class="card-body bg-white">
                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <div class=" mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="name" name="name" class="form-control" id="name" placeholder="snacks" value="{{ old('name', $c->name) }}" required>
                            </div>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="id" value="{{ $c->id }}" />
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
