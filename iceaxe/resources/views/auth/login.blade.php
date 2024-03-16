<x-native-cloud::layout.login>
    <x-native-cloud::layout.auth-card>
        <x-slot name="logo">
            <img src="{{ asset('img/tabassum.jpg') }}" alt="Logo" style="width: 100px; height: auto;">
        </x-slot>
        <x-native-cloud::utils.error :messages="$errors->get('email')" class="mt-2"/>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-group mb-3">
                <input type="text" name="email" class="form-control" value="{{old('email')}}"
                       placeholder="Email/Username">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" id="remember">
                        <label for="remember">
                            Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        <br>
        <hr>

    </x-native-cloud::layout.auth-card>
</x-native-cloud::layout.login>
