@extends('layouts.main')

@section('container')
    <div class="body flex-grow-1 px-3">
        <div class="page-product-list">
            <div class="tab-content rounded-bottom">
                <div class="card mb-4">
                    <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-416">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="mb-4">
                                    Product List
                                </h3>
                            </div>
                            <div class="col-md-6 text-right-on-desktop">
                                <a href="{{ route('product.create') }}" class="btn btn-info">
                                    <svg class="icon me-2">
                                        <use xlink:href="{{ asset('src/vendors/@coreui/icons/svg/free.svg') }}#cil-plus"></use>
                                    </svg>
                                    Add Item
                                </a>
                            </div>
                        </div>
                        <div class="dropdown mb-3">
                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                data-coreui-toggle="dropdown" aria-expanded="false">
                                Category
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>
                        <div class="">
                            <table class="table table-striped table-hover table-bordered" id="products-table">
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
                                            <button type="button" class="btn btn-info">
                                                <svg class="button-svg me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-clipboard-list">
                                                    <rect width="8" height="4" x="8" y="2" rx="1" ry="1" />
                                                    <path
                                                        d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                                                    <path d="M12 11h4" />
                                                    <path d="M12 16h4" />
                                                    <path d="M8 11h.01" />
                                                    <path d="M8 16h.01" /></svg>
                                                Detail
                                            </button>
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

    @section('js')
        <script type="text/javascript">
            $(document).ready(function() {
                $('#products-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('products.data') !!}',
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'product_name', name: 'product_name' },
                        { data: 'product_quantity', name: 'product_quantity' },
                        { data: 'price', name: 'price' },
                        { data: 'action', name: 'action', orderable: false, searchable: false }
                    ]
                });
            });

        </script>
    @endsection
@endsection