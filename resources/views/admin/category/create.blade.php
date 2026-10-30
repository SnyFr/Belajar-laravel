@extends('admin.layouts.app')
@section('title', 'Create Category');
@section('subtitle', 'Create a new category from Panel Admin')

@section('content')
    <form action="{{ route('admin.category.store') }}" method="post">
      @csrf

      <div class="mb-3">
        <label for="" class="form-label-custom">Category Name *</label>
        <input type="text" class="form-control" name="name" required value="{{ old('name') }}">
        @error('name')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="" class="form-label-custom">Email *</label>
        <input type="text" class="form-control" name="email" required {{ old('email') }}>
        @error('email')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="" class="form-label-custom">Password *</label>
        <input type="password" class="form-control" name="password" required>
        @error('password')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <button type="submit" class="btn-custom btn-custom-primary">Save</button>
      </div>
    </form>
@endsection