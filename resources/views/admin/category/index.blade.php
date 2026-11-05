@extends('admin.layouts.app')
@section('title', 'Category Management')
@section('subtitle', 'Manages categories in the system')

@section('content')
    <div class="mb-3" align="right">
        <a href="{{ route('admin.category.create') }}" class="btn-table-action">
            <i class="bi bi-person-add"></i>Create Category
        </a>
    </div>
    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Sort Order</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($categories as $key => $data)
                    <tr>
                        <td>{{ $key += 1 }}</td>
                        <td>{{ $data->name ?? '' }}</td>
                        <td>{{ $data->slug ?? '' }}</td>
                        <td>{{ $data->sort_order ?? '' }}</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <a class="table-btn-action" title="Edit"
                                    href="{{ route('admin.category.edit', $data->id) }}">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.category.destroy', $data->id) }}" method="post"
                                    onsubmit="return confirm('Are you sure want to delete this ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="table-btn-action delete" title="Delete" type="submit">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
