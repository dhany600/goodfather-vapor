@extends('layouts.main')

@section('container')
    <div class="body flex-grow-1 px-3">
        <div class="page-employee">
            <div class="tab-content rounded-bottom">
                <div class="card">
                    <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-416">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3>
                                {{ $employee->name }}
                            </h3>
                            <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-primary">
                                Edit
                            </a>
                        </div>
                        <div class="">
                            <h5 class="mb-2 pb-2 border-bottom">
                                Basic Info
                            </h5>
                            <div class="flex-container">
                                <div class="item-container">
                                    <p class="text-container">
                                        Name : {{ $employee->name }}
                                    </p>
                                </div>
                                <div class="item-container">
                                    <p class="text-container">
                                        Email : {{ $employee->email }}
                                    </p>
                                </div>
                                <div class="item-container">
                                    <p class="text-container">
                                        Phone : {{ $employee->phone_number }}
                                    </p>
                                </div>
                                <div class="item-container">
                                    <p class="text-container">
                                        Role : {{ $employee->role }}
                                    </p>
                                </div>
                                <div class="item-container">
                                    <p class="text-container">
                                        Date Created : {{ $employee->created_at->format('d-m-Y H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('js')
    @endsection
@endsection
