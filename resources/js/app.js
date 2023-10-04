import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

// On page load or when changing themes, best to add inline in `head` to avoid FOUC
if (localStorage.theme === 'synthwave' || (!('synthwave' in localStorage) && window.matchMedia('(prefers-color-scheme: synthwave)').matches)) {
    document.documentElement.classList.add('synthwave')
  } else {
    document.documentElement.classList.remove('synthwave')
  }
  
  // Whenever the user explicitly chooses light mode
  localStorage.theme = 'fantasy'
  
  // Whenever the user explicitly chooses dark mode
  localStorage.theme = 'synthwave'
  
  // Whenever the user explicitly chooses to respect the OS preference
  localStorage.removeItem('theme')
