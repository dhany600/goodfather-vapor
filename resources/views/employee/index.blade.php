@extends('layouts.main')

@section('container')
    <div class="body flex-grow-1 px-3">
        <div class="page-dashboard">
            <div class="tab-content rounded-bottom">
                <div class="card">
                    <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-416">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="mb-4">
                                    Employee List
                                </h3>
                            </div>
                            <div class="col-md-6 text-right-on-desktop">
                                <a href="{{ route('employee.create') }}" class="btn btn-primary float-right">
                                    Create Employee
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p class="mb-0">
                                    Employee Count
                                </p>
                                <h5 class="mb-4" id="employee-count">
                                    0
                                </h5>
                            </div>
                        </div>
                        <table class="table table-striped table-hover table-bordered" id="employees-table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Date Created</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- DataTables will populate this section -->
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
                var table = $('#employees-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('employee.getEmployees') !!}',
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'phone_number', name: 'phone_number' },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'action', name: 'action', orderable: false, searchable: false }
                    ],
                    drawCallback: function(settings) {
                        $('#employee-count').text(settings._iRecordsTotal);
                    }
                });
            });
        </script>
    @endsection
@endsection
