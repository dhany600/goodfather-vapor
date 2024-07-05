@extends('layouts.main')

@section('container')
    <div class="body flex-grow-1 px-3">
        <div class="page-employee">
            <div class="tab-content rounded-bottom">
                <form id="transactionEditForm" method="POST" action="{{ route('transaction.update', $transaction->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-416">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="mb-3">Transaction Edit</h3>
                                </div>
                                <div class="col-md-6">
                                    <div class="flex-area text-right-on-desktop">
                                        <button type="submit" class="btn btn-success">
                                            <svg class="button-svg me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check">
                                                <path d="M20 6 9 17l-5-5" />
                                            </svg>
                                            Save Change
                                        </button>
                                        <a href="#" class="btn btn-danger">
                                            <svg class="button-svg me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x">
                                                <path d="M18 6 6 18" />
                                                <path d="m6 6 12 12" />
                                            </svg>
                                            Cancel
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <h5 class="mb-2 pb-2 border-bottom">Basic Info</h5>
                                <div class="flex-container">
                                    <div class="item-container">
                                        <p class="text-container">Transaction ID : {{ $transaction->custom_id }}</p>
                                    </div>
                                    <div class="item-container">
                                        <p class="text-container">Total Transaction : <label id="labelTotalTransaction">Rp {{ number_format($transaction->total_transaction) }}</label></p>
                                    </div>
                                    <div class="item-container">
                                        <p class="text-container">Worker : {{ $transaction->user->name }}</p>
                                    </div>
                                    <div class="item-container">
                                        <label for="status" class="d-inline-block">Status:</label>
                                        <select name="status" id="status" class="form-control d-inline-block w-auto">
                                            <option value="Failed" {{ $transaction->status_transaksi == 'Failed' ? 'selected' : '' }}>Failed</option>
                                            <option value="Success" {{ $transaction->status_transaksi == 'Success' ? 'selected' : '' }}>Success</option>
                                        </select>
                                    </div>
                                    <div class="item-container">
                                        <p class="text-container">Time & Date : 16:01 | 17-04-2024</p>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <h5 class="mb-2">Purchased Item</h5>
                                    </div>
                                    <div class="col-md-6 text-right-on-desktop">
                                        <button type="button" class="btn btn-info" data-coreui-toggle="modal" data-coreui-target="#exampleModal">
                                            <svg class="icon me-2">
                                                <use xlink:href="http://goodfather-vapor.test/src/vendors/@coreui/icons/svg/free.svg#cil-plus"></use>
                                            </svg>
                                            Add Item
                                        </button>
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
                                                        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-striped table-hover table-bordered" id="addProduct" style="width: 100%">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">#</th>
                                                                    <th scope="col">Name</th>
                                                                    <th scope="col">Item Qty</th>
                                                                    <th scope="col">Price</th>
                                                                    <th scope="col">Total Price</th>
                                                                    <th scope="col">Action</th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="asd" style="overflow: auto">
                                    <table class="table table-striped table-hover table-bordered" id="productDetail">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Item Qty</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Total Price</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $totalItem = 0; @endphp
                                            @foreach($transaction->transactionDetails as $detail)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $detail->product_name }}</td>
                                                <td>
                                                    <input class="form-control product-quantity" type="number" name="product_quantities[]" value="{{ $detail->product_quantity }}" min="1" data-product-price="{{ $detail->total_purchase / $detail->product_quantity }}" max="{{ $detail->product->product_quantity + $detail->product_quantity }}">
                                                </td>
                                                <td>{{ number_format(($detail->total_purchase / $detail->product_quantity), 0) }}</td>
                                                <td class="total-price">Rp {{ number_format($detail->total_purchase, 0) }}</td>
                                                <td>
                                                    <input type="hidden" name="productIds[]" value="{{ $detail->product->id }}">
                                                    <input type="hidden" name="transaction_detail_ids[]" value="{{ $detail->id }}">
                                                    <button class="btn btn-danger btn-sm remove-product">Remove</button>
                                                </td>
                                                @php $totalItem += $detail->product_quantity; @endphp
                                            </tr>
                                            @endforeach
                                            <tr class="table-info">
                                                <th scope="row"></th>
                                                <td><b>Total Quantity</b></td>
                                                <td>{{ $totalItem }}</td>
                                                <td><b>Total Transaction</b></td>
                                                <td id="totalTransactionPurchase">Rp {{ number_format($transaction->total_transaction) }}</td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 text-right-on-desktop">
                                <button type="submit" class="btn btn-success">
                                    <svg class="button-svg me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check">
                                        <path d="M20 6 9 17l-5-5" />
                                    </svg>
                                    Save Change
                                </button>
                                <a href="#" class="btn btn-danger">
                                    <svg class="button-svg me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x">
                                        <path d="M18 6 6 18" />
                                        <path d="m6 6 12 12" />
                                    </svg>
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @section('js')
        <script>
            $(document).ready(function() {
                // Initialize DataTable for the modal
                var table = $('#addProduct').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('products.getProductsData') !!}',
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'product_name', name: 'product_name' },
                        { data: 'product_quantity', name: 'product_quantity' },
                        { data: 'price', name: 'price' },
                        { data: 'total_price', name: 'total_price' },
                        { data: 'action', name: 'action', orderable: false, searchable: false }
                    ]
                });

                // Store the initial total transaction amount
                var initialTotalTransaction = parseFloat($('#totalTransactionPurchase').text().replace('Rp ', '').replace(/\./g, ''));

                // Handle adding product to the transaction
                $('#addProduct').on('click', '.add-product', function() {
                    var productId = $(this).data('product-id');
                    var productName = $(this).data('product-name');
                    var productQuantity = $(this).data('product-quantity');
                    var productPrice = $(this).data('product-price');

                    // Check if the product already exists in the table
                    var existingRow = $('#productDetail tbody tr').filter(function() {
                        return $(this).find('input[name="productIds[]"]').val() == productId;
                    });

                    if (existingRow.length > 0) {
                        // Update the existing row
                        var quantityInput = existingRow.find('input[name="product_quantities[]"]');
                        var newQuantity = parseInt(quantityInput.val()) + 1;
                        quantityInput.val(newQuantity);

                        var newTotalPrice = newQuantity * productPrice;
                        existingRow.find('.total-price').text('Rp ' + new Intl.NumberFormat().format(newTotalPrice));
                    } else {
                        // Add a new row
                        var formattedProductPrice = new Intl.NumberFormat().format(productPrice);
                        var formattedTotalPrice = new Intl.NumberFormat().format(productPrice * 1);

                        var newRow = `
                            <tr>
                                <td></td>
                                <td>${productName}</td>
                                <td><input type="number" name="product_quantities[]" value="1" min="1" max="${productQuantity}" class="form-control product-quantity" data-product-price="${productPrice}"></td>
                                <td>${formattedProductPrice}</td>
                                <td class="total-price">Rp ${formattedTotalPrice}</td>
                                <td>
                                    <input type="hidden" name="productIds[]" value="${productId}">
                                    <button class="btn btn-danger btn-sm remove-product">Remove</button>
                                </td>
                            </tr>
                        `;
                        $('#productDetail tbody tr.table-info').before(newRow);
                    }

                    // Update total quantity and total transaction
                    updateTotals();

                    // Close the modal
                    $('#exampleModal').modal('hide');
                });

                // Function to update total quantity and total transaction
                function updateTotals() {
                    var totalQuantity = 0;
                    var totalTransaction = 0;

                    $('#productDetail tbody tr').each(function() {
                        var quantity = parseInt($(this).find('input[name="product_quantities[]"]').val() || 0);
                        var productPrice = parseFloat($(this).find('input[name="product_quantities[]"]').data('product-price') || 0);
                        var totalPrice = quantity * productPrice;

                        totalQuantity += quantity;
                        totalTransaction += totalPrice;

                        // Update the total price for each row
                        $(this).find('.total-price').text('Rp ' + new Intl.NumberFormat().format(totalPrice));
                    });

                    // Update the total quantity and total transaction in the table footer
                    $('.table-info td').eq(1).text(totalQuantity);
                    $('#totalTransactionPurchase').text('Rp ' + new Intl.NumberFormat().format(totalTransaction));
                    $('#labelTotalTransaction').text('Rp ' + new Intl.NumberFormat().format(totalTransaction));
                }

                // Event listener for quantity changes
                $('#productDetail').on('input', '.product-quantity', function() {
                    updateTotals();
                });

                // Event listener for removing product
                $('#productDetail').on('click', '.remove-product', function() {
                    $(this).closest('tr').remove();
                    updateTotals();
                });
            });
        </script>
    @endsection
@endsection