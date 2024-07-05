@extends('layouts.main')

@section('container')
    <div class="body flex-grow-1 px-3">
        <div class="page-transaction-add container">
            <div class="tab-content rounded-bottom">
                <div class="card mb-4">
                    <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-416">
                        <h3 class="mb-4">
                            Add Transaction
                        </h3>
                        <div class="dropdown mb-3">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-coreui-toggle="dropdown" aria-expanded="false">
                                Category
                            </button>
                            <ul class="dropdown-menu" id="categoryDropdown">
                                @foreach ($categories as $category)
                                    <li><a class="dropdown-item" data-category-id="{{ $category->id }}" style="text-transform: capitalize">{{ $category->category_name }}</a></li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="">
                            <table class="table table-striped table-hover table-bordered" id="transactionTable" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Qty left</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>
                                            60ml nicotine 3
                                        </td>
                                        <td>
                                            2
                                        </td>
                                        <td>
                                            Rp 10.000
                                        </td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-info" data-coreui-toggle="modal"
                                                data-coreui-target="#exampleModal">
                                                <svg class="icon me-2">
                                                    <use xlink:href="{{ asset('src/vendors/@coreui/icons/svg/free.svg') }}#cil-plus"></use>
                                                </svg>
                                                Add Item
                                            </button>
    
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                            <button type="button" class="btn-close"
                                                                data-coreui-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            ...1
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-coreui-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>
                                            60ml nicotine 3
                                        </td>
                                        <td>
                                            2
                                        </td>
                                        <td>
                                            Rp 10.000
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-info" data-coreui-toggle="modal"
                                                data-coreui-target="#exampleModal2">
                                                <svg class="icon me-2">
                                                    <use xlink:href="{{ asset('src/vendors/@coreui/icons/svg/free.svg') }}#cil-plus"></use>
                                                </svg>
                                                Add Item
                                            </button>
    
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal2" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                            <button type="button" class="btn-close"
                                                                data-coreui-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            ...2
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-coreui-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card mb-5">
                    <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-416">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="mb-4">
                                    Cart
                                </h3>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-danger" type="button" style="float: right" id="clearCartButton">
                                    <svg class="icon me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-x">
                                        <path d="M18 6 6 18" />
                                        <path d="m6 6 12 12" /></svg>
                                    Clear Cart
                                </button>
                            </div>
                        </div>
                        <div class="asd" style="overflow: auto">
                            <table class="table table-striped table-hover table-bordered" id="cartTable" style="width: 100%">
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
                                    <tr>
                                        {{-- <td>
                                            <div class="button-container">
                                                <button type="button" class="btn btn-info" data-coreui-toggle="modal"
                                                    data-coreui-target="#exampleModal">
                                                    <svg class="icon me-2">
                                                        <use xlink:href="{{ asset('src/vendors/@coreui/icons/svg/free.svg') }}#cil-pencil"></use>
                                                    </svg>
                                                    Edit Item
                                                </button>
                                                <button type="button" class="btn btn-danger" data-coreui-toggle="modal"
                                                    data-coreui-target="#exampleModal2">
                                                    <svg class="icon me-2">
                                                        <use xlink:href="{{ asset('src/vendors/@coreui/icons/svg/free.svg') }}#cil-trash"></use>
                                                    </svg>
                                                    Delete Item
                                                </button>
                                            </div>
                                            <!-- Button trigger modal -->
    
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                            <button type="button" class="btn-close"
                                                                data-coreui-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            ...1
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-coreui-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td> --}}
                                    </tr>
                                    <tr class="table-info">
                                        <th scope="row"></th>
                                        <td>
                                            <b>
                                                Total Quantity
                                            </b>
                                        </td>
                                        <td>
                                            4
                                        </td>
                                        <td>
                                            <b>
                                                Total Transaction
                                            </b>
                                        </td>
                                        <td>
                                            Rp 40.000
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <a class="btn btn-primary" href="{{ route('checkout.index') }}">
                            <svg class="icon me-2">
                                <use xlink:href="{{ asset('src/vendors/@coreui/icons/svg/free.svg') }}#cil-arrow-thick-right"></use>
                            </svg>
                            Checkout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('js')
        <script type="text/javascript">
            $(document).ready(function() {
                // Setup CSRF token for AJAX requests
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var table = $('#transactionTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{!! route('transaction.data') !!}',
                        data: function (d) {
                            d.category_id = $('#categoryDropdown a.active').data('category-id');
                        }
                    },
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'product_name', name: 'product_name' },
                        { data: 'product_quantity', name: 'product_quantity' },
                        { data: 'price', name: 'price' },
                        { data: 'action', name: 'action', orderable: false, searchable: false }
                    ]
                });

                $('#categoryDropdown').on('click', 'a', function() {
                    $('#categoryDropdown a').removeClass('active');
                    $(this).addClass('active');
                    table.ajax.reload();
                });

                $('#cartTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('cart.data') !!}',
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'product_name', name: 'product_name' },
                        { data: 'quantity', name: 'quantity' },
                        { data: 'price', name: 'price' },
                        { data: 'total_price', name: 'total_price' },
                        { data: 'action', name: 'action', orderable: false, searchable: false }
                    ]
                });

                $('#clearCartButton').click(function() {
                    if (confirm('Are you sure you want to clear the cart?')) {
                        $.ajax({
                            url: '{{ route('cart.clear') }}',
                            type: 'DELETE',
                            dataType: 'json',
                            success: function(response) {
                                if (response.success) {
                                    $('#cartTable').DataTable().ajax.reload();
                                    alert(response.message);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                            }
                        });
                    }
                });

                $(document).on('click', '.remove-item', function(e) {
                    e.preventDefault();
                    var url = $(this).attr('href');

                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                $('#cartTable').DataTable().ajax.reload();
                                // You can display a success message if needed
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                });

                $(document).on('click', '.add-to-cart', function(e) {
                    e.preventDefault();
                    var productId = $(this).data('product-id');

                    $.ajax({
                        url: '/cart/add/' + productId,
                        type: 'POST',
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                $('#cartTable').DataTable().ajax.reload();
                                // You can display a success message if needed
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                });
            });
        </script>

    @endsection
@endsection