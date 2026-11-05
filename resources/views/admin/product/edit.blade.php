@extends('admin.layouts.app')
@section('title', 'Edit Product');
@section('subtitle', 'Edit product information from Panel Admin')

@section('content')
    <form action="{{ route('admin.product.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="">Product Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}">
        </div>

        <div class="row">

            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="" class="form-label">Slug (Optional)</label>
                    <input type="text" name="slug" class="form-control" value="{{ old('slug', $product->slug) }}">
                </div>
            </div>

            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="" class="form-label">Category</label>
                    <select name="category_id" class="form-select">
                        <option value="">--Choose Category --</option>
                        @foreach ($categories as $c)
                            <option value="{{ $c->id }}" {{ old('category_id', $product->category_id) == $c->id ? 'selected' : '' }}>
                                {{ $c->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>

        <div class="mb-3">
            <label for="">Short Description</label>
            <input type="text" name="short_description" class="form-control" value="{{ old('short_description', $product->short_description) }}">
        </div>
        <div class="mb-3">
            <label for="">Description</label>
            <textarea name="description" class="d-none form-control" cols="30" rows="10">{{ old('description', $product->description) }}</textarea>
            <div id="editor">{!! old('description', $product->description) !!}</div>
        </div>

        {{-- Harga Bahan --}}
        <div class="row">

            <div class="col-sm-3">
                <div class="mb-3">
                    <label for="">Price</label>
                    <input type="number" name="price" class="form-control" step="1" value="{{ old('price', $product->price) }}">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="mb-3">
                    <label for="">Art Cartoon Price</label>
                    <input type="number" name="price_art_cartoon" class="form-control" step="1" value="{{ old('price_art_cartoon', $product->price_art_cartoon) }}">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="mb-3">
                    <label for="">Art Paper Price</label>
                    <input type="number" name="price_art_paper" class="form-control" step="1" value="{{ old('price_art_paper', $product->price_art_paper) }}">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="mb-3">
                    <label for="">HVS Price</label>
                    <input type="number" name="price_hvs" class="form-control" step="1" value="{{ old('price_hvs', $product->price_hvs) }}">
                </div>
            </div>

        </div>

        {{-- Harga Laminating --}}
        <div class="row">

            <div class="col-sm-3">
                <div class="mb-3">
                    <label for="" class="form-label">Laminating Doft Price</label>
                    <input type="number" name="price_doft" class="form-control" step="1" value="{{ old('price_doft', $product->price_doft) }}">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="mb-3">
                    <label for="" class="form-label">Laminating Glossy Price</label>
                    <input type="number" name="price_glossy" class="form-control" step="1" value="{{ old('price_glossy', $product->price_glossy) }}">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="mb-3">
                    <label for="" class="form-label">Cutting Price (min 5x5)</label>
                    <input type="number" name="price_cutting" class="form-control" step="1" value="{{ old('price_cutting', $product->price_cutting) }}">
                </div>
            </div>
        </div>

        </div>

        <div class="mb-3">
            <label for="">Image</label>
            <input type="file" name="image" class="form-control">
            @if ($product->image)
                <div class="mt-2">
                    <p class="mb-1">Current image:</p>
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                        style="max-width: 200px; height: auto;">
                </div>
            @endif
        </div>

        <div class="mb-3">
            <button type="submit" class="btn-custom btn-custom-primary">
                Save
            </button>
            <a href="{{ url()->previous() }}" class="btn-custom btn-custom-warning">Back</a>
        </div>

    </form>
@endsection
