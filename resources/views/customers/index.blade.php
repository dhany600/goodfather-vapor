@extends('layouts.main')

@section('container')
    <div class="body flex-grow-1 px-3">
        <div class="page-dashboard">
            <div class="tab-content rounded-bottom">
                <div class="card">
                    <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-416">
                        <h3 class="mb-4">
                            Customer List
                        </h3>
                        <div class="row">
                            <div class="col-md-3">
                                <p class="mb-0">
                                    Customer Count
                                </p>
                                <h5 class="mb-4">
                                    {{ $customerCount }}
                                </h5>
                            </div>
                        </div>
                        <table class="table table-striped table-hover table-bordered" id="customerTable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('js')
        <script>
            $(document).ready(function() {
                $('#customerTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('customer.getData') }}",
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'customer_name', name: 'customer_name' },
                        { data: 'customer_phone', name: 'customer_phone' },
                        { data: 'action', name: 'action', orderable: false, searchable: false }
                    ]
                });
            });

        </script>
    @endsection
@endsection