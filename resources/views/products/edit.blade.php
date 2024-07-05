@extends('layouts.main')

@section('container')
    <div class="body flex-grow-1 px-3">
        <div class="page-product-list">
            <div class="tab-content rounded-bottom">
                <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card mb-4 p-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="mb-4">
                                    Product Detail
                                </h3>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="mb-0 text-title">
                                            Product Image :
                                        </h3>
                                        <div class="d-flex flex-wrap mb-2">
                                            <div class="d-flex flex-wrap mb-2">
                                                <div class="image-container">
                                                    <img id="imagePreview" src="{{ $product->image }}" onerror="this.onerror=null; this.src='https://cdn-icons-png.flaticon.com/256/8576/8576437.png';" alt="" class="image-max-width">
                                                </div>
                                                <input type="file" name="image" class="w-100 form-control" id="imageInput">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex flex-wrap mb-2">
                                            <h3 class="mb-2 text-title">
                                                Product Name :
                                            </h3>
                                            <input type="text" name="product_name" id="product_name" value="{{ $product->product_name }}" class="w-100 form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex flex-wrap mb-2">
                                            <h3 class="mb-2 text-title">
                                                Product Stock :
                                            </h3>
                                            <input type="text" name="product_quantity" id="product_quantity" value="{{ $product->product_quantity }}" class="w-100 form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex flex-wrap mb-2">
                                            <h3 class="mb-2 text-title">
                                                Product Price :
                                            </h3>
                                            <input type="text" name="price" id="price" value="{{ $product->price }}" class="w-100 form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex flex-wrap mb-2">
                                            <h3 class="mb-2 text-title">
                                                Product Category :
                                            </h3>
                                            <select name="category_name" id="category_name" class="w-100 form-control" style="text-transform: capitalize">
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->category_name }}" {{ $category->category_name == $product->category->category_name ? 'selected' : '' }}>
                                                        {{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    @if(session('warning'))
                        <div class="alert alert-warning mt-3" role="alert">
                            {{ session('warning') }}
                        </div>
                    @endif
                    <button type="submit" class="btn btn-success mt-4">
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>
    @section('js')
        <script>
            document.getElementById('imageInput').addEventListener('change', function(event) {
                var reader = new FileReader();
                reader.onload = function() {
                    var output = document.getElementById('imagePreview');
                    output.src = reader.result;
                };
                if (event.target.files[0]) {
                    reader.readAsDataURL(event.target.files[0]);
                }
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const priceInput = document.getElementById('price');

                priceInput.addEventListener('input', function () {
                    let value = this.value.replace(/\D/g, ''); // Remove non-digit characters
                    value = parseInt(value).toLocaleString('id-ID'); // Format number as currency
                    this.value = value;
                });

                // Initial formatting for the value loaded from the database
                let initialValue = priceInput.value.replace(/\D/g, ''); // Remove non-digit characters
                priceInput.value = parseInt(initialValue).toLocaleString('id-ID'); // Format number as currency
            });
        </script>
    @endsection
@endsection