<script>
    import Fa from "svelte-fa";
    import { config, dom, library } from "@fortawesome/fontawesome-svg-core";

    export let icon;
    export let size;

    // Configurar FontAwesome
    config.autoReplaceSvg = "nest";

    // Importar el ícono
    library.add(icon);

    // Cargar el DOM
    dom.watch();
</script>

<Fa {icon} {size} class={$$props.class} />

<style>
    .fa-spin {
        animation: fa-spin 2s infinite linear;
    }
</style>
