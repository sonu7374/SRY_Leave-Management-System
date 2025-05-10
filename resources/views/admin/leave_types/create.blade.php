@extends('admin.layouts.master')

@section('title')
    Admin Dashboard | Leave Type
@endsection

@section('css')
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page-title')
    Hello
@endsection

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
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Leave Type</h4>
                    <a href="{{ route('leave-types.index') }}">
                        <button class="btn btn-primary">View</button>
                    </a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('leave-types.store') }}">
                        @csrf

                        <!-- Leave Type -->
                        <div class="mb-4">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <!-- From Date -->
                        <div class="mb-4">
                            <label for="max_days" class="form-label">Max Days</label>
                            <input id="max_days" class="form-control" type="number" name="max_days" required />
                        </div>

                        <!-- To Date -->
                        <div class="mb-4">
                            <label for="to_date" class="form-label">Carry Forward</label>
                            <select name="carry_forward" class="form-select">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <!-- Reason -->
                        <div class="mb-4">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" name="description" rows="3" class="form-control"></textarea>

                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button class="btn btn-primary">
                                Submit Request
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            CKEDITOR.replace('editor1');
            CKEDITOR.replace('editor2');
        });
    </script>






    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/dashboard.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
