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
                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-success">
                                <svg class="icon me-2">
                                    <use xlink:href="{{ asset('src/vendors/@coreui/icons/svg/free.svg') }}#cil-plus"></use>
                                </svg>
                                Edit
                            </a>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="mb-0 text-title">
                                        Product Image :
                                    </h3>
                                    <div class="d-flex mb-2">
                                        <img src="{{ $product->image }}" onerror="this.onerror=null; this.src='https://cdn-icons-png.flaticon.com/256/8576/8576437.png';" alt="" class="image-max-width">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex flex-wrap mb-2">
                                        <h3 class="mb-0 text-title w-100">
                                            Product Name :
                                        </h3>
                                        <p class="mb-0">
                                            {{ $product->product_name }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex flex-wrap mb-2">
                                        <h3 class="mb-0 text-title w-100">
                                            Product Stock :
                                        </h3>
                                        <p class="mb-0">
                                            {{ $product->product_quantity }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex flex-wrap mb-2">
                                        <h3 class="mb-0 text-title w-100">
                                            Product Price :
                                        </h3>
                                        <p class="mb-0">
                                            Rp {{ number_format($product->price, 0) }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex flex-wrap mb-2">
                                        <h3 class="mb-0 text-title w-100">
                                            Product Category :
                                        </h3>
                                        <p class="mb-0" style="text-transform: capitalize">
                                            {{ $product->category->category_name }}
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