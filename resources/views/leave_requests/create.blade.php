@extends('layouts.master')

@section('title')
    Dashboard | Great Work
@endsection

@section('css')
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page-title')
    Hello
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Leave Request</h4>
                    <a href="{{ route('leave-requests.index') }}">
                        <button class="btn btn-primary">View</button>
                    </a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('leave-requests.store') }}">
                        @csrf

                        <!-- Leave Type -->
                        <div class="mb-4">
                            <label for="leave_type" class="form-label">Leave Type</label>
                            <select id="leave_type" name="leave_type" class="form-select" required>
                                <option value="">Select Leave Type</option>
                                @foreach ($leaveTypes as $leaveType)
                                    <option value="{{ $leaveType->id }}">{{ $leaveType->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- From Date -->
                        <div class="mb-4">
                            <label for="from_date" class="form-label">From Date</label>
                            <input id="from_date" class="form-control" type="date" name="from_date" required />
                        </div>

                        <!-- To Date -->
                        <div class="mb-4">
                            <label for="to_date" class="form-label">To Date</label>
                            <input id="to_date" class="form-control" type="date" name="to_date" required />
                        </div>

                        <!-- Reason -->
                        <div class="mb-4">
                            <label for="reason" class="form-label">Reason</label>
                            <textarea id="reason" name="reason" rows="3" class="form-control">{{ old('reason') }}</textarea>
                            <x-input-error :messages="$errors->get('reason')" class="mt-2" />
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
