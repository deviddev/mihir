<section class="space-y-4">
    <div>
        <h1 class="font-semibold">
            {{ __('account.profile_information') }}
        </h1>
        <h2 class="text-sm">
            {{ __('account.update_your_account_s_profile_information_and_email_address') }}
        </h2>
    </div>
    @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
        <div class="rounded-md p-4 bg-accent text-primary text-sm">
            @if (is_null(session('status')))
                <p>
                    {{ __('account.your_email_address_is_unverified') }}

                    <button wire:click.prevent="sendVerification" class="link font-bold">
                        {{ __('account.click_here_to_re_send_the_verification_email') }}
                    </button>
                </p>
            @endif

            @if (session('status') === 'verification-link-sent')
                <p class="font-bold">
                    {{ __('account.a_new_verification_link_has_been_sent_to_your_email_address') }}
                </p>
            @endif
        </div>
    @endif
    <form wire:submit="updateProfileInformation" class="space-y-2">
        <label class="form-control w-full">
            <div class="label">
                <span>{{ __('account.name') }}</span>
            </div>
            <input wire:model="name" id="name" name="name" type="text"
                class="input input-bordered focus:outline-none focus:border-2 focus:border-primary h-10 dark:bg-stone-900"
                required autofocus autocomplete="name" />
            @error('name')
                <div class="text-sm text-red-500 mt-2">
                    {{ $message }}
                </div>
            @enderror
        </label>

        <label class="form-control w-full">
            <div class="label">
                <span>{{ __('account.email') }}</span>
            </div>
            <input wire:model="email" id="email"
                class="input input-bordered focus:outline-none focus:border-2 focus:border-primary h-10 dark:bg-stone-900"
                type="email" name="email" required autocomplete="username" @readonly(auth()->user()->isRegisteredWithProvider()) />
            @error('email')
                <div class="text-sm text-red-500 mt-2">
                    {{ $message }}
                </div>
            @enderror
        </label>

        <div class="flex items-center gap-4 !mt-8">
            <button
                class="btn bg-primary text-white hover:bg-primary border-none hover:brightness-90 disabled:bg-primary disabled:opacity-70 disabled:text-white">
                {{ __('misc.save') }}
            </button>
            <x-action-message class="me-3" on="profile-updated">
                {{ __('misc.saved') }}
            </x-action-message>
        </div>
    </form>
</section>
