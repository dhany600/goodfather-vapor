@extends('layouts.main')

@section('container')
    <div class="body flex-grow-1 px-3">
        <div class="page-dashboard">
            <div class="tab-content rounded-bottom">
                <div class="card mb-4">
                    <div class="tab-pane p-3 active preview">
                        <h3 class="mb-4">
                            Checkout
                        </h3>
                        
                        <form action="{{ route('transaction.store') }}" method="POST">
                            @csrf
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
                                        $totalQuantity = 0;
                                        $totalTransaction = 0;
                                    @endphp

                                    @foreach($cartItems as $index => $cartItem)
                                        @php
                                            $totalPrice = $cartItem->quantity * $cartItem->product->price;
                                            $totalQuantity += $cartItem->quantity;
                                            $totalTransaction += $totalPrice;
                                        @endphp
                                        <tr>
                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td>{{ $cartItem->product->product_name }}</td>
                                            <td>{{ $cartItem->quantity }}</td>
                                            <td>Rp {{ number_format($cartItem->product->price, 0, ',', '.') }}</td>
                                            <td>Rp {{ number_format($totalPrice, 0, ',', '.') }}</td>
                                            <input type="hidden" name="products[{{ $index }}][id]" value="{{ $cartItem->product->id }}">
                                            <input type="hidden" name="products[{{ $index }}][quantity]" value="{{ $cartItem->quantity }}">
                                            <input type="hidden" name="products[{{ $index }}][total_price]" value="{{ $totalPrice }}">
                                        </tr>
                                    @endforeach

                                    <tr class="table-info">
                                        <th scope="row"></th>
                                        <td><b>Total Quantity</b></td>
                                        <td>{{ $totalQuantity }}</td>
                                        <td><b>Total Transaction</b></td>
                                        <td>Rp {{ number_format($totalTransaction, 0, ',', '.') }}</td>
                                        <input type="hidden" name="totalTransaction" value="{{ $totalTransaction }}">
                                    </tr>
                                </tbody>
                            </table>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p class="mb-1">Customer Name</p>
                                    <input type="text" name="customer_name" class="w-100 form-control">
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1">Customer Phone Number</p>
                                    <input type="text" name="customer_phone" class="w-100 form-control">
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1">Cash Received</p>
                                    <div class="d-flex">
                                        <div class="input-group-text left-area-input-group-text">Rp</div>
                                        <input type="text" id="cashReceived" name="cash_received" class="w-100 form-control right-area-input-group-text" value="0">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1">Change Money</p>
                                    <div class="d-flex">
                                        <div class="input-group-text left-area-input-group-text">Rp</div>
                                        <input type="text" id="changeMoney" class="w-100 form-control right-area-input-group-text" readonly>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-success" data-coreui-toggle="modal"
                                    data-coreui-target="#exampleModal">
                                <svg class="icon me-2">
                                    <use xlink:href="{{ asset('src/vendors/@coreui/icons/svg/free.svg') }}#cil-check"></use>
                                </svg>
                                Complete Transaction
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                Transaction Confirmation
                                            </h5>
                                            <button type="button" class="btn-close" data-coreui-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure to complete transaction?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-coreui-dismiss="modal">No</button>
                                            <button type="submit" class="btn btn-primary">
                                                Complete Transaction
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('js')
        <script>
            $(document).ready(function() {
                function formatRupiah(number) {
                    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                }

                function updateChangeMoney() {
                    var cashReceived = $('#cashReceived').val().replace(/\D/g, '');
                    var totalTransaction = {{ $totalTransaction }};
                    var changeMoney = formatRupiah(cashReceived - totalTransaction);
                    $('#changeMoney').val(changeMoney);
                }

                $('#cashReceived').on('input', function() {
                    var cashReceived = $(this).val().replace(/\D/g, '');
                    $(this).val(formatRupiah(cashReceived));
                    updateChangeMoney();
                });

                // Initialize change money on page load
                updateChangeMoney();
            });

        </script>
    @endsection
@endsection