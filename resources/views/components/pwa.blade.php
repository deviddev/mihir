<div id="installPopup"
    class="hidden fixed bottom-4 right-4 z-50 p-4 bg-white rounded-lg shadow-sm dark:bg-stone-600 border-2 border-accent dark:border-stone-800 hover:border-primary">
    <div class="mb-4 flex items-center gap-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15M9 12l3 3m0 0 3-3m-3 3V2.25" />
        </svg>
        <p class="dark:text-white">{{ __('misc.install_pwa') }}</p>
    </div>
    <button id="installBtn" class="btn btn-primary text-white">{{ __('misc.install') }}</button>
    <button onclick="closeInstallPopup()" class="btn btn-ghost">{{ __('misc.close') }}</button>
</div>

<script>
    let deferredPrompt;

    window.addEventListener("beforeinstallprompt", (e) => {
        e.preventDefault();
        deferredPrompt = e;
        showInstallPopup();
    });

    function showInstallPopup() {
        document.getElementById("installPopup").classList.remove("hidden");
    }

    function closeInstallPopup() {
        document.getElementById("installPopup").classList.add("hidden");
    }

    document.getElementById("installBtn").addEventListener("click", async () => {
        if (deferredPrompt) {
            deferredPrompt.prompt();
            const {
                outcome
            } = await deferredPrompt.userChoice;
            deferredPrompt = null;
            closeInstallPopup();
        }
    });

    window.addEventListener("appinstalled", () => {
        closeInstallPopup();
    });
</script>
