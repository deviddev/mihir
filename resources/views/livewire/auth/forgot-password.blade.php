<div class="min-h-screen flex justify-center items-center">
    <div class="sm:max-w-sm sm:mx-auto mx-4 py-8 space-y-6 border-2 border-accent p-8 rounded-box shadow-lg">
        <figure>
            <a wire:navigate href="{{ route('home') }}">
                <img loading="lazy" class="w-48 mx-auto" src="{{ asset('img/logo.png') }}" alt="Mihir logo">
            </a>
        </figure>
        <div class="text-sm">
            {{ __('misc.forgot_your_password') }}
        </div>

        @if (session()->has('status'))
            <div class="rounded-md font-bold p-4 bg-accent text-primary text-sm">
                {{ __('misc.we_have_emailed_your_password_reset_link') }}
            </div>
        @endif

        @if (!session()->has('status'))
            <form wire:submit="sendPasswordResetLink" class="space-y-2">
                <x-honeypot livewire-model="extraFields" />

                <label class="form-control w-full">
                    <div class="label">
                        <span>{{ __('account.email') }}</span>
                    </div>
                    <input wire:model="email" id="email"
                        class="input input-bordered focus:outline-none focus:border-2 focus:border-primary h-10 dark:bg-stone-900"
                        type="email" name="email" required autofocus />
                    @error('email')
                        <div class="text-sm text-red-500 mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </label>

                <div class="flex items-center justify-end !mt-8">
                    <button
                        class="btn bg-primary border-none text-white hover:bg-primary hover:brightness-90 w-full disabled:bg-primary disabled:opacity-70 disabled:text-white">
                        {{ __('misc.email_password_reset_link') }}
                    </button>
                </div>
            </form>
            <div class="text-sm text-center">
                <span>{{ __('misc.just_remembered') }}</span>
                <a wire:navigate class="link text-primary font-bold"
                    href="{{ route('login') }}">{{ __('misc.login') }}</a>
            </div>
        @endif
    </div>
</div>
