@extends('admin.layouts.app')
@section('title', 'Edit User');
@section('subtitle', 'Buat Akun Baru dengan Akses ke Panel Admin')

@section('content')
    <form action="{{ route('admin.user.update', $user) }}" method="post">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label for="" class="form-label-custom">Full Name *</label>
        <input type="text" class="form-control" name="name" required value="{{ old('name', $user->name) }}">
        @error('name')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="" class="form-label-custom">Email *</label>
        <input type="text" class="form-control" name="email" required {{ old('email', $user->email) }}>
        @error('email')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="" class="form-label-custom">Password Baru</label>
        <input type="password" class="form-control" name="password">
        <div class="form-text">
          <small>Leave this blank if you want to change your password. Fill it in only if you want to use a new password.</small>
        </div>
        @error('password')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <button type="submit" class="btn-custom btn-custom-primary">Save Changes</button>
      </div>
    </form>
@endsection