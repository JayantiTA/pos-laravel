@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="modal-title mb-2" id="deleteModalLabel">Start Transaction</h4>
    <div class="row justify-content-center">
        <div class="card py-3">
            <form role="form" action="/item/add" method="POST">
                @csrf
                <div>
                    <div class="mb-3">
                        <label for="product_id" class="form-label">Product</label>
                        <select class="form-select" name="product_id" aria-label="Default select example">
                            @foreach($products as $p)
                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" type="number" name="quantity" class="form-control" id="quantity" placeholder="" required>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                </div>
                <div class="col-md-8">
                    <button class="btn btn-primary" type="submit">Add Item</button>
                </div>
            </form>
        </div>
    </div>
    <div>
        @if (session()->has('items'))
        {{-- create table --}}
        <table class="my-4 table table-bordered align-middle text-center">
            <thead>
                <tr>
                    <th scope="col">Product Id</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total Amount</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- loop through items --}}
                @foreach (session()->get('items') as $item)
                <tr>
                    <td>{{ $item['product_id'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>@convert($item['price'])</td>
                    <td>@convert($item['total_amount'])</td>
                    <td>
                        <a class="btn btn-danger" href="/item/delete/{{ $item['product_id'] }}">Delete</a>
                    </td>
                </tr>
                @endforeach
                {{-- end loop --}}
            </tbody>
        </table>
        <a href="/checkout" class="btn btn-warning">Checkout</a>
        @endif
    </div>
</div>
@endsection
