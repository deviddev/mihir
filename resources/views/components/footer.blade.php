<footer class="container mx-auto">
    <div class="py-8 max-sm:mx-4">
        <div class="flex max-sm:flex-col justify-between sm:items-center">
            <figure>
                <img loading="lazy" class="w-52" src="{{ asset('img/logo.png') }}" alt="Larasense logo">
            </figure>
        </div>
        <hr class="mt-8 mb-4 bg-stone-100">
        <div class="flex max-sm:flex-col max-sm:space-y-4 justify-end text-sm">
            <div>
                <p class="mt-1">
                    © {{ date('Y') }} {{ config('app.name') }}
                </p>
            </div>
        </div>
    </div>
</footer>
