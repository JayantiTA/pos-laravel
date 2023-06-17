@extends('layouts.app')

@section('content')
    <div class="container">
        <a type="button" class="btn btn-secondary mb-3" href='/transactions'>
            Back
        </a>
        @if (Auth::user()->role == 'admin')
            <a type="button" class="btn btn-primary mb-3" onclick="printableDiv('report')">
                Print
            </a>
        @endif
        <div class="table-responsive" id="report">
            <table class="table table-bordered align-middle">
                <thead class="text-center">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Cashier Id</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Total Amount</th>
                        <th scope="col">Transaction Method</th>
                        <th scope="col">Created At</th>
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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- @include('layouts.footers.auth') --}}
    </div>
@endsection

<script>
    function printableDiv(printableAreaDivId) {
        var printContents = document.getElementById(printableAreaDivId).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
