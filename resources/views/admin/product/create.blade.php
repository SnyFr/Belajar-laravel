@extends('admin.layouts.app')
@section('title', 'Create Product');
@section('subtitle', 'Create a new product from Panel Admin')

@section('content')
    <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="">Product Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="row">

            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="" class="form-label">Slug (Optional)</label>
                    <input type="text" name="slug" class="form-control">
                </div>
            </div>

            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="" class="form-label">Category</label>
                    <select name="category_id" class="form-select">
                        <option value="">--Choose Category --</option>
                        @foreach ($categories as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>

        <div class="mb-3">
            <label for="">Short Description</label>
            <input type="text" name="short_description" class="form-control">
        </div>
        <div class="mb-3">
            <label for="">Description</label>
            <textarea name="description" class="d-none form-control" cols="30" rows="10"></textarea>
            <div id="editor">{!! old('description') !!}</div>
        </div>

        {{-- Harga Bahan --}}
        <div class="row">

            <div class="col-sm-3">
                <div class="mb-3">
                    <label for="">Price</label>
                    <input type="number" name="price" class="form-control" step="1">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="mb-3">
                    <label for="">Art Cartoon Price</label>
                    <input type="number" name="price_art_cartoon" class="form-control" step="1">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="mb-3">
                    <label for="">Art Paper Price</label>
                    <input type="number" name="price_art_paper" class="form-control" step="1">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="mb-3">
                    <label for="">HVS Price</label>
                    <input type="number" name="price_hvs" class="form-control" step="1">
                </div>
            </div>

        </div>

        {{-- Harga Laminating --}}
        <div class="row">

            <div class="col-sm-3">
                <div class="mb-3">
                    <label for="" class="form-label">Laminating Doft Price</label>
                    <input type="number" name="price_doft" class="form-control" step="1">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="mb-3">
                    <label for="" class="form-label">Laminating Glossy Price</label>
                    <input type="number" name="price_glossy" class="form-control" step="1">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="mb-3">
                    <label for="" class="form-label">Cutting Price (min 5x5)</label>
                    <input type="number" name="price_cutting" class="form-control" step="1">
                </div>
            </div>
        </div>

        </div>

        <div class="mb-3">
            <label for="">Image</label>
            <input type="file" name="images[]" class="form-control" multiple>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn-custom btn-custom-primary">
                Save
            </button>
            <a href="{{ url()->previous() }}" class="btn-custom btn-custom-warning">Back</a>
        </div>

    </form>
@endsection
