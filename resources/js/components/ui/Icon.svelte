<script>
    import Fa from "svelte-fa";
    // import { config, dom, library } from "@fortawesome/fontawesome-svg-core";

    export let icon;
    export let size;
    export let color;
    export let hover;
    export let text;

    color = color || "text-neutral-500 ";
    hover = hover || "hover:text-neutral-600 dark:hover:text-neon-700";

    // Configurar FontAwesome
    // config.autoReplaceSvg = "nest";

    // Importar el ícono
    // library.add(icon);

    // Cargar el DOM
    // dom.watch();
</script>

<div
    class="{color} {hover}{$$props.class} flex items-center {text
        ? 'gap-1'
        : ''}"
>
    <span>{text || ""}</span>
    <Fa {icon} {size} class={$$props.class} />
</div>

<style>
    .fa-spin {
        animation: fa-spin 2s infinite linear;
    }
</style>
