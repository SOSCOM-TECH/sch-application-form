<x-guest-layout>

    <div class="container-fluid vh-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-12 d-flex flex-column justify-content-center align-items-center">

                <div class="card text-center p-5 w-100" style="max-width: 500px;">
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    <div class="brand-logo mb-3">
                        <img src="{{ asset('images/logo/logo-dark.svg') }}" style="height: 30px;">
                    </div>
                    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                    </div>

                    <form method="POST" action="{{ route('password.email') }}" class="pt-3">
                        @csrf

                        <div class="form-group">
                            <input id="email" class="form-control" type="email" name="email"
                                placeholder="Email" value="{{ old('email') }}" required autofocus
                                autocomplete="username">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <x-primary-button :label="__('Email Password Reset Link')" class="mb-3 w-100" />
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>
