<div class="min-h-screen flex justify-center">
    <div class="sm:max-w-sm sm:mx-auto mx-4 py-8 space-y-6">
        <figure>
            <a wire:navigate href="{{ route('home') }}">
                <img loading="lazy" class="w-48 mx-auto" src="{{ asset('img/logo.png') }}" alt="Mihir logo">
            </a>
        </figure>
        <h1 class="text-center text-xl font-semibold">
            {{ __('misc.sign_up') }}
        </h1>
        <x-socialite-auth />
        <div class="divider dark:divider-primary text-sm">OR</div>
        <form wire:submit="register" class="space-y-2">
            <x-honeypot livewire-model="extraFields" />

            <label class="form-control w-full">
                <div class="label">
                    <span>{{ __('account.name') }}</span>
                </div>
                <input wire:model="name" id="name"
                    class="input input-bordered focus:outline-none focus:border-2 focus:border-primary h-10 dark:bg-stone-900"
                    type="text" name="name" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </label>

            <label class="form-control w-full">
                <div class="label">
                    <span>{{ __('account.email') }}</span>
                </div>
                <input wire:model="email" id="email"
                    class="input input-bordered focus:outline-none focus:border-2 focus:border-primary h-10 dark:bg-stone-900"
                    type="email" name="email" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </label>

            <label class="form-control w-full">
                <div class="label">
                    <span>{{ __('misc.password') }}</span>
                </div>
                <input wire:model="password" id="password"
                    class="input input-bordered focus:outline-none focus:border-2 focus:border-primary h-10 dark:bg-stone-900"
                    type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </label>

            <label class="form-control w-full">
                <div class="label">
                    <span>{{ __('account.confirm_password') }}</span>
                </div>
                <input wire:model="password_confirmation" id="password_confirmation"
                    class="input input-bordered focus:outline-none focus:border-2 focus:border-primary h-10 dark:bg-stone-900"
                    type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </label>

            <div class="flex items-center justify-end !mt-8">
                <button
                    class="btn bg-primary border-none text-white hover:bg-primary hover:brightness-90 w-full disabled:bg-primary disabled:opacity-70 disabled:text-white">
                    {{ __('misc.sign_up') }}
                </button>
            </div>
            <div class="opacity-60 text-sm">
                {{ __('misc.by_signing_up_you_agree_to_our') }} <a class="link" href="{{ route('terms') }}"
                    target="_blank">{{ __('misc.terms_and_conditions') }}</a> and <a class="link"
                    href="{{ route('privacy') }}" target="_blank">{{ __('misc.privacy_policy') }}</a>.
            </div>
        </form>
        <div class="text-sm text-center">
            <span>{{ __('misc.already_have_an_account') }}</span>
            <a wire:navigate class="link text-primary font-bold"
                href="{{ route('login') }}">{{ __('misc.login') }}</a>
        </div>
    </div>
</div>
