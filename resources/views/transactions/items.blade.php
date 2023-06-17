@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="table-responsive" id="receipt">
            <table class="table align-middle">
                <tbody class="text-center">
                    <thead>
                        <tr>
                            <th scope="col">Product Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaction->items as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </tbody>
            </table>
            <div class="text-end">
                <h5>Discount: {{ $transaction->discount }}%</h5>
                <h2>Total: @convert($transaction->total_amount)</h2>
                <p>Paid at: {{ $transaction->created_at }}</p>
            </div>
        </div>
        <div class="text-end">
            <button class="btn btn-primary" onclick="printableDiv('receipt')">Print</button>
        </div>
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
