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

                        <div class="col-md-12">
                            <form action="{{ route('category.update', $category->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="d-flex flex-wrap mb-2">
                                            <h3 class="mb-0 text-title w-100 mb-3">
                                                Category Name :
                                            </h3>
                                            <input class="form-control" name="category_name" required value="{{ $category->category_name }}">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection