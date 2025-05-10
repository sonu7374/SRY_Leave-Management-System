@extends('layouts.master')
@section('title')
    Leave Type
@endsection
@section('css')
    <!-- gridjs css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/gridjs/theme/mermaid.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
@endsection
@section('page-title')
    Leave Type
@endsection
@section('body')
    <style>
        .selected-row {
            background-color: red !important;
            /* Use !important if necessary */
        }
    </style>

    <body>
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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">View Leave Type</h5>
                        <a href="{{ route('leave-types.create') }}"><button class="btn btn-primary">Add Leave
                                Type</button></a>
                    </div>

                    <div class="card-body">
                        <div id="table-gridjs">
                            <div role="complementary" class="gridjs gridjs-container" style="width: 100%;">
                                <div class="gridjs-wrapper table responsive" style="height: auto;">
                                    <table role="grid" class="gridjs-table" style="height: auto;">
                                        <thead>
                                            <tr>
                                                <th>Action</th>
                                                <th data-column-id="sr" class="gridjs-th gridjs-th-sort" tabindex="0"
                                                    style="min-width: 200px; width: 204px;">
                                                    <div class="gridjs-th-content">Sr No</div><button tabindex="-1"
                                                        aria-label="Sort column ascending" title="Sort column ascending"
                                                        class="gridjs-sort gridjs-sort-neutral"></button>
                                                </th>
                                                <th data-column-id="name" class="gridjs-th gridjs-th-sort" tabindex="0"
                                                    style="min-width: 200px; width: 204px;">
                                                    <div class="gridjs-th-content"> Name </div><button tabindex="-1"
                                                        aria-label="Sort column ascending" title="Sort column ascending"
                                                        class="gridjs-sort gridjs-sort-neutral"></button>
                                                </th>
                                                <th data-column-id="max_days" class="gridjs-th gridjs-th-sort"
                                                    tabindex="0" style="min-width: 200px; width: 204px;">
                                                    <div class="gridjs-th-content">Max Days</div><button tabindex="-1"
                                                        aria-label="Sort column ascending" title="Sort column ascending"
                                                        class="gridjs-sort gridjs-sort-neutral"></button>
                                                </th>
                                                <th data-column-id="carry_forward" class="gridjs-th gridjs-th-sort"
                                                    tabindex="0" style="min-width: 200px; width: 204px;">
                                                    <div class="gridjs-th-content">Carry Forward</div><button tabindex="-1"
                                                        aria-label="Sort column ascending" title="Sort column ascending"
                                                        class="gridjs-sort gridjs-sort-neutral"></button>
                                                </th>

                                                <th data-column-id="descrption" class="gridjs-th gridjs-th-sort"
                                                    tabindex="0" style="min-width: 200px; width: 204px;">
                                                    <div class="gridjs-th-content">Description</div><button tabindex="-1"
                                                        aria-label="Sort column ascending" title="Sort column ascending"
                                                        class="gridjs-sort gridjs-sort-neutral"></button>
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $count = 1;
                                            @endphp
                                            @foreach ($leaveTypes as $leaveType)
                                                <tr>
                                                    <td>
                                                        <div class="d-inline-flex gap-2">
                                                            <!-- Edit Button -->
                                                            <button class="btn btn-primary btn-sm"
                                                                onclick="openEditModal(this)" data-id="{{ $leaveType->id }}"
                                                                data-name="{{ $leaveType->name }}"
                                                                data-max_days="{{ $leaveType->max_days }}"
                                                                data-carry_forward="{{ $leaveType->carry_forward }}"
                                                                data-description="{{ $leaveType->description }}">
                                                                <i class="fas fa-edit"></i>
                                                            </button>

                                                            <!-- Delete Button -->
                                                            <form
                                                                action="{{ route('leave-types.destroy', $leaveType->id) }}"
                                                                method="POST" onsubmit="return confirm('Are you sure?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-sm btn-danger">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>



                                                    <td data-column-id="sr">{{ $count++ }}</td>
                                                    <td data-column-id="name">
                                                        {{ $leaveType->name }}</td>
                                                    <td data-column-id="max_days">
                                                        {{ $leaveType->max_days }}</td>
                                                    <td data-column-id="carry_forward">
                                                        @if ($leaveType->carry_forward == 1)
                                                            Yes
                                                        @else
                                                            No
                                                        @endif
                                                    </td>
                                                    <td data-column-id="description">
                                                        {{ $leaveType->description }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                                <div class="d-flex justify-content-end">

                                </div>

                                <div id="gridjs-temp" class="gridjs-temp"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->




        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Leave Type</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="editLeaveForm">
                            @csrf
                            @method('PUT')

                            <input type="hidden" id="leaveTypeId" name="leaveTypeId">

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Leave Type Name</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="col-md-6">
                                    <label for="max_days" class="form-label">Max Days</label>
                                    <input type="number" class="form-control" id="max_days" name="max_days"
                                        min="0">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="carry_forward" class="form-label">Carry Forward</label>
                                    <select class="form-control" id="carry_forward" name="carry_forward">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary w-md">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        <!-- gridjs js -->
        <script src="{{ URL::asset('build/libs/gridjs/gridjs.umd.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/gridjs.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>

        <script>
            function openEditModal(button) {
                const id = button.dataset.id;
                const name = button.dataset.name;
                const maxDays = button.dataset.max_days;
                const carryForward = button.dataset.carry_forward;
                const description = button.dataset.description;

                // Fill modal inputs
                document.getElementById('leaveTypeId').value = id;
                document.getElementById('name').value = name;
                document.getElementById('max_days').value = maxDays;
                document.getElementById('carry_forward').value = carryForward;
                document.getElementById('description').value = description;

                // Set the form action dynamically
                const form = document.getElementById('editLeaveForm');
                form.action = `/leave-types/${id}`;

                // Show modal
                const modal = new bootstrap.Modal(document.getElementById('editModal'));
                modal.show();
            }
            document.addEventListener('DOMContentLoaded', function() {
                const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;

                const comparer = (idx, asc) => (a, b) => ((v1, v2) =>
                    v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
                )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

                document.querySelectorAll('.gridjs-th').forEach(th => th.addEventListener('click', function() {
                    const table = th.closest('table');
                    Array.from(table.querySelectorAll('tbody > tr'))
                        .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this
                            .asc))
                        .forEach(tr => table.querySelector('tbody').appendChild(tr));
                }));
            });
        </script>
    @endsection
