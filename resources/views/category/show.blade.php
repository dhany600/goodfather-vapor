@extends('layouts.main')

@section('container')
    <div class="body flex-grow-1 px-3">
        <div class="page-product-list">
            <div class="tab-content rounded-bottom">
                <div class="card mb-4 p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="mb-4">
                                Product Detail
                            </h3>
                        </div>
                        <div class="col-md-6 text-right-on-desktop">
                            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-success">
                                <svg class="icon me-2">
                                    <use xlink:href="{{ asset('src/vendors/@coreui/icons/svg/free.svg') }}#cil-plus"></use>
                                </svg>
                                Edit
                            </a>
                        </div>

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex flex-wrap mb-2">
                                        <h3 class="mb-0 text-title w-100">
                                            Category Name :
                                        </h3>
                                        <p class="mb-0" style="text-transform: capitalize">
                                            {{ $category->category_name }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-hover table-bordered" id="products-table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
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
        <script>
            $(document).ready(function() {
                $('#products-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('category.show', $category->id) }}",
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'product_name', name: 'product_name' },
                        { data: 'product_quantity', name: 'product_quantity' },
                    ]
                });
            });
        </script>
    @endsection
@endsection