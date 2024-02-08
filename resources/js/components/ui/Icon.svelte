<script>
    import Fa from "svelte-fa";
    import { config, dom, library } from "@fortawesome/fontawesome-svg-core";

    export let icon;
    export let size;
    export let color;
    export let hover;

    color = color || "text-neutral-400 ";
    hover = hover || "hover:text-neutral-500 dark:hover:text-neon-light-dark";

    // Configurar FontAwesome
    config.autoReplaceSvg = "nest";

    // Importar el ícono
    library.add(icon);

    // Cargar el DOM
    dom.watch();
</script>

<Fa {icon} {size} class="{color} {hover} {$$props.class}" />

<style>
    .fa-spin {
        animation: fa-spin 2s infinite linear;
    }
</style>
