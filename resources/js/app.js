import { createInertiaApp } from '@inertiajs/svelte'

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./routes/**/*.svelte', { eager: true })
        return pages[`./routes/${name}.svelte`]
    },
    setup({ el, App, props }) {
        new App({ target: el, props })
    },
    progress: {
        delay: 0,
        color: 'crimson',
        includeCss: true,
        showSpinner: true,
    }
})
