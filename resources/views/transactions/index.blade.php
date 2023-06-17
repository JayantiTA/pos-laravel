@extends('layouts.app')

@section('content')
    <div class="container">
        <a type="button" class="btn btn-primary mb-3" href="/">
            Create
        </a>
        @if (Auth::user()->role == 'admin')
            <a type="button" class="btn btn-warning mb-3" data-bs-toggle="modal" data-bs-target="#deleteModal">
                Print Report
            </a>
        @endif
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="/report" method="POST" class="d-inline">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Select Month</h5>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="month" class="form-label">Month</label>
                                <select class="form-select" name="month" aria-label="Default select example">
                                    <option value=1>January</option>
                                    <option value=2>February</option>
                                    <option value=3>March</option>
                                    <option value=4>April</option>
                                    <option value=5>May</option>
                                    <option value=6>June</option>
                                    <option value=7>July</option>
                                    <option value=8>August</option>
                                    <option value=9>September</option>
                                    <option value=10>October</option>
                                    <option value=11>November</option>
                                    <option value=12>December</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Get Report</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
                        <th scope="col">Cashier Id</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Total Amount</th>
                        <th scope="col">Transaction Method</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->cashier_id }}</td>
                            <td>{{ $transaction->discount }}</td>
                            <td>@convert($transaction->total_amount)</td>
                            <td>{{ $transaction->transaction_method }}</td>
                            <td>{{ $transaction->created_at }}</td>
                            <td>{{ $transaction->updated_at }}</td>
                            <td>
                                <a type="button" class="btn btn-primary" href="/transaction/{{ $transaction->id }}">
                                    Show Receipt
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- @include('layouts.footers.auth') --}}
    </div>
@endsection
