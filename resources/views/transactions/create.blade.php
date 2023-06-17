@extends('layouts.app')

@section('content')

    <div class="container">
        <a class="btn btn-secondary my-2" href="/home">Back</a>
        <div class="card shadow">
            <div class="card-header bg-white">
                <h3 class="text-center mb-0">Checkout Page</h3>
            </div>
            <div class="card-body">
                <form action="/transaction/create" method="POST" class="d-inline">
                    @csrf
                    <div class="mb-3">
                        <label for="discount" class="form-label">Discount</label>
                        <input type="number" name="discount" class="form-control" id="discount" placeholder="0">
                    </div>
                    <div class="mb-3">
                        <label for="transaction_method" class="form-label">Payment Method</label>
                        <select class="form-select" name="transaction_method" aria-label="Default select example">
                            <option value="cash">cash</option>
                            <option value="card">card</option>
                            <option value="qris">QRIS</option>
                        </select>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="total_amount" value="{{ $total_amount }}" />
                    <div class="text-end">
                        <h2>@convert($total_amount)</h2>
                        <button type="submit" class="btn btn-warning">Pay</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- @include('layouts.footers.auth') --}}
    </div>
@endsection


{{-- <form action="/transaction/create" method="POST" class="d-inline">
    @csrf
    <div class="mb-3">
        <label for="discount" class="form-label">Discount</label>
        <input type="number" name="discount" class="form-control" id="discount" placeholder="0">
    </div>
    <div class="mb-3">
        <label for="transaction_method" class="form-label">Payment Method</label>
        <select class="form-select" name="transaction_method" aria-label="Default select example">
            <option value="cash">cash</option>
            <option value="card">card</option>
            <option value="qris">QRIS</option>
        </select>
    </div>
    <h1>
    <button type="submit" class="btn btn-warning">Checkout</button>
</form> --}}
