<div class="min-h-screen flex justify-center">
    <div class="sm:max-w-sm sm:mx-auto mx-4 py-8 space-y-6">
        <figure>
            <a wire:navigate href="{{ route('home') }}">
                <img loading="lazy" class="w-48 mx-auto" src="{{ asset('img/logo.png') }}" alt="Mihir logo">
            </a>
        </figure>
        <h1 class="text-center text-xl font-semibold">
            {{ __('misc.login') }}
        </h1>
        <x-socialite-auth />
        <div class="divider dark:divider-primary text-sm">
            {{ __('misc.or') }}
        </div>
        <form wire:submit="login" class="space-y-2">
            <x-honeypot livewire-model="extraFields" />

            <label class="form-control w-full">
                <div class="label">
                    <span>{{ __('account.email') }}</span>
                </div>
                <input wire:model="form.email" id="email"
                    class="input input-bordered focus:outline-none focus:border-2 focus:border-primary h-10 dark:bg-stone-900"
                    type="email" name="email" required autofocus autocomplete="username" />
                @error('form.email')
                    <div class="text-sm text-red-500 mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </label>

            <label class="form-control w-full">
                <div class="label">
                    <span>{{ __('misc.password') }}</span>
                </div>
                <input wire:model="form.password" id="password"
                    class="input input-bordered focus:outline-none focus:border-2 focus:border-primary h-10 dark:bg-stone-900"
                    type="password" name="password" required autocomplete="current-password" />
                @error('form.password')
                    <div class="text-sm text-red-500 mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </label>

            <div class="flex flex-col items-center justify-between !mt-4">
                <label for="remember" class="inline-flex items-center">
                    <input wire:model="form.remember" id="remember" type="checkbox"
                        class="checkbox checkbox-sm checkbox-primary" name="remember">
                    <span class="ms-2 text-sm opacity-60">{{ __('misc.remember_me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="link text-sm opacity-60" href="{{ route('password.request') }}" wire:navigate>
                        {{ __('misc.forgot_password') }}
                    </a>
                @endif
            </div>
            <div class="flex items-center justify-end !mt-8">
                <button
                    class="btn bg-primary border-none text-white hover:bg-primary hover:brightness-90 w-full disabled:bg-primary disabled:opacity-70 disabled:text-white">
                    {{ __('misc.login') }}
                </button>
            </div>
        </form>
        <div class="text-sm text-center">
            <span>{{ __('misc.dont_have_an_account') }}</span>
            <a wire:navigate class="link text-primary font-bold" href="{{ route('register') }}">
                {{ __('misc.sign_up') }}
            </a>
        </div>
    </div>
</div>
