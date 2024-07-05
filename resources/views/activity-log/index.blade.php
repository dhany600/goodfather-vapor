@extends('layouts.main')

@section('container')
    <div class="body flex-grow-1 px-3">
        <div class="page-dashboard">
            <div class="tab-content rounded-bottom">
                <div class="card">
                    <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-416">
                        <h3 class="mb-4">
                            Activity Log
                        </h3>
                        <div class="row">
                            <div class="col-md-3">
                            </div>
                        </div>
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Customer ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Date Created</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        1
                                    </th>
                                    <td>
                                        TEMO1804240001
                                    </td>
                                    <td>
                                        Tedi
                                    </td>
                                    <td>
                                        081552463245
                                    </td>
                                    <td>
                                        18-04-2024
                                    </td>
                                    <td>
                                        <button class="btn btn-primary" type="button">
                                            Detail
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <nav aria-label="...">
                            <ul class="pagination">
                                <li class="page-item disabled">
                                    <a class="page-link">Previous</a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item" aria-current="page">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('js')
    @endsection
@endsection