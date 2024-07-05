@extends('layouts.main')

@section('container')
    <div class="body flex-grow-1 px-3">
        <div class="page-product-list">
            <div class="tab-content rounded-bottom">
                <div class="card mb-4 p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="mb-4">
                                Customer Detail
                            </h3>
                        </div>
                        <div class="col-md-6 text-right-on-desktop">
                            <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-success">
                                <svg class="icon me-2">
                                    <use xlink:href="{{ asset('src/vendors/@coreui/icons/svg/free.svg') }}#cil-plus"></use>
                                </svg>
                                Edit
                            </a>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="mb-0 text-title">
                                        Customer ID :
                                    </h3>
                                    <p class="mb-0">
                                        {{ $customer->id }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex flex-wrap mb-2">
                                        <h3 class="mb-0 text-title w-100">
                                            Name :
                                        </h3>
                                        <p class="mb-0">
                                            {{ $customer->customer_name }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex flex-wrap mb-2">
                                        <h3 class="mb-0 text-title w-100">
                                            Phone :
                                        </h3>
                                        <p class="mb-0">
                                            {{ $customer->customer_phone }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex flex-wrap mb-2">
                                        <h3 class="mb-0 text-title w-100">
                                            Date Created :
                                        </h3>
                                        <p class="mb-0">
                                            {{ $customer->created_at }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @if(session('success'))
                                <div class="alert alert-success mt-3" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
