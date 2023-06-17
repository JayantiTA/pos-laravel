@extends('layouts.app')

@section('content')
    <div class="container">
        <a type="button" class="btn btn-primary mb-3" href="/admin/discount/create">
            Create
        </a>

        @if (session()->has('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status.message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="text-center">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Product Id</th>
                        <th scope="col">Code</th>
                        <th scope="col">Percentage</th>
                        <th scope="col">Status</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($discounts as $discount)
                        <tr>
                            <td>{{ $discount->id }}</td>
                            <td>{{ $discount->product_id }}</td>
                            <td>{{ $discount->code }}</td>
                            <td>{{ $discount->percentage }}</td>
                            <td>{{ $discount->status }}</td>
                            <td>{{ $discount->created_at }}</td>
                            <td>{{ $discount->updated_at }}</td>
                            <td>
                                <a type="button" class="btn btn-primary" href="/admin/discount/edit/{{ $discount->id }}">
                                    Update
                                </a>

                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $discount->id }}">
                                    Delete
                                </button>

                                <!-- Modal Delete -->
                                <div class="modal fade" id="deleteModal{{ $discount->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $discount->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $discount->id }}">Delete Discount</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure want to delete this discount?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <form action="/admin/discount/delete/{{ $discount->id }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- @include('layouts.footers.auth') --}}
    </div>
@endsection
