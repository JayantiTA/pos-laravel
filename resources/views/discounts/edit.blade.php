@extends('layouts.app')

@section('content')

    <div class="container">
        <a class="btn btn-secondary my-2" href="/admin/discounts">Back</a>
        <div class="card shadow">
            <div class="card-header bg-white">
                <h3 class="text-center mb-0">Update Discount</h3>
            </div>
            @foreach($discount as $d)
                <form role="form" action="/admin/discount/update" method="POST">
                    @csrf
                    <div class="card-body bg-white">
                        <div class="form-group{{ $errors->has('product_id') ? ' has-danger' : '' }}">
                            <div class=" mb-3">
                                <label for="product_id" class="form-label">Product</label>
                                <select class="form-select" name="product_id" aria-label="Default select example" value="{{ old('product_id', $d->product_id) }}">
                                    @foreach($products as $p)
                                        <option value="{{ $p->id }}" {{ $p->id == $d->product_id ? 'selected' : '' }}>{{ $p->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('product_id'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('product_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('code') ? ' has-danger' : '' }}">
                            <div class=" mb-3">
                                <label for="code" class="form-label">Code</label>
                                <input class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" type="text" name="code" class="form-control" id="code" value="{{ old('code', $d->code) }}" required>
                            </div>
                            @if ($errors->has('code'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('percentage') ? ' has-danger' : '' }}">
                            <div class=" mb-3">
                                <label for="percentage" class="form-label">Percentage (in %)</label>
                                <input class="form-control{{ $errors->has('percentage') ? ' is-invalid' : '' }}" type="number" name="percentage" class="form-control" id="percentage" value="{{ old('percentage', $d->percentage) }}" required>
                            </div>
                            @if ($errors->has('percentage'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('percentage') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status" aria-label="Default select example" value="{{ old('status', $d->status) }}">
                                <option value="valid" {{ $d->status == 'valid' ? 'selected' : '' }}>Valid</option>
                                <option value="outdated" {{ $d->status == 'outdated' ? 'selected' : '' }}>Outdated</option>
                            </select>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="id" value="{{ $d->id }}" />
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
