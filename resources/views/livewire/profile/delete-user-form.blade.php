<section class="space-y-4 border border-black dark:border-stone-50 p-4 rounded-btn">
    <div>
        <h2 class="font-semibold">
            {{ __('account.delete_account') }}
        </h2>
        <p class="text-sm">
            {{ __('account.once_your_account_is_deleted_it_will_be_permanently_deleted') }}
        </p>
    </div>

    <button x-data
        class="btn bg-stone-700 dark:bg-white hover:bg-stone-900 dark:hover:bg-stone-200 text-white dark:text-stone-900"
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        {{ __('account.delete_account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="deleteUser" class="p-6">

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('account.are_you_sure_you_want_to_delete_your_account') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('account.once_your_account_is_deleted_it_will_be_permanently_deleted') }}
            </p>

            @if (!auth()->user()->isRegisteredWithProvider())
                <div class="mt-6">
                    <x-input-label for="password" value="{{ __('misc.password') }}" class="sr-only" />

                    <x-text-input wire:model="password" id="password" name="password" type="password"
                        class="mt-1 block w-3/4" placeholder="{{ __('misc.password') }}" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
            @endif

            <div class="mt-6 flex justify-end gap-x-2">
                <button type="button" x-data class="btn btn-outline" x-on:click="$dispatch('close')">
                    {{ __('misc.cancel') }}
                </button>

                <button class="btn bg-stone-700 hover:bg-stone-900 text-white">
                    {{ __('account.delete_account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
