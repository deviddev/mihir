<section class="space-y-4">
    <div>
        <h1 class="font-semibold">
            {{ __('account.update_password') }}
        </h1>
        <h2 class="text-sm">
            {{ __('account.ensure_your_account_is_using_a_long_random_password_to_stay_secure') }}
        </h2>
    </div>
    <form wire:submit="updatePassword" class="space-y-2">
        <label class="form-control w-full">
            <div class="label">
                <span>{{ __('account.current_password') }}</span>
            </div>
            <input wire:model="current_password" id="update_password_current_password" name="current_password"
                type="password"
                class="input input-bordered focus:outline-none focus:border-2 focus:border-primary h-10 dark:bg-stone-900"
                autocomplete="current-password" />
            @error('current_password')
                <div class="text-sm text-red-500 mt-2">
                    {{ $message }}
                </div>
            @enderror
        </label>

        <label class="form-control w-full">
            <div class="label">
                <span>{{ __('account.new_password') }}</span>
            </div>
            <input wire:model="password" id="update_password_password" name="password" type="password"
                class="input input-bordered focus:outline-none focus:border-2 focus:border-primary h-10 dark:bg-stone-900"
                autocomplete="new-password" />
            @error('password')
                <div class="text-sm text-red-500 mt-2">
                    {{ $message }}
                </div>
            @enderror
        </label>

        <label class="form-control w-full">
            <div class="label">
                <span>{{ __('account.confirm_password') }}</span>
            </div>
            <input wire:model="password_confirmation" id="update_password_password_confirmation"
                name="password_confirmation" type="password"
                class="input input-bordered focus:outline-none focus:border-2 focus:border-primary h-10 dark:bg-stone-900"
                autocomplete="new-password" />
            @error('password_confirmation')
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
            <x-action-message class="me-3" on="password-updated">
                {{ __('misc.saved') }}
            </x-action-message>
        </div>
    </form>
</section>
