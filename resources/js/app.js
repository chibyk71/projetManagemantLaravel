import { createInertiaApp } from '@inertiajs/svelte'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import "animate.css";
import "../css/app.css";
import "./bootstrap"
createInertiaApp({
    resolve: (name) => resolvePageComponent(`./Pages/${name}.svelte`, import.meta.glob('./Pages/**/*.svelte')),
    setup({ el, App, props }) {
        new App({ target: el, props })
    },
    progress: {
        color: "#FE9063",
    }
})