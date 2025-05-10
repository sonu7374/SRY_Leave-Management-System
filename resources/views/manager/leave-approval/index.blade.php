@extends('manager.layouts.master')
@section('title')
    Leave Request Approval
@endsection
@section('css')
    <!-- gridjs css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/gridjs/theme/mermaid.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
@endsection
@section('page-title')
    Leave Request Approval
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
                        <h5 class="card-title mb-0">View Leave Request Approval</h5>
                    </div>

                    <div class="card-body">
                        <div id="table-gridjs">
                            <div role="complementary" class="gridjs gridjs-container" style="width: 100%;">
                                <div class="gridjs-wrapper table responsive" style="height: auto;">
                                    <table role="grid" class="gridjs-table" style="height: auto;">
                                        <thead>
                                            <tr>
                                                <th data-column-id="ation" class="gridjs-th gridjs-th-sort" tabindex="0"
                                                    style="min-width: 200px; width: 204px;">
                                                    <div class="gridjs-th-content">Action</div><button tabindex="-1"
                                                        aria-label="Sort column ascending" title="Sort column ascending"
                                                        class="gridjs-sort gridjs-sort-neutral"></button>
                                                </th>
                                                <th data-column-id="sr" class="gridjs-th gridjs-th-sort" tabindex="0"
                                                    style="min-width: 200px; width: 204px;">
                                                    <div class="gridjs-th-content">Sr No</div><button tabindex="-1"
                                                        aria-label="Sort column ascending" title="Sort column ascending"
                                                        class="gridjs-sort gridjs-sort-neutral"></button>
                                                </th>
                                                <th data-column-id="leave_type" class="gridjs-th gridjs-th-sort"
                                                    tabindex="0" style="min-width: 200px; width: 204px;">
                                                    <div class="gridjs-th-content"> Leave Type </div><button tabindex="-1"
                                                        aria-label="Sort column ascending" title="Sort column ascending"
                                                        class="gridjs-sort gridjs-sort-neutral"></button>
                                                </th>
                                                <th data-column-id="from" class="gridjs-th gridjs-th-sort" tabindex="0"
                                                    style="min-width: 200px; width: 204px;">
                                                    <div class="gridjs-th-content">From</div><button tabindex="-1"
                                                        aria-label="Sort column ascending" title="Sort column ascending"
                                                        class="gridjs-sort gridjs-sort-neutral"></button>
                                                </th>
                                                <th data-column-id="to" class="gridjs-th gridjs-th-sort" tabindex="0"
                                                    style="min-width: 200px; width: 204px;">
                                                    <div class="gridjs-th-content">To</div><button tabindex="-1"
                                                        aria-label="Sort column ascending" title="Sort column ascending"
                                                        class="gridjs-sort gridjs-sort-neutral"></button>
                                                </th>

                                                <th data-column-id="reason" class="gridjs-th gridjs-th-sort" tabindex="0"
                                                    style="min-width: 200px; width: 204px;">
                                                    <div class="gridjs-th-content">Reason</div><button tabindex="-1"
                                                        aria-label="Sort column ascending" title="Sort column ascending"
                                                        class="gridjs-sort gridjs-sort-neutral"></button>
                                                </th>
                                                <th data-column-id="status" class="gridjs-th gridjs-th-sort" tabindex="0"
                                                    style="min-width: 200px; width: 204px;">
                                                    <div class="gridjs-th-content">Status</div><button tabindex="-1"
                                                        aria-label="Sort column ascending" title="Sort column ascending"
                                                        class="gridjs-sort gridjs-sort-neutral"></button>
                                                </th>
                                                <th data-column-id="leave_request" class="gridjs-th gridjs-th-sort"
                                                    tabindex="0" style="min-width: 200px; width: 204px;">
                                                    <div class="gridjs-th-content">No of Leave Request</div><button
                                                        tabindex="-1" aria-label="Sort column ascending"
                                                        title="Sort column ascending"
                                                        class="gridjs-sort gridjs-sort-neutral"></button>
                                                </th>
                                                <th data-column-id="alloted_leave" class="gridjs-th gridjs-th-sort"
                                                    tabindex="0" style="min-width: 200px; width: 204px;">
                                                    <div class="gridjs-th-content">Alloted Leave</div><button
                                                        tabindex="-1" aria-label="Sort column ascending"
                                                        title="Sort column ascending"
                                                        class="gridjs-sort gridjs-sort-neutral"></button>
                                                </th>
                                                <th data-column-id="used_days" class="gridjs-th gridjs-th-sort"
                                                    tabindex="0" style="min-width: 200px; width: 204px;">
                                                    <div class="gridjs-th-content">Used Days</div><button tabindex="-1"
                                                        aria-label="Sort column ascending" title="Sort column ascending"
                                                        class="gridjs-sort gridjs-sort-neutral"></button>
                                                </th>
                                                <th data-column-id="remaining" class="gridjs-th gridjs-th-sort"
                                                    tabindex="0" style="min-width: 200px; width: 204px;">
                                                    <div class="gridjs-th-content">Remaining Days</div><button
                                                        tabindex="-1" aria-label="Sort column ascending"
                                                        title="Sort column ascending"
                                                        class="gridjs-sort gridjs-sort-neutral"></button>
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $count = 1;
                                            @endphp
                                            @foreach ($leaveRequests as $leaveRequest)
                                                <tr>
                                                    <td>
                                                        <div class="d-inline-flex gap-2">
                                                            <!-- Edit Button -->
                                                            <form
                                                                action="{{ route('manager-leave-approval.update', $leaveRequest->id) }}"
                                                                method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="action" value="approve">
                                                                <button class="btn btn-success btn-sm"
                                                                    onclick="return confirm('Approve this leave?')">Approve</button>
                                                            </form>

                                                            <form
                                                                action="{{ route('manager-leave-approval.update', $leaveRequest->id) }}"
                                                                method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="action" value="reject">
                                                                <button class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Reject this leave?')">Reject</button>
                                                            </form>


                                                        </div>
                                                    </td>



                                                    <td data-column-id="sr">{{ $count++ }}</td>
                                                    <td data-column-id="leave_type">
                                                        {{ $leaveRequest->leaveType->name }}</td>
                                                    <td data-column-id="from">
                                                        {{ $leaveRequest->start_date }}</td>
                                                    <td data-column-id="to">
                                                        {{ $leaveRequest->end_date }}

                                                    </td>
                                                    <td data-column-id="reason">
                                                        {{ $leaveRequest->reason }}</td>
                                                    <td data-column-id="status">
                                                        {{ $leaveRequest->status }}</td>
                                                    <td data-column-id="leave_request">
                                                        {{ $leaveRequest->total_days }}</td>
                                                    <td data-column-id="alloted_leave">
                                                        {{ $leaveRequest->allocated_days }}

                                                    </td>
                                                    <td data-column-id="used_days">
                                                        {{ $leaveRequest->used_days }}</td>
                                                    <td data-column-id="remaining">
                                                        {{ $leaveRequest->remaining_days }}</td>
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




        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="leaveRequestModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Leave Request</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="editLeaveForm">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="leaveRequestId" name="leaveRequestId">

                            <div class="row">

                                <div class="col-md-6">
                                    <label for="edit_start_date" class="form-label">Start Date</label>
                                    <input type="date" class="form-control" id="edit_start_date" name="start_date">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="edit_end_date" class="form-label">End Date</label>
                                    <input type="date" class="form-control" id="edit_end_date" name="end_date">
                                </div>
                                <div class="col-md-6">
                                    <label for="edit_reason" class="form-label">Reason</label>
                                    <textarea class="form-control" id="edit_reason" name="reason" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary w-md">Update</button>
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
                const leaveTypeId = button.dataset.leave_type; // ID, not name
                const startDate = button.dataset.max_days;
                const endDate = button.dataset.carry_forward;
                const reason = button.dataset.description;

                document.getElementById('leaveRequestId').value = id;
                document.getElementById('edit_leave_type').value = leaveTypeId;
                document.getElementById('edit_start_date').value = startDate;
                document.getElementById('edit_end_date').value = endDate;
                document.getElementById('edit_reason').value = reason;

                const form = document.getElementById('editLeaveForm');
                form.action = `/leave-requests/${id}`;

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
