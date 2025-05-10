@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <!-- Current Password Field -->
        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-gray-700">Current
                Password</label>
            <input id="update_password_current_password" name="current_password" type="password"
                class="mt-1 block w-full" autocomplete="current-password" />
            @error('current_password')
                <div class="mt-2 text-red-600 text-sm">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- New Password Field -->
        <div>
            <label for="update_password_password" class="block text-sm font-medium text-gray-700">New Password</label>
            <input id="update_password_password" name="password" type="password" class="mt-1 block w-full"
                autocomplete="new-password" />
            @error('password')
                <div class="mt-2 text-red-600 text-sm">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Password Confirmation Field -->
        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="mt-1 block w-full" autocomplete="new-password" />
            @error('password_confirmation')
                <div class="mt-2 text-red-600 text-sm">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex items-center gap-4">
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Save</button>

            @if (session('status') === 'password-updated')
                <p class="text-sm text-gray-600">Saved.</p>
            @endif
        </div>
    </form>
</section>
