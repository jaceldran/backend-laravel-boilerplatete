<script>
    import { inertia } from "@inertiajs/svelte";

    export let routes;
    export let linkDefault;
    export let linkActive;

    linkDefault = linkDefault || "hover:underline";
    linkActive = linkActive || "underline";
</script>

<nav class={$$props.class}>
    {#each routes as { text, href, active }}
        <a use:inertia {href} class="{linkDefault} {active ? linkActive : ''}">
            <span class="text"> {text}</span>
        </a>
    {/each}
</nav>

<style>
    nav {
        @apply flex justify-center;
    }
    nav.horizontal {
        @apply flex-row;
    }
    nav.vertical {
        @apply flex-col;
    }
    a {
        @apply flex justify-center items-center rounded-full;
    }
    .text {
        @apply block py-2 px-3;
    }
</style>
