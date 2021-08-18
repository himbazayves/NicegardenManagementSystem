@extends('layouts.app', ['page' => 'Provider Information', 'pageSlug' => 'providers', 'section' => 'providers'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Provider Information</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Email</th>
                        <th>Telephone</th>
                        <th>Payment information</th>
                        <th>Payments Made</th>
                        <th>Total Payment</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $provider->id }}</td>
                            <td>{{ $provider->name }}</td>
                            <td>{{ $provider->description }}</td>
                            <td>{{ $provider->email }}</td>
                            <td>{{ $provider->phone }}</td>
                            <td style="max-width: 175px">{{ $provider->paymentinfo }}</td>
                            <td>{{ $provider->transactions->count() }}</td>
                            <td>FRW {{ number_format(abs($provider->transactions->sum('amount'))) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Payment and Receipt Summary</h4>
            </div>
            @php
            $receiptAmount=0;
            foreach ($provider->receipts as $receipt) {
            foreach($receipt->products as $product){
            $receiptAmount= $receiptAmount + $product->
            stock * $product->product->price;
            }
            }
            @endphp
            <div class="card-body">
                <table class="table">
                    <thead>
                        <th>Receipt total amount</th>
                        <th>Payment total amount</th>
                        <th>Remain amount</th>

                    </thead>
                    <tbody>
                        <tr>
                            {{-- <td>{{ $receiptAmount }}</td> --}}
                            <td>FRW {{ number_format(abs($receiptAmount)) }}</td>
                            <td>FRW {{ number_format(abs($provider->transactions->sum('amount'))) }}</td>
                            <td>
                                @if ($receiptAmount-$provider->transactions->sum('amount') !=0)
                                <label class="badge badge-warning">FRW
                                    {{number_format(abs($receiptAmount + $provider->transactions->sum('amount')))}}</label>
                                @else
                                <label class="badge badge-success">FRW
                                    0.00
                                    {{-- {{number_format(abs($receiptAmount-$provider->transactions->sum('amount')))}}</label> --}}
                                @endif

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Latest Payments</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <th>Date</th>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Method</th>
                        <th>Amount</th>
                        <th>Reference</th>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ date('d-m-y', strtotime($transaction->created_at)) }}</td>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->title }}</td>
                            <td><a
                                    href="{{ route('methods.show', $transaction->method) }}">{{ $transaction->method->name }}</a>
                            </td>
                            <td>FRW {{ number_format($transaction->amount) }}</td>
                            <td>{{ $transaction->reference }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Latest Receipts</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <th>Date</th>
                        <th>ID</th>
                        <th>Title</th>
                        <th>products</th>
                        <th>Stock</th>
                        <th>Defective Stock</th>
                        <th>Total Stock</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($receipts as $receipt)
                        <tr>
                            <td>{{ date('d-m-y', strtotime($receipt->created_at)) }}</td>
                            <td><a href="{{ route('receipts.show', $receipt) }}">{{ $receipt->id }}</a></td>
                            <td>{{ $receipt->title }}</td>
                            <td>{{ $receipt->products->count() }}</td>
                            <td>{{ $receipt->products->sum('stock') }}</td>
                            <td>{{ $receipt->products->sum('stock_defective') }}</td>
                            <td>{{ $receipt->products->sum('stock') + $receipt->products->sum('stock_defective') }}</td>
                            <td class="td-actions text-right">
                                <a href="{{ route('receipts.show', $receipt) }}" class="btn btn-link"
                                    data-toggle="tooltip" data-placement="bottom" title="Ver Receipt">
                                    <i class="tim-icons icon-zoom-split"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
