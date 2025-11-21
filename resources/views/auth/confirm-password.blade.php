<x-guest-layout>

    <div class="container-fluid vh-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-12 d-flex flex-column justify-content-center align-items-center">

                <div class="card text-center p-5 w-100" style="max-width: 500px;">
                    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                    </div>

                    <form method="POST" action="{{ route('password.confirm') }}" class="pt-3">
                        @csrf

                        <div class="form-group">
                            <input id="password" class="form-control" type="password" name="password"
                                placeholder="Password" required autocomplete="current-password">
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <x-primary-button :label="__('Confirm')" class="mb-3 w-100" />
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>
