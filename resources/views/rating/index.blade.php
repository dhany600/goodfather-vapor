@extends('layouts.main')

@section('container')
    <div class="body flex-grow-1 px-3">
        <div class="page-dashboard">
            <div class="tab-content rounded-bottom">
                <div class="card">
                    <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-416">
                        <h3 class="mb-4">
                            Rating
                        </h3>
                        <div class="row mb-4">
                                <div class="col-md-4">
                                    <label for="start_date">Start Date:</label>
                                    <input type="date" id="start_date" name="start_date" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="end_date">End Date:</label>
                                    <input type="date" id="end_date" name="end_date" class="form-control">
                                </div>
                                <div class="col-md-4" style="align-self: end;">
                                    <button id="applyFilter" class="btn btn-primary">Apply Filter</button>
                                </div>
                            </div>
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Transaction ID</th>
                                    <th scope="col">Transaction Date</th>
                                    <th scope="col">Worker</th>
                                    <th scope="col">Rating</th>
                                    <th scope="col">Feedback</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        AD1704240001
                                    </th>
                                    <td>
                                        16:01 | 17-04-2024
                                    </td>
                                    <td>
                                        Adi
                                    </td>
                                    <td>
                                        5 / 5
                                    </td>
                                    <td>
                                        Perfect
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('js')
    @endsection
@endsection