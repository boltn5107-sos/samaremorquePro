import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const toggleBtn = document.getElementById('mobile-menu-toggle');
    const menu = document.getElementById('mobile-menu');

    if (toggleBtn && menu) {
        toggleBtn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    }
});

(function () {
    if (!('Notification' in window) && !('serviceWorker' in navigator)) {
        return;
    }

    if ('serviceWorker' in navigator && window.isSecureContext) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('/sw.js').catch(() => {});
        });
    }

    let deferredPrompt = null;
    const LS_DISMISS = 'sr-pwa-dismissed';

    window.addEventListener('beforeinstallprompt', (event) => {
        event.preventDefault();
        deferredPrompt = event;
        scheduleTeaser();
    });

    window.addEventListener('appinstalled', () => {
        deferredPrompt = null;
        removeTeaser();
    });

    function shouldShowTeaser() {
        try {
            return !localStorage.getItem(LS_DISMISS);
        } catch (e) {
            return true;
        }
    }

    function scheduleTeaser() {
        setTimeout(() => {
            if (deferredPrompt && shouldShowTeaser()) {
                renderTeaser();
            }
        }, 20000);
    }

    function removeTeaser() {
        const teaser = document.getElementById('sr-pwa-teaser');
        if (teaser) teaser.remove();
    }

    function dismissTeaser() {
        removeTeaser();
        try {
            localStorage.setItem(LS_DISMISS, '1');
        } catch (e) {}
    }

    function renderTeaser() {
        if (document.getElementById('sr-pwa-teaser')) return;
        if (window.matchMedia('(display-mode: standalone)').matches) return;

        const teaser = document.createElement('div');
        teaser.id = 'sr-pwa-teaser';
        teaser.className = 'fixed bottom-0 inset-x-0 z-50 p-4';
        teaser.style.paddingBottom = 'env(safe-area-inset-bottom)';
        teaser.innerHTML = `
            <div class="max-w-md mx-auto bg-slate-900 text-white rounded-2xl shadow-2xl p-5 border border-slate-700">
                <div class="flex items-start gap-3">
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-white overflow-hidden flex-shrink-0">
                        <img src="/favicon.png" alt="SamaRemorque" class="w-7 h-7 object-contain">
                    </span>
                    <div class="flex-1">
                        <p class="font-semibold text-sm">Installer SamaRemorque ?</p>
                        <p class="text-xs text-slate-300 mt-1">Votre application de remorquage et depannage, accessible en un geste depuis votre ecran. Aucune installation forcee : vous restez libre.</p>
                    </div>
                </div>
                <div class="mt-3 flex flex-wrap gap-2">
                    <button type="button" data-action="install" class="flex-1 bg-orange-600 hover:bg-orange-700 text-white text-sm font-semibold px-4 py-2.5 rounded-lg">Installer</button>
                    <button type="button" data-action="permissions" class="text-slate-200 hover:text-white bg-white/10 hover:bg-white/20 text-sm font-medium px-3 py-2.5 rounded-lg">Permissions</button>
                    <button type="button" data-action="dismiss" class="text-slate-400 hover:text-slate-200 text-sm px-2 py-2.5">Plus tard</button>
                </div>
                <p class="mt-3 text-[11px] text-slate-400">L'installation ne demarre pas seule : confirmez-la, vous pouvez aussi l'annuler. D'autres permissions restent a votre controle (voir « Permissions »).</p>
            </div>
        `;

        teaser.querySelector('[data-action="install"]').addEventListener('click', async () => {
            if (!deferredPrompt) {
                openPermissionsDialog();
                return;
            }
            deferredPrompt.prompt();
            const choice = await deferredPrompt.userChoice.catch(() => ({}));
            deferredPrompt = null;
            if (choice.outcome === 'accepted') {
                dismissTeaser();
            } else {
                dismissTeaser();
            }
        });

        teaser.querySelector('[data-action="permissions"]').addEventListener('click', () => {
            openPermissionsDialog();
        });

        teaser.querySelector('[data-action="dismiss"]').addEventListener('click', () => {
            dismissTeaser();
        });

        document.body.appendChild(teaser);
    }

    function openPermissionsDialog() {
        if (document.getElementById('sr-permissions-dialog')) return;

        const overlay = document.createElement('div');
        overlay.id = 'sr-permissions-dialog';
        overlay.className = 'fixed inset-0 z-50 flex items-end sm:items-center justify-center bg-slate-900/60 p-0 sm:p-4';
        overlay.innerHTML = `
            <div class="w-full sm:max-w-md bg-white rounded-t-2xl sm:rounded-2xl shadow-2xl max-h-[90vh] overflow-y-auto">
                <div class="p-5 border-b border-slate-200 flex items-center justify-between">
                    <h3 class="font-bold text-slate-900">Permissions et confidentialite</h3>
                    <button type="button" data-close class="p-2 rounded-lg hover:bg-slate-100 text-slate-500" aria-label="Fermer">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18M6 6l12 12"/></svg>
                    </button>
                </div>
                <div class="p-5 space-y-4">
                    <p class="text-sm text-slate-600">SamaRemorque ne demande <strong>aucune permission</strong> automatiquement. Chaque permission ci-dessous n'est activee que si vous l'autorisez, au moment ou vous en avez besoin.</p>

                    <div class="border border-slate-200 rounded-xl p-4">
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <p class="font-semibold text-sm text-slate-900">Position GPS</p>
                                <p class="text-xs text-slate-500 mt-0.5">Pour trouver les remorqueurs proches et vous situer sur la carte.</p>
                            </div>
                            <button type="button" data-permission="geolocation" class="px-3 py-2 text-xs font-semibold rounded-lg bg-orange-600 text-white hover:bg-orange-700">Autoriser</button>
                        </div>
                    </div>

                    <div class="border border-slate-200 rounded-xl p-4">
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <p class="font-semibold text-sm text-slate-900">Camera</p>
                                <p class="text-xs text-slate-500 mt-0.5">Pour photographier votre panne et la montrer au professionnel.</p>
                            </div>
                            <button type="button" data-permission="camera" class="px-3 py-2 text-xs font-semibold rounded-lg bg-orange-600 text-white hover:bg-orange-700">Autoriser</button>
                        </div>
                    </div>

                    <div class="border border-slate-200 rounded-xl p-4">
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <p class="font-semibold text-sm text-slate-900">Notifications</p>
                                <p class="text-xs text-slate-500 mt-0.5">Pour vous avertir des etapes de votre intervention.</p>
                            </div>
                            <button type="button" data-permission="notifications" class="px-3 py-2 text-xs font-semibold rounded-lg bg-orange-600 text-white hover:bg-orange-700">Autoriser</button>
                        </div>
                    </div>

                    <p class="text-[11px] text-slate-400">
                        Vous pouvez changer d'avis a tout moment dans les reglages de votre appareil.
                        <a href="/confidentialite" class="underline text-orange-600">En savoir plus</a>
                    </p>
                </div>
            </div>
        `;

        overlay.querySelector('[data-permission="geolocation"]').addEventListener('click', () => {
            if (!navigator.geolocation) return;
            navigator.geolocation.getCurrentPosition(() => {}, () => {});
        });

        overlay.querySelector('[data-permission="camera"]').addEventListener('click', () => {
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } })
                    .then((stream) => {
                        stream.getTracks().forEach((track) => track.stop());
                    })
                    .catch(() => {});
            }
        });

        overlay.querySelector('[data-permission="notifications"]').addEventListener('click', () => {
            if ('Notification' in window && Notification.permission === 'default') {
                Notification.requestPermission().catch(() => {});
            }
        });

        overlay.querySelector('[data-close]').addEventListener('click', () => {
            overlay.remove();
        });

        overlay.addEventListener('click', (event) => {
            if (event.target === overlay) overlay.remove();
        });

        document.body.appendChild(overlay);
    }
})();