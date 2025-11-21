<x-guest-layout>

    <div class="container-fluid vh-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-12 d-flex flex-column justify-content-center align-items-center">

                <div class="card text-center p-5 w-100" style="max-width: 500px;">
                    <div class="brand-logo mb-3">
                        <img src="{{ asset('images/logo/logo-dark.svg') }}" >
                    </div>
                    <form method="POST" action="{{ route('password.store') }}" class="pt-3">
                        @csrf

                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="form-group">
                            <input id="email" class="form-control" type="email" name="email"
                                placeholder="Email" value="{{ old('email', $request->email) }}" required autofocus
                                autocomplete="username">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="password" class="form-control" type="password" placeholder="********"
                                name="password" required autocomplete="new-password">
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="password_confirmation" class="form-control" type="password"
                                placeholder="Confirm Password" name="password_confirmation" required
                                autocomplete="new-password">
                            @error('password_confirmation')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <x-primary-button :label="__('Reset Password')" class="mb-3 w-100" />
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>
