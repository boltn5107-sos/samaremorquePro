import './bootstrap';
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';
import iconRetinaUrl from 'leaflet/dist/images/marker-icon-2x.png';
import iconUrl from 'leaflet/dist/images/marker-icon.png';
import shadowUrl from 'leaflet/dist/images/marker-shadow.png';

L.Icon.Default.mergeOptions({ iconRetinaUrl, iconUrl, shadowUrl });
window.L = L;

document.addEventListener('DOMContentLoaded', () => {
    document.documentElement.classList.add('js-anim');

    // Global scroll reveal (progressive enhancement)
    const revealEls = document.querySelectorAll('.reveal');
    if (revealEls.length && 'IntersectionObserver' in window) {
        const io = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08, rootMargin: '0px 0px -24px 0px' });
        revealEls.forEach((el) => io.observe(el));
        // Reveal anything already in viewport immediately
        requestAnimationFrame(() => {
            revealEls.forEach((el) => {
                const rect = el.getBoundingClientRect();
                if (rect.top < window.innerHeight && rect.bottom > 0) {
                    el.classList.add('visible');
                }
            });
        });
    } else {
        revealEls.forEach((el) => el.classList.add('visible'));
    }
});

(function () {
    const hasSW = 'serviceWorker' in navigator;

    // Enregistrement du service worker (mode hors-ligne PWA).
    if (hasSW && window.isSecureContext) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('/sw.js').catch(() => {});
        });
    }

    // Reference du prompt d'installation natif (Chrome / Android / desktop).
    // Elle est gardee en memoire et utilisee quand l'utilisateur clique sur "Installer".
    let deferredPrompt = null;
    const LS_DISMISS = 'sr-reminders-dismissed';

    window.addEventListener('beforeinstallprompt', (event) => {
        event.preventDefault();
        deferredPrompt = event;
    });

    // Application installee : on ne re-proposera plus JAMAIS l'installation.
    window.addEventListener('appinstalled', () => {
        deferredPrompt = null;
        removeTeaser();
    });

    // Rappel affiche a CHAQUE ouverture tant que ce n'est pas fait :
    //  - "dismiss" ne masque le rappel que pour la session courante (sessionStorage),
    //    il reviendra lors de la prochaine ouverture ;
    //  - l'installation (display-mode: standalone) et le GPS accorde le desactivent pour de bon.
    function isStandalone() {
        return window.matchMedia('(display-mode: standalone)').matches
            || window.navigator.standalone === true;
    }

    function shouldShowReminders() {
        try {
            return sessionStorage.getItem(LS_DISMISS) === null;
        } catch (e) {
            return true;
        }
    }

    // Etat de la permission GPS, quand la detection est possible.
    async function geolocationStatus() {
        if (!('geolocation' in navigator)) {
            return 'unsupported';
        }

        if (navigator.permissions && navigator.permissions.query) {
            try {
                const { state } = await navigator.permissions.query({ name: 'geolocation' });
                return state; // 'granted' | 'denied' | 'prompt'
            } catch (e) {
                // La requete de permission peut echouer sur certains navigateurs.
            }
        }

        return 'unknown';
    }

    function scheduleTeaser() {
        setTimeout(() => {
            if (shouldShowReminders()) {
                renderTeaser();
            }
        }, 12000);
    }

    function removeTeaser() {
        const teaser = document.getElementById('sr-pwa-teaser');
        if (teaser) teaser.remove();
    }

    function dismissTeaser() {
        removeTeaser();
        try {
            sessionStorage.setItem(LS_DISMISS, '1');
        } catch (e) {}
    }

    function renderTeaser() {
        if (document.getElementById('sr-pwa-teaser')) return;

        const installed = isStandalone();
        // Le GPS est considere actif si la permission est deja accordee ou si le navigateur
        // ne sait pas rendre compte (on n'embete pas l'utilisateur dans ce cas).
        geolocationStatus().then((state) => {
            const gpsOK = state === 'granted' || state === 'unknown' || state === 'unsupported';

            // Plus rien a rappeler : application installee + GPS deja actif.
            if (installed && gpsOK) return;

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
                            <p class="font-semibold text-sm">${installed ? 'Activez votre GPS' : 'Installer SamaRemorque ?'}</p>
                            <p class="text-xs text-slate-300 mt-1">${installed
                                ? 'Pour trouver les remorqueurs proches et vous situer sur la carte.'
                                : 'Votre application de remorquage et depannage, accessible en un geste depuis votre ecran.'}</p>
                        </div>
                        <button type="button" data-action="close" class="text-slate-400 hover:text-white text-xl leading-none p-1" aria-label="Fermer">&times;</button>
                    </div>

                    <div class="mt-4 space-y-3">
                        ${installed ? '' : `
                        <div class="flex items-center justify-between gap-3 bg-white/[0.06] rounded-xl p-3">
                            <div>
                                <p class="text-sm font-semibold">Installation</p>
                                <p class="text-[11px] text-slate-300 mt-0.5 data-install-hint" hidden>
                                    Sur iPhone : Partager &gt; « Ajouter à l&rsquo;écran d&rsquo;accueil ».
                                    Sur Android : menu Chrome &gt; « Installer l&rsquo;application ».
                                </p>
                            </div>
                            <button type="button" data-action="install" class="flex-shrink-0 bg-orange-600 hover:bg-orange-700 text-white text-xs font-semibold px-3 py-2 rounded-lg">Installer</button>
                        </div>
                        `}
                        <div class="flex items-center justify-between gap-3 bg-white/[0.06] rounded-xl p-3" data-gps-row>
                            <div>
                                <p class="text-sm font-semibold">Position GPS</p>
                                <p class="text-[11px] text-slate-300 mt-0.5" data-gps-status>${state === 'denied' ? 'GPS bloqué dans les réglages de votre appareil.' : 'Permet au pro de vous trouver rapidement.'}</p>
                            </div>
                            <button type="button" data-action="gps" class="flex-shrink-0 bg-orange-600 hover:bg-orange-700 text-white text-xs font-semibold px-3 py-2 rounded-lg">${state === 'denied' ? 'Ouvrir les réglages' : 'Activer'}</button>
                        </div>
                    </div>

                    <p class="mt-3 text-[11px] text-slate-400">Cette installation et localisation restent sous votre controle. Vous pouvez les modifier a tout moment.</p>
                </div>
            `;

            // Bouton fermer = masque pour la session courante uniquement.
            teaser.querySelector('[data-action="close"]').addEventListener('click', () => {
                dismissTeaser();
            });

            // Bouton installer.
            teaser.querySelector('[data-action="install"]')?.addEventListener('click', async () => {
                // Pas de prompt natif (iOS) : on affiche le mode d'emploi manuel.
                if (!deferredPrompt) {
                    const hint = teaser.querySelector('.data-install-hint');
                    if (hint) {
                        hint.hidden = !hint.hidden;
                    }
                    return;
                }

                deferredPrompt.prompt();
                await deferredPrompt.userChoice.catch(() => ({}));
                deferredPrompt = null;
                // Quand l'installation est acceptee, 'appinstalled' retire le teaser.
                dismissTeaser();
            });

            // Bouton GPS : demande la position ou ouvre un message de blocage.
            const gpsButton = teaser.querySelector('[data-action="gps"]');
            const gpsStatus = teaser.querySelector('[data-gps-status]');
            const gpsRow = teaser.querySelector('[data-gps-row]');
            gpsButton.addEventListener('click', () => {
                if (state === 'denied' || !navigator.geolocation) {
                    gpsStatus.textContent = 'Allez dans Paramètres &gt; Confidentialité &gt; Localisation, puis autorisez SamaRemorque.';
                    return;
                }

                gpsButton.disabled = true;
                gpsStatus.textContent = 'Recuperation de votre position...';
                navigator.geolocation.getCurrentPosition(() => {
                    // GPS accorde : on retire la ligne de rappel GPS.
                    gpsRow.remove();
                    // S'il ne reste plus rien, on ferme le rappel pour la session.
                    if (!teaser.querySelector('[data-action="install"]') && !teaser.querySelector('[data-gps-row]')) {
                        dismissTeaser();
                    }
                }, () => {
                    gpsStatus.textContent = 'GPS bloqué ou indisponible. Vérifiez vos réglages puis réessayez.';
                    gpsButton.disabled = false;
                }, { enableHighAccuracy: true, timeout: 10000, maximumAge: 30000 });
            });

            document.body.appendChild(teaser);
        });
    }

    // Ouverture : on lance le rappel a chaque visite tant que tout n'est pas fait.
    if (shouldShowReminders()) {
        scheduleTeaser();
    }

    /*
     * Dialog « Permissions et confidentialite » : rappel optionnel des permissions.
     * L'action cliquer le rend quand le rappel principal est trop peu explicite.
     */
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

// Scroll progress bar
(function () {
    const progressBar = document.createElement('div');
    progressBar.id = 'scroll-progress';
    document.body.appendChild(progressBar);

    window.addEventListener('scroll', function () {
        const scrollTop = window.scrollY;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        const progress = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
        progressBar.style.width = progress + '%';
    });
})();

// Toast notification helper
window.showToast = function (message, type) {
    type = type || 'info';
    const toast = document.createElement('div');
    toast.className = 'toast ' + type;
    toast.textContent = message;
    document.body.appendChild(toast);
    requestAnimationFrame(function () {
        toast.classList.add('show');
    });
    setTimeout(function () {
        toast.classList.remove('show');
        setTimeout(function () { toast.remove(); }, 400);
    }, 3000);
};

// Smooth scroll for anchor links
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
});