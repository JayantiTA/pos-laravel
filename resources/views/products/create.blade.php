@extends('layouts.app')

@section('content')

    <div class="container">
        <a class="btn btn-secondary my-2" href="/admin/products">Back</a>
        <div class="card shadow">
            <div class="card-header bg-white">
                <h3 class="text-center mb-0">Add Product</h3>
            </div>
            <form role="form" action="/admin/product/create" method="POST">
                @csrf
                <div class="card-body bg-white">
                    <div class="form-group{{ $errors->has('category_id') ? ' has-danger' : '' }}">
                        <div class=" mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select" name="category_id" aria-label="Default select example">
                                @foreach($categories as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($errors->has('category_id'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('category_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                        <div class=" mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="name" name="name" class="form-control" id="name" required>
                        </div>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                        <div class=" mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" type="number" name="price" class="form-control" id="price" required>
                        </div>
                        @if ($errors->has('price'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('price') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('stock') ? ' has-danger' : '' }}">
                        <div class=" mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input class="form-control{{ $errors->has('stock') ? ' is-invalid' : '' }}" type="number" name="stock" class="form-control" id="stock" required>
                        </div>
                        @if ($errors->has('stock'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('stock') }}</strong>
                            </span>
                        @endif
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                </div>
                <div class="card-footer bg-white text-end">
                    <button class="btn btn-primary my-1" type="submit">Create</button>
                </div>
            </form>
        </div>

        {{-- @include('layouts.footers.auth') --}}
    </div>
@endsection
