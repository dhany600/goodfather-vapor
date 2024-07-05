@extends('layouts.main')

@section('container')
    <div class="body flex-grow-1 px-3">
        <div class="page-product-list">
            <div class="tab-content rounded-bottom">
                <form action="{{ route('customer.update', $customer->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card mb-4 p-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="mb-4">
                                    Customer Detail
                                </h3>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="d-flex flex-wrap mb-2">
                                            <h3 class="mb-2 text-title">
                                                Customer Name :
                                            </h3>
                                            <input type="text" name="customer_name" id="customer_name" value="{{ $customer->customer_name }}" class="w-100 form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex flex-wrap mb-2">
                                            <h3 class="mb-2 text-title">
                                                Customer Phone :
                                            </h3>
                                            <input type="number" name="customer_phone" id="customer_phone" value="{{ $customer->customer_phone }}" class="w-100 form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success mt-4">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
