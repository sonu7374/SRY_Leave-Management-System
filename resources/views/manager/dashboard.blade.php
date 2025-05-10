@php
    use Illuminate\Support\Facades\Auth;
    $infos = Auth::user();
    //dd($infos);
@endphp
<script>
    window.Laravel = {!! json_encode([
        'userId' => auth()->user()->id,
    ]) !!};
</script>

@extends('manager.layouts.master')
@section('title')
    Manager Dashboard
@endsection
@section('css')
    <!-- jsvectormap css -->
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    Manager Dashboard
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="user-profile-img">
                                <img class="profile-img profile-foreground-img rounded-top" style="height: 120px;"
                                    alt="">
                                <div class="overlay-content rounded-top">
                                    <div>
                                        <div class="user-nav p-3">
                                            <div class="d-flex justify-content-end">
                                                <div class="dropdown">
                                                    <a class="text-muted dropdown-toggle font-size-16" href="#"
                                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="bx bx-dots-vertical text-white font-size-20"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="">Edit</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            @if ($infos)
                                <!-- end user-profile-img -->
                                <div class="p-4 pt-0">
                                    <div class="mt-n5 position-relative text-center border-bottom pb-3">
                                        @if ($infos->image)
                                            <img src="{{ asset('assets/profile/' . $infos->image) }}" alt="Profile Image"
                                                class="avatar-xl rounded-circle img-thumbnail">
                                        @else
                                            <img src="{{ asset('assets/lms_logo.png') }}" alt="Company Logo"
                                                class="avatar-xl rounded-circle img-thumbnail">
                                        @endif


                                        <div class="mt-3">
                                            <h5 class="mb-1 text-capitalize">{{ $infos->name ?? 'N/A' }} </h5>
                                            <p class="text-muted mb-0">
                                                <i class="bx bxs-star text-warning font-size-14"></i>
                                                <i class="bx bxs-star text-warning font-size-14"></i>
                                                <i class="bx bxs-star text-warning font-size-14"></i>
                                                <i class="bx bxs-star text-warning font-size-14"></i>
                                                <i class="bx bxs-star-half text-warning font-size-14"></i>
                                            </p>
                                            @php
                                                $totalFields = 9;
                                                $completedFields = 0;

                                                if (!empty($infos->image)) {
                                                    $completedFields++;
                                                }
                                                if (!empty($infos->linkedin)) {
                                                    $completedFields++;
                                                }
                                                if (!empty($infos->address)) {
                                                    $completedFields++;
                                                }
                                                if (!empty($infos->instagram)) {
                                                    $completedFields++;
                                                }
                                                if (!empty($infos->phone_no)) {
                                                    $completedFields++;
                                                }
                                                if (!empty($infos->whats_app)) {
                                                    $completedFields++;
                                                }
                                                if (!empty($infos->facebook)) {
                                                    $completedFields++;
                                                }
                                                if (!empty($infos->name)) {
                                                    $completedFields++;
                                                }
                                                if (!empty($infos->email)) {
                                                    $completedFields++;
                                                }

                                                $completionPercent = intval(($completedFields / $totalFields) * 100);
                                            @endphp

                                            @if ($completionPercent < 100)
                                                <div class="text-center mt-4">


                                                    <div
                                                        style="width: 120px; height: 120px; margin: 0 auto; position: relative;">
                                                        <svg width="120" height="120">
                                                            <circle cx="60" cy="60" r="54" stroke="#e6e6e6"
                                                                stroke-width="10" fill="none" />
                                                            <circle cx="60" cy="60" r="54" stroke="#4caf50"
                                                                stroke-width="10" fill="none" stroke-dasharray="339.29"
                                                                stroke-dashoffset="{{ 339.29 - (339.29 * $completionPercent) / 100 }}"
                                                                stroke-linecap="round" transform="rotate(-90 60 60)" />
                                                        </svg>
                                                        <div
                                                            style="position: absolute; top: 35px; left: 0; right: 0; text-align: center;">
                                                            <strong>{{ $completionPercent }}%</strong><br>
                                                            <small>Complete</small>
                                                        </div>
                                                    </div>
                                                    <a href="{{ route('profile.edit') }}"
                                                        class="btn btn-primary mb-3">Complete Your Profile</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="table-responsive mt-3 border-bottom pb-3">
                                        <table
                                            class="table align-middle table-sm table-nowrap table-borderless table-centered mb-0">
                                            <tbody>
                                                @if (!empty($infos->name))
                                                    <tr>
                                                        <th class="fw-bold">Name :</th>
                                                        <td class="text-muted">{{ $infos->name }}</td>
                                                    </tr>
                                                @endif

                                                @if (!empty($infos->email))
                                                    <tr>
                                                        <th class="fw-bold">Email :</th>
                                                        <td class="text-muted">{{ $infos->email }}</td>
                                                    </tr>
                                                @endif

                                                @if (!empty($infos->role))
                                                    <tr>
                                                        <th class="fw-bold">Role :</th>
                                                        <td class="text-muted">{{ $infos->role }}</td>
                                                    </tr>
                                                @endif


                                            </tbody>
                                        </table>
                                    </div>




                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>

    @endsection
</body>
@section('scripts')
    <!-- apexcharts -->
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Vector map-->
    <script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>

    <script src="{{ URL::asset('build/js/pages/dashboard.init.js') }}"></script>
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>

    <!-- Laravel Echo and Pusher -->
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
        // Include Echo from CDN
        window.Pusher = Pusher;

        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: "{{ env('VITE_PUSHER_APP_KEY') }}",
            cluster: "{{ env('VITE_PUSHER_APP_CLUSTER') }}",
            forceTLS: true
        });

        Echo.private(`App.Models.User.${window.Laravel.userId}`)
            .notification((notification) => {
                console.log('🔔 Notification received:', notification);

                alert(`🔔 New Notification: ${notification.message || 'You have a new notification!'}`);
            });
    </script>
@endsection
