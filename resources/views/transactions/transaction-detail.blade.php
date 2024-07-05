@extends('layouts.main')

@section('container')
    <div class="body flex-grow-1 px-3">
        <div class="page-employee">
            <div class="tab-content rounded-bottom">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="card">
                    <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-416">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="mb-3">
                                    Transaction Detail
                                </h3>
                            </div>
                            <div class="col-md-6">
                                <div class="flex-area text-right-on-desktop">
                                    <a href="{{ route('transaction.edit', ['transaction' => $transaction->id]) }}" class="btn btn-success">
                                        <svg class="button-svg me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-square-pen">
                                            <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                            <path d="M18.375 2.625a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4Z" />
                                        </svg>
                                        Modify
                                    </a>
                                    <a href="#" class="btn btn-danger">
                                        <svg class="button-svg me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-trash-2">
                                            <path d="M3 6h18" />
                                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                            <line x1="10" x2="10" y1="11" y2="17" />
                                            <line x1="14" x2="14" y1="11" y2="17" /></svg>
                                        Delete Item
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h5 class="mb-2 pb-2 border-bottom">
                                Basic Info
                            </h5>
                            <div class="flex-container">
                                <div class="item-container">
                                    <p class="text-container">
                                        Transaction ID : {{ $transaction->custom_id }}
                                    </p>
                                </div>
                                <div class="item-container">
                                    <p class="text-container">
                                        Total Transaction : Rp {{ number_format($transaction->total_transaction, 0) }}
                                    </p>
                                </div>
                                <div class="item-container">
                                    <p class="text-container">
                                        Worker : {{ $transaction->user->name }}
                                    </p>
                                </div>
                                <div class="item-container">
                                    <p class="text-container">
                                        Status : {{ $transaction->status_transaksi }}
                                    </p>
                                </div>
                                <div class="item-container">
                                    <p class="text-container">
                                        Time & Date : {{ date('H:i | d-m-Y', strtotime($transaction->created_at)); }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <h5 class="mb-2">
                                Purchased Item
                            </h5>
                            <div class="asd" style="overflow: auto">
                                <table class="table table-striped table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Item Qty</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $a = 1;
                                            $totalItem = 0;
                                            $totalPurchase = 0;
                                        @endphp
                                        @foreach ($transaction->transactionDetails as $product)
                                            <tr>
                                                <th scope="row">{{ $a }}</th>
                                                <td>
                                                    {{ $product->product_name }}
                                                </td>
                                                <td>
                                                    {{ $product->product_quantity }}
                                                </td>
                                                <td>
                                                    Rp {{ number_format(($product->total_purchase) / ($product->product_quantity), 0) }}
                                                </td>
                                                <td>
                                                    Rp {{ number_format($product->total_purchase, 0) }}
                                                </td>
                                            </tr>
                                            <?php
                                                $a += 1;
                                                $totalItem += $product->product_quantity;
                                                $totalPurchase += $product->total_purchase;
                                            ?>
                                        @endforeach
                                        <tr class="table-info">
                                            <th scope="row"></th>
                                            <td>
                                                <b>
                                                    Total Quantity
                                                </b>
                                            </td>
                                            <td>
                                                {{ $totalItem }}
                                            </td>
                                            <td>
                                                <b>
                                                    Total Transaction
                                                </b>
                                            </td>
                                            <td>
                                                Rp {{ number_format($totalPurchase) }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('js')
    @endsection
@endsection