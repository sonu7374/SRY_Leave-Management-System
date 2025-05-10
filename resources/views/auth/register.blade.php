<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Management Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .left-img {
            background: url('{{ asset('assets/login.jpg') }}') no-repeat center center;
            background-size: cover;
        }
    </style>
</head>

<body class="vh-100 overflow-hidden">
    <div class="container-fluid h-100">
        <div class="row h-100">

            <!-- Left Side Image -->
            <div class="col-md-6 left-img position-relative d-none d-md-block">
                <!-- Overlay text -->
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
                    style="background-color: rgba(0,0,0,0.4);">
                    <h1 class="text-white fw-bold display-4 text-center px-4">
                        Leave Management System
                    </h1>
                </div>
            </div>

            <!-- Right Side Form -->
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <div class="w-75">
                    <h2 class="text-center text-primary fw-bold mb-4">Register Yourself</h2>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Register As -->
                        <div class="mb-3">
                            <label for="role" class="form-label">Register As</label>
                            <select id="role" name="role" class="form-select" required>
                                <option value="employee">Employee</option>
                                <option value="manager">Manager</option>
                            </select>
                        </div>

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input id="name" type="text" name="name" class="form-control"
                                value="{{ old('name') }}" required autofocus autocomplete="name">
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" name="email" class="form-control"
                                value="{{ old('email') }}" required autocomplete="username">
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" name="password" class="form-control" required
                                autocomplete="new-password">
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                class="form-control" required autocomplete="new-password">
                        </div>
                        <a href="/">
                            <p>Already Sign up ?</p>
                        </a>
                        <!-- Submit Button -->
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary w-100">Register</button>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
</body>

</html>
