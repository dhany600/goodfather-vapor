@extends('layouts.main')

@section('container')
    <div class="body flex-grow-1 px-3">
        <div class="page-dashboard">
            <div class="tab-content rounded-bottom">
                <div class="card">
                    <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-416">
                        <h3 class="mb-4">
                            Transaction List
                        </h3>
                        <div class="row">
                            <div class="col-md-3">
                                <p class="mb-0">
                                    Transaction Count
                                </p>
                                <h5 class="mb-4" id="transaction-count">
                                    0
                                </h5>
                            </div>
                            <div class="col-md-3">
                                <p class="mb-0">
                                    Total Transaction
                                </p>
                                <h5 class="mb-4" id="total-transaction">
                                    Rp 0
                                </h5>
                            </div>
                            <div class="col-md-6">
                                <div class="date-container flex-container">
                                    <div class="flex-item">
                                        <label for="startDate">Start Date:</label>
                                        <input class="form-control mb-2" type="date" id="startDate" name="startDate"
                                            required>
                                    </div>
                                    <div class="flex-item">
                                        <label for="endDate">End Date:</label>
                                        <input class="form-control mb-3" type="date" id="endDate" name="endDate"
                                            required>
                                    </div>
                                </div>
                                <div id="dateError" class="alert alert-danger mt-3" style="display: none;">
                                    Start date must be less than or equal to end date.
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-hover table-bordered" id="transactions-table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Transaction ID</th>
                                    <th scope="col">Total Transaction</th>
                                    <th scope="col">Worker</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Transaction Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('js')
        <script>
            $(document).ready(function() {
                // Set default dates to today
                var today = new Date().toISOString().substr(0, 10);
                $('#startDate').val(today);
                $('#endDate').val(today);

                // Function to format number with thousand separators
                function formatNumber(number) {
                    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                }

                // Initialize DataTable with default today's date
                var table = $('#transactions-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{!! route('transactions.dataTransaction') !!}',
                        data: function(d) {
                            d.startDate = $('#startDate').val();
                            d.endDate = $('#endDate').val();
                        },
                        dataSrc: function(json) {
                            // Update transaction count and total transaction
                            $('#transaction-count').text(json.transactionCount);
                            $('#total-transaction').text('Rp ' + formatNumber(json.totalTransaction));

                            return json.data;
                        }
                    },
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'custom_id', name: 'custom_id' },
                        { data: 'total_transaction', name: 'total_transaction' },
                        { data: 'user.name', name: 'user.name' }, // Assuming relation user and field name
                        { data: 'customer_name', name: 'customer_name' }, // New column for customer name
                        { data: 'created_at', name: 'created_at' },
                        { data: 'action', name: 'action', orderable: false, searchable: false }
                    ]
                });


                // Reload table when date is changed
                $('#startDate, #endDate').change(function() {
                    var startDate = new Date($('#startDate').val());
                    var endDate = new Date($('#endDate').val());

                    if (startDate > endDate) {
                        $('#dateError').show();
                    } else {
                        $('#dateError').hide();
                        table.ajax.reload();
                    }
                });
            });
        </script>
    @endsection
@endsection