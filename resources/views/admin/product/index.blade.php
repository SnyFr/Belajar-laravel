@extends('admin.layouts.app')
@section('title', 'Management Product')
@section('subtitle', 'List of all products in the system')
@section('content')
    <div align="right">
        <a href="{{ route('admin.product.create') }}" class="btn-table-action">
            <i class="bi bi-plus-circle-fill"></i> Create Product
        </a>
    </div>
    <div class="table-responsive mt-1">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Category</th>
                    <th>Product Name</th>
                    <th>Slug</th>
                    <th>Image</th>
                    <th>Short Description</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- @dd($products) --}}
                @foreach ($products as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->category->name }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->slug }}</td>
                        <td>
                            @if ($item->image !== null)
                            <img src="{{ asset('storage/' . $item->image) }}" width="200" alt="">
                            @else
                            <span>Image not available!</span>
                            @endif
                        </td>
                        <td>{{ $item->short_description }}</td>
                        <td>{{ $item->description }}</td>
                        <td>Rp. {{ number_format($item->price, 2, ',', '.') }}</td>
                        <td>
                            <a class="table-btn-action" title="Edit" href="{{ route('admin.product.edit', $item->id) }}">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.product.destroy', $item->id) }}" method="post" class="d-inline"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="table-btn-action delete" title="Delete" type="submit">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection