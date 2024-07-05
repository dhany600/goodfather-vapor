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
                                <a href="{{ route('category.create') }}" class="btn btn-info">
                                    <svg class="icon me-2">
                                        <use xlink:href="{{ asset('src/vendors/@coreui/icons/svg/free.svg') }}#cil-plus"></use>
                                    </svg>
                                    Add Item
                                </a>
                            </div>
                        </div>
                        <div class="">
                            <table class="table table-striped table-hover table-bordered" id="products-table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Product Count</th>
                                        <th scope="col">Action</th>
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
        <script type="text/javascript">
            $(document).ready(function() {
                $('#products-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('category.index') }}",
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                        {
                            data: 'category_name', 
                            name: 'category_name',
                            render: function(data, type, row) {
                                return data.replace(/\b\w/g, function(l){ return l.toUpperCase() });
                            }
                        },
                        { data: 'product_count', name: 'product_count' }, // New column for product count
                        { data: 'action', name: 'action', orderable: false, searchable: false }
                    ]
                });
            });
        </script>
    @endsection
@endsection
