@extends('layouts.master')

@section('title', 'Edit Profile')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <strong>✔ Success:</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Error Message (Red) --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
            <strong>⛔ Error:</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container py-5">
        <h2 class="mb-4">Profile</h2>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header">Update Profile Information</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input id="name" class="form-control" type="text" name="name"
                                    value="{{ old('name', auth()->user()->name) }}" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" class="form-control" type="email" name="email"
                                    value="{{ old('email', auth()->user()->email) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="phone_no" class="form-label">Phone Number</label>
                                <input id="phone_no" class="form-control" type="text" name="phone_no"
                                    value="{{ old('phone_no', auth()->user()->phone_no) }}">
                            </div>
                            <div class="mb-3">
                                <label for="whats_app" class="form-label">Whats App Number</label>
                                <input id="whats_app" class="form-control" type="text" name="whats_app"
                                    value="{{ old('whats_app', auth()->user()->whats_app) }}">
                            </div>


                            <div class="mb-3">
                                <label for="linkedin" class="form-label">LinkedIn</label>
                                <input id="linkedin" class="form-control" type="text" name="linkedin"
                                    value="{{ old('linkedin', auth()->user()->linkedin) }}">
                            </div>

                            <div class="mb-3">
                                <label for="instagram" class="form-label">Instagram</label>
                                <input id="instagram" class="form-control" type="text" name="instagram"
                                    value="{{ old('instagram', auth()->user()->instagram) }}">
                            </div>
                            <div class="mb-3">
                                <label for="facebook" class="form-label">Facebook</label>
                                <input id="facebook" class="form-control" type="text" name="facebook"
                                    value="{{ old('facebook', auth()->user()->facebook) }}">
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea id="address" class="form-control" name="address">{{ old('address', auth()->user()->address) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Profile Image</label>
                                <input id="image" class="form-control" type="file" name="image">
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header">Update Password</div>
                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
