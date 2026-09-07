<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style>
        :root {
            --theme-1: #2563eb;
            --theme-2: #0ea5e9;
            --theme-3: #10b981;
            --theme-4: #f59e0b;
            --theme-5: #ef4444;
            --theme-6: #7c3aed;
            --theme-7: #ec4899;
            --theme-8: #14b8a6;
            --theme-9: #84cc16;
            --theme-10: #f97316;
            --theme-11: #06b6d4;
            --theme-12: #f43f5e;
            --theme: var(--theme-1);
            --theme-text: #ffffff;
            --theme-bg: #f8fafc;
            --bg: #f8fafc;
            --text: #111827;
            --primary: var(--theme);
            --p: var(--theme);
            --primary-content: #ffffff;
            --base-100: #ffffff;
            --base-200: #f8fafc;
            --base-300: #e5e7eb;
            --base-content: #111827;
            --neutral: #f3f4f6;
        }

        body {
            background: var(--bg) !important;
            color: var(--text) !important;
        }

        .bg-base-100, .bg-base-200, .bg-base-300 {
            background: var(--base-100) !important;
        }

        .text-base-content {
            color: var(--base-content) !important;
        }

        .bg-primary,
        .btn-primary,
        .badge-primary,
        .alert-primary {
            background-color: var(--theme) !important;
            border-color: var(--theme) !important;
            color: #fff !important;
        }

        .text-primary {
            color: var(--theme) !important;
        }

        .border-primary {
            border-color: var(--theme) !important;
        }

        .btn-primary:hover,
        .bg-primary:hover {
            opacity: 0.92;
        }

        .theme-selector.active,
        .theme-selector:hover {
            background: rgba(59, 130, 246, 0.08);
        }
    </style>

    @fluxAppearance

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</head>

<body class="min-h-screen antialiased">

    <main>

        @include('components.navbar')


        {{ $slot }}
    </main>

    @fluxScripts

    <script>
        if (!window.__themeControlsInitialized) {
            window.__themeControlsInitialized = true;

            const palettes = {
                'theme-1': '#2563eb',
                'theme-2': '#0ea5e9',
                'theme-3': '#10b981',
                'theme-4': '#f59e0b',
                'theme-5': '#ef4444',
                'theme-6': '#7c3aed',
                'theme-7': '#ec4899',
                'theme-8': '#14b8a6',
                'theme-9': '#84cc16',
                'theme-10': '#f97316',
                'theme-11': '#06b6d4',
                'theme-12': '#f43f5e',
            };

            const getContrastColor = hex => {
                const normalized = hex.trim().replace('#', '');
                const r = parseInt(normalized.substring(0, 2), 16);
                const g = parseInt(normalized.substring(2, 4), 16);
                const b = parseInt(normalized.substring(4, 6), 16);
                const luminance = (0.299 * r + 0.587 * g + 0.114 * b) / 255;
                return luminance > 0.6 ? '#111827' : '#ffffff';
            };

            const themeButtons = () => document.querySelectorAll('.theme-selector');
            const applyPalette = selectedPalette => {
                const value = palettes[selectedPalette] || palettes['theme-1'];
                const themeTextColor = getContrastColor(value);
                document.documentElement.style.setProperty('--theme', value);
                document.documentElement.style.setProperty('--theme-bg', value);
                document.documentElement.style.setProperty('--theme-text', themeTextColor);
                const buttons = themeButtons();
                buttons.forEach(el => {
                    el.classList.toggle('active', el.dataset.theme === selectedPalette);
                });
                localStorage.setItem('site-theme-palette', selectedPalette);
            };

            const initThemeControls = () => {
                themeButtons().forEach(button => {
                    button.addEventListener('click', function() {
                        applyPalette(this.dataset.theme);
                    });
                });

                const storedPalette = localStorage.getItem('site-theme-palette');
                applyPalette(storedPalette || 'theme-1');
            };

            if (document.readyState !== 'loading') {
                initThemeControls();
            } else {
                document.addEventListener('DOMContentLoaded', initThemeControls);
            }
        }
    </script>
</body>

</html>
