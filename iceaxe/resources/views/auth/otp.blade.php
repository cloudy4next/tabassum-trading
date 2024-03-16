<x-native::layout.login>
    <x-native::layout.auth-card>
        <x-slot name="logo">
            <img src="{{ asset('img/BL.png') }}" alt="Logo" style="width: 200px; height: auto;">
        </x-slot>
        <div class="text-center">
            <h2 class="mb-3">OTP Verification</h2>
        </div>

        <form method="POST" action="{{ route('otp.verify') }}">
            @csrf

            <div class="mb-3">
                <input id="otp" class="form-control" type="number" name="otp" :value="old('otp')"
                    placeholder="Enter OTP" required>
            </div>

            <div class="d-grid mb-3">
                <button class="btn btn-primary w-100" type="submit">Submit</button>
            </div>

        </form>

    </x-native::layout.auth-card>
</x-native::layout.login>
